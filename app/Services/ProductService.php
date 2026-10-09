<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class ProductService
{
    private const FILE_FIELDS = [
        'image' => 'products/images',
        'og_image' => 'products/og-images',
    ];

    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return Product::query()->paginate($perPage);
    }

    public function find(int $id): Product
    {
        return Product::query()->findOrFail($id);
    }

    public function create(array $data): Product
    {
        $newPaths = [];

        try {
            foreach (self::FILE_FIELDS as $field => $directory) {
                if (($data[$field] ?? null) instanceof UploadedFile) {
                    $path = $this->storeFile(
                        file: $data[$field],
                        directory: $directory,
                    );

                    $data[$field] = $path;
                    $newPaths[] = $path;
                }
            }

            return Product::query()->create($data);
        } catch (Throwable $exception) {
            $this->deleteFiles($newPaths);

            throw $exception;
        }
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::query()->findOrFail($id);

        $newPaths = [];
        $oldPaths = [];

        try {
            foreach (self::FILE_FIELDS as $field => $directory) {
                if (! array_key_exists($field, $data)) {
                    continue;
                }

                $oldPath = $product->getAttribute($field);

                if ($data[$field] instanceof UploadedFile) {
                    $newPath = $this->storeFile(
                        file: $data[$field],
                        directory: $directory,
                    );

                    $data[$field] = $newPath;
                    $newPaths[] = $newPath;

                    if (is_string($oldPath) && $oldPath !== '') {
                        $oldPaths[] = $oldPath;
                    }

                    continue;
                }

                if (
                    $data[$field] === null
                    && is_string($oldPath)
                    && $oldPath !== ''
                ) {
                    $oldPaths[] = $oldPath;
                }
            }

            $updated = $product->update($data);

            if (! $updated) {
                throw new RuntimeException('Failed to update the product.');
            }
        } catch (Throwable $exception) {
            /*
             * اگر ذخیره فایل جدید موفق شود ولی Update دیتابیس شکست بخورد،
             * فایل جدید نباید بدون رکورد مرتبط روی سرور باقی بماند.
             */
            $this->deleteFiles($newPaths);

            throw $exception;
        }

        /*
         * فایل‌های قدیمی فقط بعد از موفقیت Update حذف می‌شوند.
         * اگر قبل از Update حذف شوند و دیتابیس خطا بدهد،
         * محصول به فایلی اشاره می‌کند که دیگر وجود ندارد.
         */
        $this->deleteFiles($oldPaths);

        return $product->refresh();
    }

    public function delete(int $id): bool
    {
        $product = Product::query()->findOrFail($id);

        $paths = [
            $product->image,
            $product->og_image,
        ];

        $deleted = $product->delete();

        if (! $deleted) {
            throw new RuntimeException('Failed to delete the product.');
        }

        /*
         * ابتدا رکورد دیتابیس حذف می‌شود و سپس فایل‌ها.
         * این ترتیب مانع باقی‌ماندن رکوردی با مسیر فایل حذف‌شده می‌شود.
         */
        $this->deleteFiles($paths);

        return true;
    }

    private function storeFile(
        UploadedFile $file,
        string $directory,
    ): string {
        $path = $file->store($directory, 'public');

        if ($path === false) {
            throw new RuntimeException(
                "Failed to store file in directory: {$directory}"
            );
        }

        return $path;
    }

    /**
     * @param array<int, mixed> $paths
     */
    private function deleteFiles(array $paths): void
    {
        $validPaths = array_values(
            array_unique(
                array_filter(
                    $paths,
                    static fn (mixed $path): bool =>
                        is_string($path) && $path !== ''
                )
            )
        );

        if ($validPaths === []) {
            return;
        }

        Storage::disk('public')->delete($validPaths);
    }
}
