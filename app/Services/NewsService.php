<?php

namespace App\Services;

use App\Models\News;

class NewsService
{
    public function list(int $perPage = 15)
    {
        return News::latest('published_at')->paginate($perPage);
    }

    public function find(int $id)
    {
        return News::findOrFail($id);
    }

    public function create(array $data)
    {
        return News::create($data);
    }

    public function update(int $id, array $data)
    {
        $news = News::findOrFail($id);
        $news->update($data);
        return $news;
    }

    public function delete(int $id): bool
    {
        return News::findOrFail($id)->delete();
    }
}
