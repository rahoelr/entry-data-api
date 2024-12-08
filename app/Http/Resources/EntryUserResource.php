<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tempat_lahir' => $this->tempat_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'tanggal_lahir' => $this->tanggal_lahir,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'no_telp' => $this->no_telp,
            'mbti' => $this->mbti,
            'data_keluarga' => $this->data_keluarga,
            'instagram' => $this->instagram,
            'instagram_follow' => $this->instagram_follow,
            'facebook' => $this->facebook,
            'facebook_follow' => $this->facebook_follow,
            'linkedin' => $this->linkedin,
            'linkedin_follow' => $this->linkedin_follow,
            'riwayat_parlemen' => $this->riwayat_parlemen,
            'riwayat_kerja' => $this->riwayat_kerja,
            'jabatan_kelompok' => $this->jabatan_kelompok,
            'jabatan_organisasi' => $this->jabatan_organisasi,
            'riwayat_pendidikan' => $this->riwayat_pendidikan,
            'riwayat_penghargaan' => $this->riwayat_penghargaan,
            'isu_kemenkeu' => $this->isu_kemenkeu,
            'rekomen_pendekatan' => $this->rekomen_pendekatan,
            'sikap_kemenkeu' => $this->sikap_kemenkeu,
            'tingkat_pengaruh' => $this->tingkat_pengaruh,
            'riwayat_hukum' => $this->riwayat_hukum,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
