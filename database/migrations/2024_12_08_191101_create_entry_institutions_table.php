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
        Schema::create('entry_institutions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('no_kontak', 20)->nullable();
            $table->string('link_web_lembaga')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('instagram_follow')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('facebook_follow')->nullable();
            $table->string('x')->nullable();
            $table->integer('x_follow')->nullable();
            $table->string('youtube')->nullable();
            $table->integer('youtube_follow')->nullable();
            $table->string('podcast')->nullable();
            $table->integer('podcast_follow')->nullable();
            $table->integer('e_commerce')->nullable();
            $table->integer('latar_belakang')->nullable();
            $table->integer('visi_misi')->nullable();
            $table->integer('profil_pendiri')->nullable();
            $table->integer('profil_pengurus')->nullable();
            $table->integer('keanggotaan')->nullable();
            $table->integer('prominent_kol')->nullable();
            $table->integer('bidang_usaha_gerak')->nullable();
            $table->integer('isu_diangkat')->nullable();
            $table->integer('pengamat_rujukan')->nullable();
            $table->integer('afiliasi_ngo_parpol')->nullable();
            $table->integer('pengaruh_masyarakat')->nullable();
            $table->integer('pihak_belakang_ngo')->nullable();
            $table->integer('sumber_dana')->nullable();
            $table->integer('jumlah_cabang_anggota')->nullable();
            $table->integer('segmentasi_dasar')->nullable();
            $table->text('sikap_pemerintah')->nullable();
            $table->text('rekom_pendekatan_icw')->nullable();
            $table->text('analisis_pengaruh')->nullable();
            $table->text('kesimpulan')->nullable();
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
        Schema::dropIfExists('entry_institutions');
    }
};
