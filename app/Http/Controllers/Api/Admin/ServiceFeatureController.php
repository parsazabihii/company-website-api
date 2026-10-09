<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceFeatureRequest;
use App\Http\Requests\Service\UpdateServiceFeatureRequest;
use App\Http\Resources\ServiceFeatureResource;
use App\Models\Service;
use App\Models\ServiceFeature;
use App\Services\ServiceFeatureService;
use Illuminate\Http\JsonResponse;

class ServiceFeatureController extends Controller
{
    public function __construct(
        private readonly ServiceFeatureService $serviceFeatureService
    ) {
    }

    /**
     * Display all features belonging to the service.
     */
    public function index(Service $service): JsonResponse
    {
        $serviceFeatures = $this->serviceFeatureService->getAll($service);

        return response()->json([
            'success' => true,
            'message' => 'Service features retrieved successfully.',
            'data' => ServiceFeatureResource::collection($serviceFeatures),
        ]);
    }

    /**
     * Store a newly created feature for the service.
     */
    public function store(StoreServiceFeatureRequest $request, Service $service): JsonResponse {
        $serviceFeature = $this->serviceFeatureService->create(
            $service,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Service feature created successfully.',
            'data' => new ServiceFeatureResource($serviceFeature),
        ], 201);
    }

    /**
     * Display the specified service feature.
     */
    public function show(
        Service $service,
        ServiceFeature $feature
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => 'Service feature retrieved successfully.',
            'data' => new ServiceFeatureResource($feature),
        ]);
    }

    /**
     * Update the specified service feature.
     */
    public function update(
        UpdateServiceFeatureRequest $request,
        Service $service,
        ServiceFeature $feature
    ): JsonResponse {
        $feature = $this->serviceFeatureService->update(
            $feature,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Service feature updated successfully.',
            'data' => new ServiceFeatureResource($feature),
        ]);
    }

    public function destroy(
        Service $service,
        ServiceFeature $feature
    ): JsonResponse {
        $this->serviceFeatureService->delete($feature);

        return response()->json([
            'success' => true,
            'message' => 'Service feature deleted successfully.',
            'data' => null,
        ]);
    }
}
