<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Services\ServiceService;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    public function __construct(
        private readonly ServiceService $serviceService
    ) {}

    public function index(): JsonResponse
    {
        $services = $this->serviceService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Services retrieved successfully.',
            'data' => ServiceResource::collection($services)->resolve(),
        ]);
    }

    public function store(StoreServiceRequest $request): JsonResponse
    {
        $service = $this->serviceService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Service created successfully.',
            'data' => (new ServiceResource($service))->resolve(),
        ], 201);
    }

    public function show(Service $service): JsonResponse
    {
        $service = $this->serviceService->getById($service);

        return response()->json([
            'success' => true,
            'message' => 'Service retrieved successfully.',
            'data' => (new ServiceResource($service))->resolve(),
        ]);
    }

    public function update(
        UpdateServiceRequest $request,
        Service $service
    ): JsonResponse {
        $service = $this->serviceService->update(
            $service,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'Service updated successfully.',
            'data' => (new ServiceResource($service))->resolve(),
        ]);
    }

    public function destroy(Service $service): JsonResponse
    {
        $this->serviceService->delete($service);

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully.',
            'data' => null,
        ]);
    }
}
