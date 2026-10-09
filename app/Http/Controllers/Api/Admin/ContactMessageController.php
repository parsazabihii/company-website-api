<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactMessage\UpdateContactMessageStatusRequest;
use App\Http\Resources\ContactMessageResource;
use App\Services\ContactMessageService;
use Illuminate\Http\JsonResponse;

class ContactMessageController extends Controller
{
    public function __construct(
        private readonly ContactMessageService $contactMessageService
    ) {}

    public function index(): JsonResponse
    {
        $messages = $this->contactMessageService->list();

        return ContactMessageResource::collection($messages)->additional([
                'success' => true,
                'message' => 'Contact messages retrieved successfully.',
            ])->response();
    }

    public function show(int $contact_message): JsonResponse
    {
        $message = $this->contactMessageService->find($contact_message);

        return response()->json([
            'success' => true,
            'message' => 'Contact message retrieved successfully.',
            'data' => new ContactMessageResource($message),
        ]);
    }

    public function updateStatus(UpdateContactMessageStatusRequest $request, int $contact_message): JsonResponse
    {
        $validated = $request->validated();

        $message = $this->contactMessageService->updateStatus($contact_message, (int) $validated['status']);

        return response()->json([
            'success' => true,
            'message' => 'Contact message status updated successfully.',
            'data' => new ContactMessageResource($message),
        ]);
    }

    public function destroy(int $contact_message): JsonResponse
    {
        $this->contactMessageService->delete($contact_message);

        return response()->json([
            'success' => true,
            'message' => 'Contact message deleted successfully.',
            'data' => null,
        ]);
    }
}
