<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamMember\StoreTeamMemberRequest;
use App\Http\Requests\TeamMember\UpdateTeamMemberRequest;
use App\Http\Resources\TeamMemberResource;
use App\Services\TeamMemberService;
use Illuminate\Http\JsonResponse;

class TeamMemberController extends Controller
{
    public function __construct(
        private readonly TeamMemberService $teamMemberService
    ) {}

    public function index(): JsonResponse
    {
        $teamMembers = $this->teamMemberService->list();

        return TeamMemberResource::collection($teamMembers)->additional
        ([
                'success' => true,
                'message' => 'Team members retrieved successfully.',
        ])->response();
    }

    public function store(StoreTeamMemberRequest $request): JsonResponse
    {
        $teamMember = $this->teamMemberService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Team member created successfully.',
            'data' => new TeamMemberResource($teamMember),
        ], 201);
    }

    public function show(int $team_member): JsonResponse
    {
        $teamMember = $this->teamMemberService->find($team_member);

        return response()->json([
            'success' => true,
            'message' => 'Team member retrieved successfully.',
            'data' => new TeamMemberResource($teamMember),
        ]);
    }

    public function update(UpdateTeamMemberRequest $request, int $team_member): JsonResponse
    {
        $teamMember = $this->teamMemberService->update($team_member, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Team member updated successfully.',
            'data' => new TeamMemberResource($teamMember),
        ]);
    }

    public function destroy(int $team_member): JsonResponse
    {
        $this->teamMemberService->delete($team_member);

        return response()->json([
            'success' => true,
            'message' => 'Team member deleted successfully.',
            'data' => null,
        ]);
    }
}
