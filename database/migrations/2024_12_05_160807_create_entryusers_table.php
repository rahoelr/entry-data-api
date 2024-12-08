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
        Schema::create('entryusers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->text('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp', 20)->nullable();
            $table->string('mbti', 4)->nullable();
            $table->text('data_keluarga')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('instagram_follow')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('facebook_follow')->nullable();
            $table->string('linkedin')->nullable();
            $table->integer('linkedin_follow')->nullable();
            $table->text('riwayat_parlemen')->nullable();
            $table->text('riwayat_kerja')->nullable();
            $table->text('jabatan_kelompok')->nullable();
            $table->text('jabatan_organisasi')->nullable();
            $table->text('riwayat_pendidikan')->nullable();
            $table->text('riwayat_penghargaan')->nullable();
            $table->text('isu_kemenkeu')->nullable();
            $table->text('rekomen_pendekatan')->nullable();
            $table->text('sikap_kemenkeu')->nullable();
            $table->text('tingkat_pengaruh')->nullable();
            $table->text('riwayat_hukum')->nullable();
            $table->enum('status', ['waiting', 'accepted', 'rejected'])->default('waiting');
            $table->timestamps();
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entryusers');
    }
};
