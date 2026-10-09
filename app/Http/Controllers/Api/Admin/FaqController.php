<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Http\Resources\FaqResource;
use App\Services\FaqService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function __construct(
        private readonly FaqService $faqService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $serviceId = $request->filled('service_id') ? $request->integer('service_id') : null;

        $faqs = $this->faqService->list($serviceId);

        return FaqResource::collection($faqs)
            ->additional([
                'success' => true,
                'message' => 'FAQs retrieved successfully.',
            ])->response();
    }

    public function store(StoreFaqRequest $request): JsonResponse
    {
        $faq = $this->faqService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'FAQ created successfully.',
            'data' => new FaqResource($faq),
        ], 201);
    }

    public function show(int $faq): JsonResponse
    {
        $faq = $this->faqService->find($faq);

        return response()->json([
            'success' => true,
            'message' => 'FAQ retrieved successfully.',
            'data' => new FaqResource($faq),
        ]);
    }

    public function update(UpdateFaqRequest $request, int $faq): JsonResponse
    {
        $faq = $this->faqService->update(
            $faq,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'FAQ updated successfully.',
            'data' => new FaqResource($faq),
        ]);
    }

    public function destroy(int $faq): JsonResponse
    {
        $this->faqService->delete($faq);

        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully.',
            'data' => null,
        ]);
    }
}
