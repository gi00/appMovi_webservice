<?php

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|username',
            'password' => 'required'
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user || !password_verify($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        $token = AuthToken::create(['user_id' => $user->id]);

        return response()->json([
            'token' => $token->token,
            'user' => $user->toArray()
        ]);
    }

    // ... (Otras acciones del controlador, como registro, logout, etc.)
}