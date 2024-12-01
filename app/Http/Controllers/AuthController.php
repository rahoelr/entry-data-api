<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Classes\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('username', $request->username)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return ApiResponse::error('The provided credentials are incorrect.', 401);
            }

            $token = $user->createToken('auth_token', [$user->role])->plainTextToken;

            return ApiResponse::success([
                'token' => $token,
                'user' => new UserResource($user->refresh()),
            ], 'Login Berhasil');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to login. Please try again.', 500, ['exception' => $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return ApiResponse::success(null, 'User berhasil logout');
        } catch (\Exception $e) {
            return ApiResponse::error('Failed to logout. Please try again.', 500, ['exception' => $e->getMessage()]);
        }
    }
}
