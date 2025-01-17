<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth('api')->user(),
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciais incorretas.'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Token inválido ou expirado.'], 401);
        }

        auth('api')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
