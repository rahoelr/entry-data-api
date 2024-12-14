<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class EntryInstitution extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        'nama',
        'alamat',
        'email',
        'no_kontak',
        'link_web_lembaga',
        'instagram',
        'instagram_follow',
        'facebook',
        'facebook_follow',
        'x',
        'x_follow',
        'youtube',
        'youtube_follow',
        'podcast',
        'podcast_follow',
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
        'sikap_pemerintah',
        'rekom_pendekatan_icw',
        'analisis_pengaruh',
        'kesimpulan',
        'status',
        'user_id',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
