<?php

namespace App\Services;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;

class FaqService
{
    public function list(?int $serviceId = null): Collection
    {
        return Faq::query()
            ->when(
                $serviceId !== null,
                fn ($query) => $query->where('service_id', $serviceId)
            )
            ->orderBy('display_order')
            ->orderBy('id')
            ->get();
    }

    public function find(int $id): Faq
    {
        return Faq::query()->findOrFail($id);
    }

    public function create(array $data): Faq
    {
        return Faq::query()->create($data);
    }

    public function update(int $id, array $data): Faq
    {
        $faq = Faq::query()->findOrFail($id);

        $faq->update($data);

        return $faq->refresh();
    }

    public function delete(int $id): bool
    {
        $faq = Faq::query()->findOrFail($id);

        return (bool) $faq->delete();
    }
}
