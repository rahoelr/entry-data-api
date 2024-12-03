<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('customizations');
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->longText('logo')->nullable();
            $table->longText('favicon')->nullable();
            $table->string('primary')->default('#605BFF');
            $table->string('secondary')->default('#0086C9');
            $table->string('tersier')->default('#0B1437');
            $table->string('active_color')->default('primary_color');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
