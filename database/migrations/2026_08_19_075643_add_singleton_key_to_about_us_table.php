<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
//        Schema::table('about_us', function (Blueprint $table) {
//            $table->string('singleton_key')
//                ->default('about_us')
//                ->unique();
//        });
    }

    public function down(): void
    {
//        Schema::table('about_us', function (Blueprint $table) {
//            $table->dropUnique(['singleton_key']);
//            $table->dropColumn('singleton_key');
//        });
    }
};
