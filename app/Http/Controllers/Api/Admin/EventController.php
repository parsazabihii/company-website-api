<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Event\StoreEventRequest;
use App\Http\Requests\Event\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function __construct(
        protected EventService $eventService
    ) {
    }


    public function index(): JsonResponse
    {
        $events = $this->eventService->list();

        return response()->json([
            'success' => true,
            'message' => 'Events retrieved successfully',
            'data' => EventResource::collection($events),
        ]);
    }


    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = $this->eventService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully',
            'data' => new EventResource($event),
        ], 201);
    }


    public function show(int $id): JsonResponse
    {
        $event = $this->eventService->find($id);

        return response()->json([
            'success' => true,
            'message' => 'Event retrieved successfully',
            'data' => new EventResource($event),
        ]);
    }


    public function update(UpdateEventRequest $request, int $id): JsonResponse {

        $event = $this->eventService->update($id, $request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully',
            'data' => new EventResource($event),
        ]);
    }


    public function destroy(int $id): JsonResponse
    {
        $this->eventService->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully',
        ]);
    }
}
