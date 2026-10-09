<?php

namespace App\Services;

use App\Models\ClientReview;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class ClientReviewService
{
    public function list(): Collection
    {
        return ClientReview::query()->with('replies')->latest()->get();
    }

    public function find(int $id): ClientReview
    {
        return ClientReview::query()->with('replies')->findOrFail($id);
    }

    public function create(array $data): ClientReview
    {
        $newImagePath = null;

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeImage($data['image']);
                $data['image'] = $newImagePath;
            }

            return ClientReview::query()->create($data);
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }
    }

    public function update(int $id, array $data): ClientReview
    {
        $review = ClientReview::query()->findOrFail($id);

        $newImagePath = null;
        $oldImagePath = null;

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeImage($data['image']);

                $oldImagePath = $review->image;

                $data['image'] = $newImagePath;
            }

            $updated = $review->update($data);

            if (!$updated) {
                throw new RuntimeException(
                    'Failed to update the client review.'
                );
            }
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }

        if ($oldImagePath !== null) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return $review->refresh();
    }

    public function delete(int $id): bool
    {
        $review = ClientReview::query()->findOrFail($id);

        $imagePath = $review->image;

        $deleted = $review->delete();

        if (!$deleted) {
            throw new RuntimeException(
                'Failed to delete the client review.'
            );
        }

        if ($imagePath !== null) {
            Storage::disk('public')->delete($imagePath);
        }

        return true;
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('client-reviews', 'public');

        if ($path === false) {
            throw new RuntimeException(
                'Failed to store the client review image.'
            );
        }

        return $path;
    }
}
