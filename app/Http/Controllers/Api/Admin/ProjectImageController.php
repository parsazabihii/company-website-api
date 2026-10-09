<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectImageRequest;
use App\Http\Requests\Project\UpdateProjectImageRequest;
use App\Http\Resources\ProjectImageResource;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Services\ProjectImageService;
use Illuminate\Http\JsonResponse;

class ProjectImageController extends Controller
{
    public function __construct(
        private readonly ProjectImageService $projectImageService
    ) {
    }

    public function index(Project $project): JsonResponse
    {
        $images = $this->projectImageService->getAll($project);

        return response()->json([
            'success' => true,
            'message' => 'Project images retrieved successfully.',
            'data' => ProjectImageResource::collection($images),
        ]);
    }

    public function store(
        StoreProjectImageRequest $request,
        Project $project
    ): JsonResponse {
        $image = $this->projectImageService->create(
            $project,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Project image created successfully.',
            'data' => new ProjectImageResource($image),
        ], 201);
    }

    public function show(
        Project $project,
        ProjectImage $image
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => 'Project image retrieved successfully.',
            'data' => new ProjectImageResource($image),
        ]);
    }

    public function update(
        UpdateProjectImageRequest $request,
        Project $project,
        ProjectImage $image
    ): JsonResponse {
        $image = $this->projectImageService->update(
            $image,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Project image updated successfully.',
            'data' => new ProjectImageResource($image),
        ]);
    }

    public function destroy(
        Project $project,
        ProjectImage $image
    ): JsonResponse {
        $this->projectImageService->delete($image);

        return response()->json([
            'success' => true,
            'message' => 'Project image deleted successfully.',
            'data' => null,
        ]);
    }
}
