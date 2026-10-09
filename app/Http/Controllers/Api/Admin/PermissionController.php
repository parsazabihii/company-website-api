<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StorePermissionRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    public function __construct(
        private readonly PermissionService $permissionService
    ) {}

    public function index(): JsonResponse
    {
        $permissions = $this->permissionService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Permissions retrieved successfully.',
            'data' => PermissionResource::collection($permissions),
        ]);
    }

    public function store(StorePermissionRequest $request): JsonResponse
    {
        $permission = $this->permissionService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Permission created successfully.',
            'data' => new PermissionResource($permission),
        ], 201);
    }

    public function show(Permission $permission): JsonResponse
    {
        $permission = $this->permissionService->getByPermission($permission);

        return response()->json([
            'success' => true,
            'message' => 'Permission retrieved successfully.',
            'data' => new PermissionResource($permission),
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission = $this->permissionService->update($permission, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Permission updated successfully.',
            'data' => new PermissionResource($permission),
        ]);
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $this->permissionService->delete($permission);

        return response()->json([
            'success' => true,
            'message' => 'Permission deleted successfully.',
            'data' => null,
        ]);
    }
}
