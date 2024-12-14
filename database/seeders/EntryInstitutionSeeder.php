<?php

namespace Database\Seeders;

use App\Models\EntryInstitution;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EntryInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $statuses = ['waiting', 'accepted', 'rejected'];

        foreach (range(1, 10) as $index) {
            EntryInstitution::create([
                'nama' => $faker->name,
                'alamat' => $faker->address,
                'email' => $faker->unique()->safeEmail,
                'no_kontak' => $faker->numerify('08##########'),
                'link_web_lembaga' => $faker->url,
                'instagram' => $faker->userName,
                'instagram_follow' => $faker->numberBetween(100, 10000),
                'facebook' => $faker->userName,
                'facebook_follow' => $faker->numberBetween(100, 10000),
                'x' => $faker->userName,
                'x_follow' => $faker->numberBetween(100, 10000),
                'youtube' => $faker->userName,
                'youtube_follow' => $faker->numberBetween(100, 10000),
                'podcast' => $faker->userName,
                'podcast_follow' => $faker->numberBetween(100, 10000),
                'e_commerce' => $faker->userName,
                'latar_belakang' => $faker->paragraph,
                'visi_misi' => $faker->paragraph,
                'profil_pendiri' => $faker->paragraph,
                'profil_pengurus' => $faker->paragraph,
                'keanggotaan' => $faker->paragraph,
                'prominent_kol' => $faker->paragraph,
                'bidang_usaha_gerak' => $faker->paragraph,
                'isu_diangkat' => $faker->paragraph,
                'pengamat_rujukan' => $faker->paragraph,
                'afiliasi_ngo_parpol' => $faker->paragraph,
                'pengaruh_masyarakat' => $faker->paragraph,
                'pihak_belakang_ngo' => $faker->paragraph,
                'sumber_dana' => $faker->paragraph,
                'jumlah_cabang_anggota' => $faker->sentence(5),
                'segmentasi_dasar' => $faker->paragraph,
                'sikap_pemerintah' => $faker->sentence,
                'rekom_pendekatan_icw' => $faker->sentence,
                'analisis_pengaruh' => $faker->sentence,
                'kesimpulan' => $faker->sentence,
                'status' => $statuses[array_rand($statuses)],
                'user_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
