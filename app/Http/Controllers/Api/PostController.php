<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function __construct(
        private readonly PostService $postService
    ) {
    }

    public function index(): JsonResponse
    {
        $posts = $this->postService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Posts retrieved successfully.',
            'data' => PostResource::collection($posts),
        ]);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = $this->postService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Post created successfully.',
            'data' => new PostResource($post),
        ], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Post retrieved successfully.',
            'data' => new PostResource($post),
        ]);
    }

    public function update(
        UpdatePostRequest $request,
        Post $post
    ): JsonResponse {
        $post = $this->postService->update(
            $post,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Post updated successfully.',
            'data' => new PostResource($post),
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->postService->delete($post);

        return response()->json([
            'success' => true,
            'message' => 'Post deleted successfully.',
            'data' => null,
        ]);
    }
}
