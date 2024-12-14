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
            $fields = [
                'e_commerce',
                'latar_belakang',
                'visi_misi',
                'profil_pendiri',
                'profil_pengurus',
                'keanggotaan',
                'prominent_kol',
                'bidang_usaha_gerak',
                'isu_diangkat',
                'pengamat_rujukan',
                'afiliasi_ngo_parpol',
                'pengaruh_masyarakat',
                'pihak_belakang_ngo',
                'sumber_dana',
                'jumlah_cabang_anggota',
                'segmentasi_dasar',
            ];

            foreach ($fields as $field) {
                $table->text($field)->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entry_institutions', function (Blueprint $table) {
            $fields = [
                'e_commerce',
                'latar_belakang',
                'visi_misi',
                'profil_pendiri',
                'profil_pengurus',
                'keanggotaan',
                'prominent_kol',
                'bidang_usaha_gerak',
                'isu_diangkat',
                'pengamat_rujukan',
                'afiliasi_ngo_parpol',
                'pengaruh_masyarakat',
                'pihak_belakang_ngo',
                'sumber_dana',
                'jumlah_cabang_anggota',
                'segmentasi_dasar',
            ];

            foreach ($fields as $field) {
                $table->integer($field)->nullable()->change();
            }
        });
    }
};
