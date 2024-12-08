<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Entryuser extends Model
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
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'email',
        'no_telp',
        'mbti',
        'data_keluarga',
        'instagram',
        'instagram_follow',
        'facebook',
        'facebook_follow',
        'linkedin',
        'linkedin_follow',
        'riwayat_parlemen',
        'riwayat_kerja',
        'jabatan_kelompok',
        'jabatan_organisasi',
        'riwayat_pendidikan',
        'riwayat_penghargaan',
        'isu_kemenkeu',
        'rekomen_pendekatan',
        'sikap_kemenkeu',
        'tingkat_pengaruh',
        'riwayat_hukum',
        'status',
        'user_id'
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
