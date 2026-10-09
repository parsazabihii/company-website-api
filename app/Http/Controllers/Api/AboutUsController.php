<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutUsResource;
use App\Services\AboutUsService;
use Illuminate\Http\JsonResponse;

class AboutUsController extends Controller
{
    public function __construct(
        private readonly AboutUsService $aboutUsService
    ) {}

    public function show(): JsonResponse
    {
        $aboutUs = $this->aboutUsService->get();

        return response()->json([
            'success' => true,
            'message' => 'About us retrieved successfully.',
            'data' => $aboutUs ? new AboutUsResource($aboutUs) : null,
        ]);
    }
}
