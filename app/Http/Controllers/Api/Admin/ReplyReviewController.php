<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyReview\StoreReplyReviewRequest;
use App\Http\Requests\ReplyReview\UpdateReplyReviewRequest;
use App\Http\Resources\ReplyReviewResource;
use App\Services\ReplyReviewService;
use Illuminate\Http\JsonResponse;

class ReplyReviewController extends Controller
{
    public function __construct(
        private readonly ReplyReviewService $replyReviewService
    ) {
    }

    public function index(int $client_review): JsonResponse
    {
        $replies = $this->replyReviewService->list($client_review);

        return ReplyReviewResource::collection($replies)
            ->additional([
                'success' => true,
                'message' => 'Review replies retrieved successfully.',
            ])
            ->response();
    }

    public function store(
        StoreReplyReviewRequest $request,
        int $client_review
    ): JsonResponse {
        $reply = $this->replyReviewService->create(
            $client_review,
            (int) $request->user()->id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Reply created successfully.',
            'data' => new ReplyReviewResource($reply),
        ], 201);
    }

    public function show(
        int $client_review,
        int $reply
    ): JsonResponse {
        $reply = $this->replyReviewService->find(
            $client_review,
            $reply
        );

        return response()->json([
            'success' => true,
            'message' => 'Reply retrieved successfully.',
            'data' => new ReplyReviewResource($reply),
        ]);
    }

    public function update(
        UpdateReplyReviewRequest $request,
        int $client_review,
        int $reply
    ): JsonResponse {
        $reply = $this->replyReviewService->update(
            $client_review,
            $reply,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Reply updated successfully.',
            'data' => new ReplyReviewResource($reply),
        ]);
    }

    public function destroy(
        int $client_review,
        int $reply
    ): JsonResponse {
        $this->replyReviewService->delete(
            $client_review,
            $reply
        );

        return response()->json([
            'success' => true,
            'message' => 'Reply deleted successfully.',
            'data' => null,
        ]);
    }
}
