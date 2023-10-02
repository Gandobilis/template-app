<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class AuthController extends Controller
{
    public function login(LoginRequest $request): Response
    {
        $credentials = $request->validated();

        if (!auth()->attempt($credentials)) {
            return response([
                'message' => __('auth.unauthorized')
            ], ResponseAlias::HTTP_UNAUTHORIZED);
        } else if (!auth()->user()->active) {
            auth()->logout();

            return response([
                'message' => __('auth.forbidden')
            ], ResponseAlias::HTTP_FORBIDDEN);
        } else {
            $user = auth()->user();
            $token = auth()->user()->createToken('TemplateAppApiToken')->plainTextToken;

            return response([
                'message' => __('auth.log_in'),
                'user' => $user,
                'access_token' => $token,
            ], ResponseAlias::HTTP_OK);
        }
    }

    public function logout(): Response
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => __('auth.log_out'),
        ], ResponseAlias::HTTP_OK);
    }
}
