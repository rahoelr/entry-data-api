<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Classes\ApiResponse;
use App\Http\Resources\UserManagementResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function registerUserEmail(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users',
                'role' => 'required|in:data_entry,user_kementerian,manager',
            ]);

            // Create the user
            $user = User::create([
                'email' => $request->email,
                'role' => $request->role,
                'status' => 'inactive'
            ]);

            // Prepare email data
            $data = [
                'id' => $user->id
            ];
           
            // Send email with credentials
            Mail::to($request->email)->send(new SendEmail($data));

            return ApiResponse::success([
                'id' => $user->id,
                'user' => new UserResource($user)
            ], 'Registrasi berhasil dan email dikirim');

        } catch (ValidationException $e) {
            return ApiResponse::error('Registrasi gagal: Error dalam validasi', 422, $e->errors());
        } catch (\Exception $e) {
            return ApiResponse::error('Registrasi gagal, silakan coba lagi', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function completeRegister(Request $request, $id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return ApiResponse::error('User tidak ditemukan', 404);
            }

            $request->validate([
                'name' => 'nullable|string|max:255',
                'username' => [
                    'required',
                    'string',
                    Rule::unique('users')->ignore($user->id),
                ],
                'password' => 'required|string|min:8',
            ]);

            $user->update(array_filter([
                'name' => $request->name,
                'username' => $request->username,
                'password' => $request->filled('password') ? Hash::make($request->password) : null,
            ]));

            return ApiResponse::success(
                new UserManagementResource($user),
                'Data akun berhasil dilengkapi'
            );
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal melengkapi data', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('username', $request->username)->first();

            if (!$user) {
                return ApiResponse::error('Username tidak tersedia', 401);
            }

            if ($user->status !== 'active') {
                return ApiResponse::error('Akun Anda tidak aktif, silakan hubungi admin', 403);
            }

            if (!$user || !Hash::check($request->password, $user->password)) {
                return ApiResponse::error('Username atau password tidak benar', 401);
            }

            $token = $user->createToken('auth_token', [$user->role])->plainTextToken;

            return ApiResponse::success([
                'token' => $token,
                'user' => new UserResource($user->refresh()),
            ], 'Login Berhasil');
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal Login, silakan coba lagi', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return ApiResponse::success(null, 'User berhasil logout');
        } catch (\Exception $e) {
            return ApiResponse::error('Gagal Logout, silakan coba lagi', 500, ['exception' => $e->getMessage()]);
        }
    }
}
