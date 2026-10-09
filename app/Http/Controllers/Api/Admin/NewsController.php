<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Services\NewsService;
use Illuminate\Http\JsonResponse;


class NewsController extends Controller
{
    public function __construct(
        private readonly NewsService $newsService
    ) {}

    public function index(): JsonResponse
    {
        $news = $this->newsService->list();

        return response()->json([
            'success' => true,
            'message' => 'News retrieved successfully.',
            'data' => NewsResource::collection($news),
        ]);
    }

    public function store(StoreNewsRequest $request): JsonResponse
    {
        $news = $this->newsService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'News created successfully.',
            'data' => new NewsResource($news)
        ], 201);
    }

    public function show(News $news): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'News retrieved successfully.',
            'data' => new NewsResource($news),
        ]);
    }

    public function update(UpdateNewsRequest $request, News $news): JsonResponse
    {
        $news = $this->newsService->update($news->id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'News updated successfully.',
            'data' => new NewsResource($news)
        ]);
    }

    public function destroy(News $news): JsonResponse
    {
        $this->newsService->delete($news->id);

        return response()->json([
            'success' => true,
            'message' => 'News deleted successfully.',
            'data' => null,
        ]);
    }
}
