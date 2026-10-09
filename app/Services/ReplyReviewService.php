<?php

namespace App\Services;

use App\Models\ClientReview;
use App\Models\ReplyReview;
use Illuminate\Database\Eloquent\Collection;

class ReplyReviewService
{
    public function list(int $reviewId): Collection
    {
        return ReplyReview::query()
            ->where('review_id', $reviewId)
            ->latest()
            ->get();
    }

    public function find(int $reviewId, int $replyId): ReplyReview
    {
        return ReplyReview::query()
            ->where('review_id', $reviewId)
            ->findOrFail($replyId);
    }

    public function create(
        int $reviewId,
        int $userId,
        array $data
    ): ReplyReview {
        $review = ClientReview::query()->findOrFail($reviewId);

        return $review->replies()->create([
            'user_id' => $userId,
            'reply' => $data['reply'],
        ]);
    }

    public function update(
        int $reviewId,
        int $replyId,
        array $data
    ): ReplyReview {
        $reply = $this->find($reviewId, $replyId);

        $reply->update($data);

        return $reply->refresh();
    }

    public function delete(
        int $reviewId,
        int $replyId
    ): bool {
        $reply = $this->find($reviewId, $replyId);

        return (bool) $reply->delete();
    }
}
