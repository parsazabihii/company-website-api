<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\License\StoreLicenseRequest;
use App\Http\Requests\License\UpdateLicenseRequest;
use App\Http\Resources\LicenseResource;
use App\Services\LicenseService;
use Illuminate\Http\JsonResponse;

class LicenseController extends Controller
{
    public function __construct(
        protected LicenseService $licenseService
    ) {
    }


    public function index(): JsonResponse
    {
        $licenses = $this->licenseService->list();

        return response()->json([
            'success' => true,
            'message' => 'Licenses retrieved successfully',
            'data' => LicenseResource::collection($licenses),
        ]);
    }


    public function store(StoreLicenseRequest $request): JsonResponse
    {
        $license = $this->licenseService->create(
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'License created successfully',
            'data' => new LicenseResource($license),
        ], 201);
    }


    public function show(int $id): JsonResponse
    {
        $license = $this->licenseService->find($id);

        return response()->json([
            'success' => true,
            'message' => 'License retrieved successfully',
            'data' => new LicenseResource($license),
        ]);
    }


    public function update(
        UpdateLicenseRequest $request,
        int $id
    ): JsonResponse {

        $license = $this->licenseService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'success' => true,
            'message' => 'License updated successfully',
            'data' => new LicenseResource($license),
        ]);
    }


    public function destroy(int $id): JsonResponse
    {
        $this->licenseService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'License deleted successfully',
        ]);
    }
}
