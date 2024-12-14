<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryInstitutionResource extends JsonResource
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
            'alamat' => $this->alamat,
            'email' => $this->email,
            'no_kontak' => $this->no_kontak,
            'link_web_lembaga' => $this->link_web_lembaga,
            'instagram' => $this->instagram,
            'instagram_follow' => $this->instagram_follow,
            'facebook' => $this->facebook,
            'facebook_follow' => $this->facebook_follow,
            'x' => $this->x,
            'x_follow' => $this->x_follow,
            'youtube' => $this->youtube,
            'youtube_follow' => $this->youtube_follow,
            'podcast' => $this->podcast,
            'podcast_follow' => $this->podcast_follow,
            'e_commerce' => $this->e_commerce,
            'latar_belakang' => $this->latar_belakang,
            'visi_misi' => $this->visi_misi,
            'profil_pendiri' => $this->profil_pendiri,
            'profil_pengurus' => $this->profil_pengurus,
            'keanggotaan' => $this->keanggotaan,
            'prominent_kol' => $this->prominent_kol,
            'bidang_usaha_gerak' => $this->bidang_usaha_gerak,
            'isu_diangkat' => $this->isu_diangkat,
            'pengamat_rujukan' => $this->pengamat_rujukan,
            'afiliasi_ngo_parpol' => $this->afiliasi_ngo_parpol,
            'pengaruh_masyarakat' => $this->pengaruh_masyarakat,
            'pihak_belakang_ngo' => $this->pihak_belakang_ngo,
            'sumber_dana' => $this->sumber_dana,
            'jumlah_cabang_anggota' => $this->jumlah_cabang_anggota,
            'segmentasi_dasar' => $this->segmentasi_dasar,
            'sikap_pemerintah' => $this->sikap_pemerintah,
            'rekom_pendekatan_icw' => $this->rekom_pendekatan_icw,
            'analisis_pengaruh' => $this->analisis_pengaruh,
            'kesimpulan' => $this->kesimpulan,
            'status' => $this->status,
            'user_id' => $this->user_id,
        ];
    }
}
