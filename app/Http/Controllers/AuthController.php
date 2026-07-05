<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
// 1. Validamos que Angular nos envíe correctamente la data
    $request->validate([
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ]);

    // 2. Si pasa la validación, creamos el usuario
    $user = User::create([
        'name' => 'Usuario', 
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ]);
    
    return response()->json([
        'user' => $user, 
        'token' => $user->createToken('auth_token')->plainTextToken
    ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'user' => $user, 
            'token' => $user->createToken('auth_token')->plainTextToken
        ]);
    }
}
