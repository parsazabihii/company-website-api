<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleService $roleService
    ) {}

    public function index(): JsonResponse
    {
        $roles = $this->roleService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Roles retrieved successfully.',
            'data' => RoleResource::collection($roles),
        ]);
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        $role = $this->roleService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.',
            'data' => new RoleResource($role),
        ], 201);
    }

    public function show(Role $role): JsonResponse
    {
        $role = $this->roleService->getByRole($role);

        return response()->json([
            'success' => true,
            'message' => 'Role retrieved successfully.',
            'data' => new RoleResource($role),
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $role = $this->roleService->update($role, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully.',
            'data' => new RoleResource($role),
        ]);
    }

    public function destroy(Role $role): JsonResponse
    {
        $this->roleService->delete($role);

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully.',
            'data' => null,
        ]);
    }
}
