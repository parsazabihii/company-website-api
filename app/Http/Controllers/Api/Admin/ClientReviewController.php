<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientReview\StoreClientReviewRequest;
use App\Http\Requests\ClientReview\UpdateClientReviewRequest;
use App\Http\Resources\ClientReviewResource;
use App\Services\ClientReviewService;
use Illuminate\Http\JsonResponse;

class ClientReviewController extends Controller
{
    public function __construct(
        private readonly ClientReviewService $clientReviewService
    ) {
    }

    public function index(): JsonResponse
    {
        $reviews = $this->clientReviewService->list();

        return ClientReviewResource::collection($reviews)
            ->additional([
                'success' => true,
                'message' => 'Client reviews retrieved successfully.',
            ])
            ->response();
    }

    public function store(
        StoreClientReviewRequest $request
    ): JsonResponse {
        $review = $this->clientReviewService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Client review created successfully.',
            'data' => new ClientReviewResource($review),
        ], 201);
    }

    public function show(int $clientReview): JsonResponse
    {
        $review = $this->clientReviewService->find($clientReview);

        return response()->json([
            'success' => true,
            'message' => 'Client review retrieved successfully.',
            'data' => new ClientReviewResource($review),
        ]);
    }

    public function update(
        UpdateClientReviewRequest $request,
        int $clientReview
    ): JsonResponse {
        $review = $this->clientReviewService->update(
            $clientReview,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Client review updated successfully.',
            'data' => new ClientReviewResource($review),
        ]);
    }

    public function destroy(int $clientReview): JsonResponse
    {
        $this->clientReviewService->delete($clientReview);

        return response()->json([
            'success' => true,
            'message' => 'Client review deleted successfully.',
            'data' => null,
        ]);
    }
}
