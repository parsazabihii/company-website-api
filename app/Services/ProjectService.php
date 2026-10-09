<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function getAll(): Collection
    {
        return Project::query()
            ->with([
                'images' => fn ($query) => $query->orderBy('display_order'),
            ])
            ->latest()
            ->get();
    }

    public function create(array $data): Project
    {
        return Project::query()->create($data);
    }

    public function getById(Project $project): Project
    {
        return $project->load([
            'images' => fn ($query) => $query->orderBy('display_order'),
        ]);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);

        return $project->refresh()->load([
            'images' => fn ($query) => $query->orderBy('display_order'),
        ]);
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}
