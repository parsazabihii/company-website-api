<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reply_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_id')->constrained('client_reviews')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->text('reply');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reply_reviews');
    }
};
