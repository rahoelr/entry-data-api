<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserManagementResource;
use App\Classes\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();

            return ApiResponse::success(
                UserManagementResource::collection($users),
                'Daftar pengguna berhasil diambil'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal mengambil daftar pengguna', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|unique:users',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:8',
                'role' => 'required|in:data_entry,user_kementerian,manager',
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => $request->status ?? 'active',
            ]);

            return ApiResponse::success(
                new UserManagementResource($user),
                'Akun berhasil dibuat',
                201
            );
        } catch (\Illuminate\Validation\ValidationException $e) {
            return ApiResponse::error(
                'Gagal membuat akun: Data sudah terdaftar.',
                422,
                $e->errors()
            );
        } catch (\Exception $e) {
            return ApiResponse::error(
                'Gagal membuat akun. Terjadi kesalahan sistem.',
                500,
                ['exception' => $e->getMessage()]
            );
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return ApiResponse::error('User tidak ditemukan', 404);
            }

            $request->validate([
                'name' => 'nullable|string|max:255',
                'username' => [
                    'nullable',
                    'string',
                    Rule::unique('users')->ignore($user->id),
                ],
                'email' => [
                    'nullable',
                    'string',
                    'email',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => 'nullable|string|min:8',
                'role' => 'nullable|in:data_entry,user_kementerian,manager',
                'status' => 'nullable|in:active,inactive',
            ]);

            $user->update(array_filter([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->filled('password') ? Hash::make($request->password) : null,
                'role' => $request->role,
                'status' => $request->status,
            ]));

            return ApiResponse::success(
                new UserManagementResource($user),
                'Akun berhasil diubah'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal mengubah akun', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return ApiResponse::success(null, 'Akun berhasil dihapus');
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal menghapus akun', 500, ['exception' => $e->getMessage()]);
        }
    }
}
