<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entryusers', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('linkedin_follow');
            $table->integer('tiktok_follow')->nullable()->after('tiktok');
            $table->string('x')->nullable()->after('tiktok_follow');
            $table->integer('x_follow')->nullable()->after('x');
            $table->string('youtube')->nullable()->after('x_follow');
            $table->integer('youtube_follow')->nullable()->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entryusers', function (Blueprint $table) {
            $table->dropColumn(['tiktok', 'tiktok_follow', 'x', 'x_follow', 'youtube', 'youtube_follow']);
        });
    }
};
