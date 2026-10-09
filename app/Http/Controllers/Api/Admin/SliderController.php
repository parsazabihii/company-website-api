<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Http\Resources\SliderResource;
use App\Services\SliderService;
use Illuminate\Http\JsonResponse;

class SliderController extends Controller
{
    public function __construct(
        private readonly SliderService $sliderService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $sliders = $this->sliderService->list();

        return SliderResource::collection($sliders)
            ->additional([
                'success' => true,
                'message' => 'Sliders retrieved successfully.',
            ])->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request,): JsonResponse
    {
        $slider = $this->sliderService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Slider created successfully.',
            'data' => new SliderResource($slider)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $slider): JsonResponse
    {
        $slider = $this->sliderService->find($slider);

        return response()->json([
            'success' => true,
            'message' => 'Slider retrieved successfully.',
            'data' => new SliderResource($slider),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, int $slider,): JsonResponse
    {
        $updatedSlider = $this->sliderService->update(
            id: $slider,
            data: $request->validated(),
        );

        return response()->json([
            'success' => true,
            'message' => 'Slider updated successfully.',
            'data' => new SliderResource($updatedSlider),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $slider): JsonResponse
    {
        $this->sliderService->delete($slider);

        return response()->json([
            'success' => true,
            'message' => 'Slider deleted successfully.',
            'data' => null,
        ]);
    }
}
