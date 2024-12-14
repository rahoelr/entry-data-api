<?php

namespace App\Http\Controllers;

use App\Models\Entryuser;
use App\Classes\ApiResponse;
use App\Http\Resources\EntryUserResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class EntryuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // // Get the desired number of items per page from the query parameter

            $entries = Entryuser::paginate(10);

            return ApiResponse::success(
                [
                    'data' => EntryUserResource::collection($entries->items()),
                    'pagination' => [
                        'current_page' => $entries->currentPage(),
                        'last_page' => $entries->lastPage(),
                        'per_page' => $entries->perPage(),
                        'total' => $entries->total(),
                    ],
                ],
                'Daftar entry user berhasil diambil'
            );
        } catch (\Exception $e) {
            Log::error('Error fetching user list: ' . $e->getMessage());

            return ApiResponse::error(
                'Gagal mengambil daftar entry user',
                500,
                ['exception' => $e->getMessage()]
            );
        }
    }

    public function showByUserId($userId)
    {
        try {
            $entries = Entryuser::where('user_id', $userId)->paginate(10);

            return ApiResponse::success(
                [
                    'data' => EntryUserResource::collection($entries->items()),
                    'pagination' => [
                        'current_page' => $entries->currentPage(),
                        'last_page' => $entries->lastPage(),
                        'per_page' => $entries->perPage(),
                        'total' => $entries->total(),
                    ],
                ],
                'Daftar entry user berhasil diambil'
            );
        } catch (\Exception $e) {
            Log::error('Error fetching user entries: ' . $e->getMessage());

            return ApiResponse::error(
                'Gagal mengambil daftar entry user',
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
                'nama' => 'nullable|string|max:255',
                'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
                'tempat_lahir' => 'nullable|string|max:65535',
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:65535',
                'email' => 'nullable|email|max:255',
                'no_telp' => 'nullable|string|max:20',
                'mbti' => 'nullable|string|max:4',
                'data_keluarga' => 'nullable|string|max:65535',
                'instagram' => 'nullable|string|max:255',
                'instagram_follow' => 'nullable|integer|min:0',
                'facebook' => 'nullable|string|max:255',
                'facebook_follow' => 'nullable|integer|min:0',
                'linkedin' => 'nullable|string|max:255',
                'linkedin_follow' => 'nullable|integer|min:0',
                'riwayat_parlemen' => 'nullable|string|max:65535',
                'riwayat_kerja' => 'nullable|string|max:65535',
                'jabatan_kelompok' => 'nullable|string|max:65535',
                'jabatan_organisasi' => 'nullable|string|max:65535',
                'riwayat_pendidikan' => 'nullable|string|max:65535',
                'riwayat_penghargaan' => 'nullable|string|max:65535',
                'isu_kemenkeu' => 'nullable|string|max:65535',
                'rekomen_pendekatan' => 'nullable|string|max:65535',
                'sikap_kemenkeu' => 'nullable|string|max:65535',
                'tingkat_pengaruh' => 'nullable|string|max:65535',
                'riwayat_hukum' => 'nullable|string|max:65535',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $validatedData['status'] = 'waiting';

            $entries = Entryuser::create([
                ...$validatedData,
            ]);

            return ApiResponse::success(
                new EntryUserResource($entries),
                'Entry user berhasil dibuat',
                201
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Gagal membuat entry user. Terjadi kesalahan sistem.',
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
            $entryuser = Entryuser::findOrFail($id);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengambil data entry user.',
                'data' => new EntryUserResource($entryuser),
            ]);
        } catch (\Exception $e) {
            return ApiResponse::error('Entry user tidak ditemukan', 404);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Entryuser $entryuser)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $entryuser = Entryuser::find($id);

            if (!$entryuser) {
                return ApiResponse::error('Data entry user tidak ditemukan', 404);
            }

            $validatedData = $request->validate([
                'nama' => 'nullable|string|max:255',
                'jenis_kelamin' => ['nullable', Rule::in(['L', 'P'])],
                'tempat_lahir' => 'nullable|string|max:65535',
                'tanggal_lahir' => 'nullable|date',
                'alamat' => 'nullable|string|max:65535',
                'email' => 'nullable|email|max:255',
                'no_telp' => 'nullable|string|max:20',
                'mbti' => 'nullable|string|max:4',
                'data_keluarga' => 'nullable|string|max:65535',
                'instagram' => 'nullable|string|max:255',
                'instagram_follow' => 'nullable|integer|min:0',
                'facebook' => 'nullable|string|max:255',
                'facebook_follow' => 'nullable|integer|min:0',
                'linkedin' => 'nullable|string|max:255',
                'linkedin_follow' => 'nullable|integer|min:0',
                'riwayat_parlemen' => 'nullable|string|max:65535',
                'riwayat_kerja' => 'nullable|string|max:65535',
                'jabatan_kelompok' => 'nullable|string|max:65535',
                'jabatan_organisasi' => 'nullable|string|max:65535',
                'riwayat_pendidikan' => 'nullable|string|max:65535',
                'riwayat_penghargaan' => 'nullable|string|max:65535',
                'isu_kemenkeu' => 'nullable|string|max:65535',
                'rekomen_pendekatan' => 'nullable|string|max:65535',
                'sikap_kemenkeu' => 'nullable|string|max:65535',
                'tingkat_pengaruh' => 'nullable|string|max:65535',
                'riwayat_hukum' => 'nullable|string|max:65535',
                'user_id' => 'nullable|exists:users,id',
            ]);

            $entryuser->update(array_filter($validatedData));

            return ApiResponse::success(
                new EntryUserResource($entryuser),
                'Data entry user berhasil diubah'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal mengubah data entry user', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $entryuser = Entryuser::find($id);

            if (!$entryuser) {
                return ApiResponse::error('Data entry user tidak ditemukan', 404);
            }

            $validatedData = $request->validate([
                'status' => 'required|in:accepted,waiting,rejected',
            ]);

            $entryuser->update([
                'status' => $validatedData['status'],
            ]);

            return ApiResponse::success(
                new EntryUserResource($entryuser),
                'Status entry user berhasil diubah'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal mengubah status entry user', 500, ['exception' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $entryuser = Entryuser::findOrFail($id);
            $entryuser->delete();

            return ApiResponse::success(null, 'Data entry user berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            // Return a custom error message for a non-existent Entryuser
            return ApiResponse::error('Data entry user tidak ditemukan', 404);
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal menghapus data entry user', 500, ['exception' => $e->getMessage()]);
        }
    }
}
