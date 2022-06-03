<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::query()->where('email', $request->email)->first();
        if (empty($user) || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credential do not match',
            ]);
        } else {
            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'meassage' => 'OK',
                'data' => $user,
                'token' => $token,
            ]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Log out success...',
        ]);
    }
}
