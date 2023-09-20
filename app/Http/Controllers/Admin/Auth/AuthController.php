<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return response([
                'message' => 'Invalid credentials'
            ], 401);
        } else if (!auth()->user()->active) {
            auth()->logout();

            return response([
                'message' => 'Inactive account'
            ], 403);
        } else {
            $user = auth()->user();
            $token = auth()->user()->createToken('ApiToken')->plainTextToken;

            return response([
                'user' => $user,
                'access_token' => $token,
            ], 200);
        }
    }

    public function logout(Request $request): Response
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Successfully logged out'
        ], 200);
    }
}
