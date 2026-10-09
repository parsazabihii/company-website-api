<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessage\StoreContactMessageRequest;
use App\Services\ContactMessageService;
use Illuminate\Http\JsonResponse;

class ContactMessageController extends Controller
{
    public function __construct(
        private readonly ContactMessageService $contactMessageService
    ) {}

    public function store(
        StoreContactMessageRequest $request): JsonResponse
    {
        $this->contactMessageService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully.',
            'data' => null,
        ], 201);
    }
}
