<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteSetting\StoreSiteSettingRequest;
use App\Http\Requests\SiteSetting\UpdateSiteSettingRequest;
use App\Http\Resources\SiteSettingResource;
use App\Models\SiteSetting;
use App\Services\SiteSettingService;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends Controller
{
    public function __construct(
        private readonly SiteSettingService $siteSettingService
    ) {}


    public function index(): JsonResponse
    {
        $settings = $this->siteSettingService->getAll();

        return response()->json([
            'success' => true,
            'message' => 'Site settings retrieved successfully.',
            'data' => SiteSettingResource::collection($settings)->resolve(),
        ]);
    }


    public function store(
        StoreSiteSettingRequest $request
    ): JsonResponse {

        $setting = $this->siteSettingService
            ->create($request->validated());


        return response()->json([
            'success' => true,
            'message' => 'Site setting created successfully.',
            'data' => (new SiteSettingResource($setting))->resolve(),
        ], 201);
    }


    public function show(
        SiteSetting $siteSetting
    ): JsonResponse {

        return response()->json([
            'success' => true,
            'message' => 'Site setting retrieved successfully.',
            'data' => (new SiteSettingResource($siteSetting))->resolve(),
        ]);
    }


    public function update(
        UpdateSiteSettingRequest $request,
        SiteSetting $siteSetting
    ): JsonResponse {

        $setting = $this->siteSettingService->update(
            $siteSetting,
            $request->validated()
        );


        return response()->json([
            'success' => true,
            'message' => 'Site setting updated successfully.',
            'data' => (new SiteSettingResource($setting))->resolve(),
        ]);
    }


    public function destroy(
        SiteSetting $siteSetting
    ): JsonResponse {

        $this->siteSettingService->delete($siteSetting);

        return response()->json([
            'success' => true,
            'message' => 'Site setting deleted successfully.',
            'data' => null,
        ]);
    }
}
