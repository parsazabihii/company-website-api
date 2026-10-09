<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubBrand\StoreSubBrandRequest;
use App\Http\Requests\SubBrand\UpdateSubBrandRequest;
use App\Http\Resources\SubBrandResource;
use App\Models\SubBrand;
use App\Services\SubBrandService;
use Illuminate\Http\JsonResponse;

class SubBrandController extends Controller
{
    public function __construct(
        private readonly SubBrandService $subBrandService
    ) {}


    public function index(): JsonResponse
    {
        $subBrands = $this->subBrandService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Sub brands retrieved successfully.',
            'data' => SubBrandResource::collection($subBrands)->resolve(),
        ]);
    }


    public function store(
        StoreSubBrandRequest $request
    ): JsonResponse {

        $subBrand = $this->subBrandService
            ->create($request->validated());


        return response()->json([
            'success' => true,
            'message' => 'Sub brand created successfully.',
            'data' => (new SubBrandResource($subBrand))->resolve(),
        ], 201);
    }



    public function show(
        SubBrand $subBrand
    ): JsonResponse {

        $subBrand = $this->subBrandService
            ->getById($subBrand);


        return response()->json([
            'success' => true,
            'message' => 'Sub brand retrieved successfully.',
            'data' => (new SubBrandResource($subBrand))->resolve(),
        ]);
    }



    public function update(
        UpdateSubBrandRequest $request,
        SubBrand $subBrand
    ): JsonResponse {


        $subBrand = $this->subBrandService
            ->update(
                $subBrand,
                $request->validated()
            );


        return response()->json([
            'success' => true,
            'message' => 'Sub brand updated successfully.',
            'data' => (new SubBrandResource($subBrand))->resolve(),
        ]);
    }



    public function destroy(
        SubBrand $subBrand
    ): JsonResponse {

        $this->subBrandService
            ->delete($subBrand);


        return response()->json([
            'success' => true,
            'message' => 'Sub brand deleted successfully.',
            'data' => null,
        ]);
    }
}
