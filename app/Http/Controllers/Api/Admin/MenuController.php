<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreMenuRequest;
use App\Http\Requests\Menu\UpdateMenuRequest;
use App\Http\Resources\MenuResource;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class MenuController extends Controller
{
    public function __construct(
        private readonly MenuService $menuService,
    ) {
    }

    /**
     * Display the menu tree.
     */
    public function index(): JsonResponse
    {
        $menus = $this->menuService->tree();

        return MenuResource::collection($menus)
            ->additional([
                'success' => true,
                'message' => 'Menus retrieved successfully.',
            ])
            ->response();
    }

    /**
     * Store a newly created menu.
     */
    public function store(StoreMenuRequest $request,): JsonResponse {
        $menu = $this->menuService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Menu created successfully.',
            'data' => new MenuResource($menu),
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified menu.
     */
    public function show(int $menu): JsonResponse
    {
        $menu = $this->menuService->find($menu);

        return response()->json([
            'success' => true,
            'message' => 'Menu retrieved successfully.',
            'data' => new MenuResource($menu),
        ]);
    }

    /**
     * Update the specified menu.
     */
    public function update(UpdateMenuRequest $request, int $menu,): JsonResponse {
        $updatedMenu = $this->menuService->update(id: $menu, data: $request->validated(),);

        return response()->json([
            'success' => true,
            'message' => 'Menu updated successfully.',
            'data' => new MenuResource($updatedMenu),
        ]);
    }

    /**
     * Remove the specified menu.
     */
    public function destroy(int $menu): JsonResponse
    {
        $this->menuService->delete($menu);

        return response()->json([
            'success' => true,
            'message' => 'Menu deleted successfully.',
            'data' => null,
        ]);
    }
}
