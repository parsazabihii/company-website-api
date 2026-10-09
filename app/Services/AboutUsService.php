<?php

namespace App\Services;

use App\Models\AboutUs;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class AboutUsService
{
    public function get(): ?AboutUs
    {
        return AboutUs::query()->first();
    }

    public function updateOrCreate(array $data): AboutUs
    {
        $record = AboutUs::query()->first();

        $newFiles = [];
        $oldFiles = [];

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeFile(
                    $data['image'],
                    'about-us/images'
                );

                $newFiles[] = $newImagePath;

                if ($record?->image) {
                    $oldFiles[] = $record->image;
                }

                $data['image'] = $newImagePath;
            }

            if (($data['og_image'] ?? null) instanceof UploadedFile) {
                $newOgImagePath = $this->storeFile(
                    $data['og_image'],
                    'about-us/og-images'
                );

                $newFiles[] = $newOgImagePath;

                if ($record?->og_image) {
                    $oldFiles[] = $record->og_image;
                }

                $data['og_image'] = $newOgImagePath;
            }

            if ($record !== null) {
                $updated = $record->update($data);

                if (!$updated) {
                    throw new RuntimeException(
                        'Failed to update the about us record.'
                    );
                }

                $record = $record->refresh();
            } else {
                $record = AboutUs::query()->create($data);
            }
        } catch (Throwable $exception) {
            $this->deleteFiles($newFiles);

            throw $exception;
        }

        $this->deleteFiles($oldFiles);

        return $record;
    }

    private function storeFile(
        UploadedFile $file,
        string $directory
    ): string {
        $path = $file->store($directory, 'public');

        if ($path === false) {
            throw new RuntimeException(
                'Failed to store the about us file.'
            );
        }

        return $path;
    }

    private function deleteFiles(array $paths): void
    {
        foreach ($paths as $path) {
            if ($path !== null) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
