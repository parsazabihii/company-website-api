<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Collection;

class ProjectImageService
{
    public function getAll(Project $project): Collection
    {
        return $project->images()
            ->orderBy('display_order')
            ->get();
    }

    public function create(Project $project, array $data): ProjectImage
    {
        return $project->images()->create($data);
    }

    public function update(ProjectImage $image, array $data): ProjectImage
    {
        $image->update($data);

        return $image->refresh();
    }

    public function delete(ProjectImage $image): bool
    {
        return $image->delete();
    }
}
