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
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();         // Path untuk logo
            $table->string('favicon')->nullable();      // Path untuk favicon
            $table->string('primary_color')->default('#FFFFFF');  // Warna utama
            $table->string('secondary_color')->default('#000000'); // Warna kedua
            $table->string('third_color')->default('#CCCCCC');    // Warna ketiga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
