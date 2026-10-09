<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ServiceService
{
    /**
     * Get all services.
     */
    public function getAll(): Collection
    {
        return Service::query()
            ->with(['features', 'faqs'])
            ->orderBy('display_order')
            ->get();
    }

    /**
     * Create a service.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws Throwable
     */
    public function create(array $data): Service
    {
        $uploadedPaths = [];

        try {
            return DB::transaction(function () use ($data, &$uploadedPaths): Service {
                if (
                    isset($data['image'])
                    && $data['image'] instanceof UploadedFile
                ) {
                    $data['image'] = $data['image']->store(
                        'services/images',
                        'public'
                    );

                    $uploadedPaths[] = $data['image'];
                }

                if (
                    isset($data['og_image'])
                    && $data['og_image'] instanceof UploadedFile
                ) {
                    $data['og_image'] = $data['og_image']->store(
                        'services/og-images',
                        'public'
                    );

                    $uploadedPaths[] = $data['og_image'];
                }

                $service = Service::query()->create($data);

                return $service->load(['features', 'faqs']);
            });
        } catch (Throwable $exception) {
            foreach ($uploadedPaths as $path) {
                Storage::disk('public')->delete($path);
            }

            throw $exception;
        }
    }

    /**
     * Get a service.
     */
    public function getById(Service $service): Service
    {
        return $service->load(['features', 'faqs']);
    }

    /**
     * Update a service.
     *
     * @param  array<string, mixed>  $data
     *
     * @throws Throwable
     */
    public function update(Service $service, array $data): Service
    {
        $oldImage = $service->image;
        $oldOgImage = $service->og_image;
        $newImage = null;
        $newOgImage = null;

        try {
            DB::transaction(function () use (
                $service,
                $data,
                &$newImage,
                &$newOgImage
            ): void {
                if (
                    isset($data['image'])
                    && $data['image'] instanceof UploadedFile
                ) {
                    $newImage = $data['image']->store(
                        'services/images',
                        'public'
                    );

                    $data['image'] = $newImage;
                }

                if (
                    isset($data['og_image'])
                    && $data['og_image'] instanceof UploadedFile
                ) {
                    $newOgImage = $data['og_image']->store(
                        'services/og-images',
                        'public'
                    );

                    $data['og_image'] = $newOgImage;
                }

                $service->update($data);
            });
        } catch (Throwable $exception) {
            if ($newImage !== null) {
                Storage::disk('public')->delete($newImage);
            }

            if ($newOgImage !== null) {
                Storage::disk('public')->delete($newOgImage);
            }

            throw $exception;
        }

        if ($newImage !== null && $oldImage !== null) {
            Storage::disk('public')->delete($oldImage);
        }

        if ($newOgImage !== null && $oldOgImage !== null) {
            Storage::disk('public')->delete($oldOgImage);
        }

        return $service->refresh()->load(['features', 'faqs']);
    }

    /**
     * Soft delete a service.
     */
    public function delete(Service $service): void
    {
        $service->delete();
    }
}
