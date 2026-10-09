<?php

namespace App\Services;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class SliderService
{
    public function list(): Collection
    {
        return Slider::query()->orderBy('display_order')->orderBy('id')->get();
    }

    public function find(int $id): Slider
    {
        return Slider::query()->findOrFail($id);
    }

    public function create(array $data): Slider
    {
        $newImagePath = null;

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeImage($data['image']);

                $data['image'] = $newImagePath;
            }

            return Slider::query()->create($data);
        } catch (Throwable $exception) {
            if ($newImagePath !== null) {
                Storage::disk('public')->delete($newImagePath);
            }

            throw $exception;
        }
    }

    public function update(int $id, array $data): Slider
    {
        $slider = Slider::query()->findOrFail($id);

        $newImagePath = null;
        $oldImagePath = null;

        try {
            if (($data['image'] ?? null) instanceof UploadedFile) {
                $newImagePath = $this->storeImage($data['image']);

                $oldImagePath = $slider->image;

                $data['image'] = $newImagePath;
            }

            $updated = $slider->update($data);

            if (! $updated) {
                throw new RuntimeException(
                    'Failed to update the slider.'
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

        return $slider->refresh();
    }

    public function delete(int $id): bool
    {
        $slider = Slider::query()->findOrFail($id);

        $imagePath = $slider->image;

        $deleted = $slider->delete();

        if (! $deleted) {
            throw new RuntimeException(
                'Failed to delete the slider.'
            );
        }

        if ($imagePath !== null) {
            Storage::disk('public')->delete($imagePath);
        }

        return true;
    }

    private function storeImage(UploadedFile $image): string
    {
        $path = $image->store('sliders', 'public');

        if ($path === false) {
            throw new RuntimeException(
                'Failed to store the slider image.'
            );
        }

        return $path;
    }
}
