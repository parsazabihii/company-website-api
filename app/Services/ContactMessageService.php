<?php

namespace App\Services;

use App\Models\ContactMessage;
use Illuminate\Pagination\LengthAwarePaginator;
use RuntimeException;

class ContactMessageService
{
    public function list(int $perPage = 15): LengthAwarePaginator
    {
        return ContactMessage::query()
            ->latest()
            ->paginate($perPage);
    }

    public function find(int $id): ContactMessage
    {
        return ContactMessage::query()->findOrFail($id);
    }

    public function create(array $data): ContactMessage
    {
        $data['status'] = 0;

        return ContactMessage::query()->create($data);
    }

    public function updateStatus(
        int $id,
        int $status
    ): ContactMessage {
        $message = ContactMessage::query()->findOrFail($id);

        $updated = $message->update([
            'status' => $status,
        ]);

        if (!$updated) {
            throw new RuntimeException(
                'Failed to update the contact message status.'
            );
        }

        return $message->refresh();
    }

    public function delete(int $id): bool
    {
        $message = ContactMessage::query()->findOrFail($id);

        $deleted = $message->delete();

        if (!$deleted) {
            throw new RuntimeException(
                'Failed to delete the contact message.'
            );
        }

        return true;
    }
}
