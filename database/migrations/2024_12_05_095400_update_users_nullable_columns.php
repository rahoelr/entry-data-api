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
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->change(); // Ubah kolom name menjadi nullable
            $table->string('email')->nullable()->change(); // Ubah kolom email menjadi nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change(); // Kembalikan kolom name menjadi non-nullable
            $table->string('email')->nullable(false)->change(); // Kembalikan kolom email menjadi non-nullable
        });
    }
};
