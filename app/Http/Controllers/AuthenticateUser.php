<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('Token Name')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Credenciais inválidas'], 401);
    }
}
