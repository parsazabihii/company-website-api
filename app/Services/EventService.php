<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function list(int $perPage = 15)
    {
        return Event::orderByDesc('event_date')->paginate($perPage);
    }

    public function find(int $id)
    {
        return Event::findOrFail($id);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function update(int $id, array $data)
    {
        $event = Event::findOrFail($id);
        $event->update($data);

        return $event;
    }

    public function delete(int $id): bool
    {
        return Event::findOrFail($id)->delete();
    }
}
