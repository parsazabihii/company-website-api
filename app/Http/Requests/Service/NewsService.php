<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Database\Eloquent\Collection;

class NewsService
{
    public function getAll(): Collection
    {
        return News::latest()->get();
    }

    public function create(array $data): News
    {
        return News::create($data);
    }

    public function update(News $news, array $data): News
    {
        $news->update($data);

        return $news->refresh();
    }

    public function delete(News $news): bool
    {
        return $news->delete();
    }
}
