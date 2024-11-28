<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($data)) {
            return response()->json(['message' => 'Authenticated', 'redirect' => '/dashboard'], 200);
        } else {
            return response()->json(['message' => 'Email / Password don\'t match in our database'], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
