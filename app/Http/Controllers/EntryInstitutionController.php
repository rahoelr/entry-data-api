<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponse;
use App\Http\Resources\EntryInstitutionResource;
use App\Models\EntryInstitution;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EntryInstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // // Get the desired number of items per page from the query parameter

            $entries = EntryInstitution::paginate(10);

            return ApiResponse::success(
                [
                    'data' => EntryInstitutionResource::collection($entries->items()),
                    'pagination' => [
                        'current_page' => $entries->currentPage(),
                        'last_page' => $entries->lastPage(),
                        'per_page' => $entries->perPage(),
                        'total' => $entries->total(),
                    ],
                ],
                'Daftar entry lembaga berhasil diambil'
            );
        } catch (\Exception $e) {
            Log::error('Error fetching institution list: ' . $e->getMessage());

            return ApiResponse::error(
                'Gagal mengambil daftar entry lembaga',
                500,
                ['exception' => $e->getMessage()]
            );
        }
    }

    public function showByUserId($userId)
    {
        try {
            $entries = EntryInstitution::where('user_id', $userId)->paginate(10);

            return ApiResponse::success(
                [
                    'data' => EntryInstitutionResource::collection($entries->items()),
                    'pagination' => [
                        'current_page' => $entries->currentPage(),
                        'last_page' => $entries->lastPage(),
                        'per_page' => $entries->perPage(),
                        'total' => $entries->total(),
                    ],
                ],
                'Daftar entry lembaga berhasil diambil'
            );
        } catch (\Exception $e) {
            Log::error('Error fetching institution entries: ' . $e->getMessage());

            return ApiResponse::error(
                'Gagal mengambil daftar entry lembaga',
                500,
                ['exception' => $e->getMessage()]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'alamat' => 'nullable|string|max:65535',
                'email' => 'nullable|email|max:255',
                'no_kontak' => 'nullable|string|max:20',
                'link_web_lembaga' => 'nullable|url|max:255',
                'instagram' => 'nullable|string|max:255',
                'instagram_follow' => 'nullable|integer|min:0',
                'facebook' => 'nullable|string|max:255',
                'facebook_follow' => 'nullable|integer|min:0',
                'x' => 'nullable|string|max:255',
                'x_follow' => 'nullable|integer|min:0',
                'youtube' => 'nullable|string|max:255',
                'youtube_follow' => 'nullable|integer|min:0',
                'podcast' => 'nullable|string|max:255',
                'podcast_follow' => 'nullable|integer|min:0',
                'e_commerce' => 'nullable|integer|min:0',
                'latar_belakang' => 'nullable|string|max:65535',
                'visi_misi' => 'nullable|string|max:65535',
                'profil_pendiri' => 'nullable|string|max:65535',
                'profil_pengurus' => 'nullable|string|max:65535',
                'keanggotaan' => 'nullable|string|max:65535',
                'prominent_kol' => 'nullable|string|max:65535',
                'bidang_usaha_gerak' => 'nullable|string|max:65535',
                'isu_diangkat' => 'nullable|string|max:65535',
                'pengamat_rujukan' => 'nullable|string|max:65535',
                'afiliasi_ngo_parpol' => 'nullable|string|max:65535',
                'pengaruh_masyarakat' => 'nullable|string|max:65535',
                'pihak_belakang_ngo' => 'nullable|string|max:65535',
                'sumber_dana' => 'nullable|string|max:65535',
                'jumlah_cabang_anggota' => 'nullable|string|max:65535',
                'segmentasi_dasar' => 'nullable|string|max:65535',
                'sikap_pemerintah' => 'nullable|string|max:65535',
                'rekom_pendekatan_icw' => 'nullable|string|max:65535',
                'analisis_pengaruh' => 'nullable|string|max:65535',
                'kesimpulan' => 'nullable|string|max:65535',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $validatedData['status'] = 'waiting';

            $entries = EntryInstitution::create([
                ...$validatedData,
            ]);

            return ApiResponse::success(
                new EntryInstitutionResource($entries),
                'Entry lembaga berhasil dibuat',
                201
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Gagal membuat entry lembaga. Terjadi kesalahan sistem.',
                500,
                ['exception' => $e->getMessage()]
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $entryInstitution = EntryInstitution::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Entry user retrieved successfully.',
                'data' => new EntryInstitutionResource($entryInstitution),
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error('Entry user tidak ditemukan', 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(EntryInstitution $entryInstitution)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $entryInstitution = EntryInstitution::find($id);

            if (!$entryInstitution) {
                return ApiResponse::error('Data entry lembaga tidak ditemukan', 404);
            }

            $validatedData = $request->validate([
                'alamat' => 'nullable|string|max:65535',
                'email' => 'nullable|email|max:255',
                'no_kontak' => 'nullable|string|max:20',
                'link_web_lembaga' => 'nullable|url|max:255',
                'instagram' => 'nullable|string|max:255',
                'instagram_follow' => 'nullable|integer|min:0',
                'facebook' => 'nullable|string|max:255',
                'facebook_follow' => 'nullable|integer|min:0',
                'x' => 'nullable|string|max:255',
                'x_follow' => 'nullable|integer|min:0',
                'youtube' => 'nullable|string|max:255',
                'youtube_follow' => 'nullable|integer|min:0',
                'podcast' => 'nullable|string|max:255',
                'podcast_follow' => 'nullable|integer|min:0',
                'e_commerce' => 'nullable|integer|min:0',
                'latar_belakang' => 'nullable|string|max:65535',
                'visi_misi' => 'nullable|string|max:65535',
                'profil_pendiri' => 'nullable|string|max:65535',
                'profil_pengurus' => 'nullable|string|max:65535',
                'keanggotaan' => 'nullable|string|max:65535',
                'prominent_kol' => 'nullable|string|max:65535',
                'bidang_usaha_gerak' => 'nullable|string|max:65535',
                'isu_diangkat' => 'nullable|string|max:65535',
                'pengamat_rujukan' => 'nullable|string|max:65535',
                'afiliasi_ngo_parpol' => 'nullable|string|max:65535',
                'pengaruh_masyarakat' => 'nullable|string|max:65535',
                'pihak_belakang_ngo' => 'nullable|string|max:65535',
                'sumber_dana' => 'nullable|string|max:65535',
                'jumlah_cabang_anggota' => 'nullable|string|max:65535',
                'segmentasi_dasar' => 'nullable|string|max:65535',
                'sikap_pemerintah' => 'nullable|string|max:65535',
                'rekom_pendekatan_icw' => 'nullable|string|max:65535',
                'analisis_pengaruh' => 'nullable|string|max:65535',
                'kesimpulan' => 'nullable|string|max:65535',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $entryInstitution->update(array_filter($validatedData));

            return ApiResponse::success(
                new EntryInstitutionResource($entryInstitution),
                'Data entry lembaga berhasil diubah'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal mengubah data entry lembaga', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $entryInstitution = EntryInstitution::find($id);

            if (!$entryInstitution) {
                return ApiResponse::error('Data entry lembaga tidak ditemukan', 404);
            }

            $validatedData = $request->validate([
                'status' => 'required|in:accepted,waiting,rejected',
            ]);

            $entryInstitution->update([
                'status' => $validatedData['status'],
            ]);

            return ApiResponse::success(
                new EntryInstitutionResource($entryInstitution),
                'Status entry lembaga berhasil diubah'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal mengubah status entry lembaga', 500, ['exception' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $entryInstitution = EntryInstitution::find($id);
            $entryInstitution->delete();

            return ApiResponse::success(null, 'Data entry user berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            // Return a custom error message for a non-existent Entryuser
            return ApiResponse::error('Data entry lembaga tidak ditemukan', 404);
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal menghapus data entry lembaga', 500, ['exception' => $e->getMessage()]);
        }
    }
}
