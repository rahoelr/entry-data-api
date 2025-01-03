<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('entryusers', function (Blueprint $table) {
            $table->longText('mbti')->change();
        });
    }

    public function down(): void
    {
        Schema::table('entryusers', function (Blueprint $table) {
            $table->string('mbti', 4)->nullable()->change();
        });
    }
};
