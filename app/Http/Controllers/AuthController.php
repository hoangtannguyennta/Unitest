<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginHandle(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerHandle(Request $request)
    {
        try {
            $attributes = $request->all();
            $attributes['password'] = Hash::make($attributes['password']);
            User::create($attributes);
            return redirect()->route('home');
        } catch (\Exception) {
            return redirect()->route('register');
        }
    }

    public function logout()
    {
        return auth()->logout();
    }
}
