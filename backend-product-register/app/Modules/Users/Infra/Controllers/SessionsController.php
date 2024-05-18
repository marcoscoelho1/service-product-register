<?php

namespace App\Modules\Users\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function store(Request $request)
    {
        try {

            $credentials = $request->only(['email', 'password']);

            if (!$token = Auth::attempt($credentials)) {
                return ApiResponse::error('User email/password invalidated.');
            }

            return ApiResponse::success([
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()->getTTL() * 60
            ]);
        } catch (\Exception $error) {
            return ApiResponse::error($error->getMessage());
        }
    }
}
