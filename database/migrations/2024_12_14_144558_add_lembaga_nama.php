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
        Schema::table('entry_institutions', function (Blueprint $table) {
            $table->string('nama')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entry_institutions', function (Blueprint $table) {
            $table->dropColumn('nama'); // Drops the 'nama' column
        });
    }
};
