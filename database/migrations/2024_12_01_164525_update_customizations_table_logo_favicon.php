<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->longText('logo')->change();
            $table->longText('favicon')->change();
        });
    }

    public function down(): void
    {
        Schema::table('customizations', function (Blueprint $table) {
            $table->string('logo')->change();
            $table->string('favicon')->change();
        });
    }
};
