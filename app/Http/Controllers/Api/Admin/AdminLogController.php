<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminLogResource;
use App\Models\AdminLog;
use App\Services\AdminLogService;
use Illuminate\Http\JsonResponse;


class AdminLogController extends Controller
{

    public function __construct(
        private readonly AdminLogService $adminLogService
    ) {}


    public function index(): JsonResponse
    {
        $logs = $this->adminLogService->getAll();


        return response()->json([
            'success'=>true,
            'message'=>'Admin logs retrieved successfully.',
            'data'=>AdminLogResource::collection($logs)->resolve(),
        ]);
    }



    public function show(AdminLog $adminLog): JsonResponse
    {
        $log = $this->adminLogService->getById($adminLog);


        return response()->json([
            'success'=>true,
            'message'=>'Admin log retrieved successfully.',
            'data'=>(new AdminLogResource($log))->resolve(),
        ]);
    }

}
