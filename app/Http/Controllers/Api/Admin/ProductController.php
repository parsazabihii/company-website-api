<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = $this->productService->list();

        return ProductResource::collection($products)->additional([
            'success' => true,
            'message' => 'Products retrieved successfully.',
            ])->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'New product created successfully.',
            'data' => new ProductResource($product),
        ], Response::HTTP_CREATED);
    }
    /**
     * Display the specified resource.
     */
    public function show(int $product): JsonResponse
    {
        $product = $this->productService->find($product);

        return response()->json([
            'success' => true,
            'message' => 'Product retrieved successfully.',
            'data' => new ProductResource($product),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $product,): JsonResponse
    {
        $updatedProduct = $this->productService->update(id: $product, data: $request->validated(),);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => new ProductResource($updatedProduct),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $product): JsonResponse
    {
        $this->productService->delete($product);

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.',
            'data' => null,
        ]);
    }
}
