<?php

namespace App\Http\Controllers;

use App\Models\data_user_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterPage()
    {
        return view('register');
    }

    public function processRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = data_user_model::where('email', $request->email)->first();

        if ($user) {
            return back()->withErrors([
                'email' => 'Email sudah terdaftar'
            ]);
        }

        data_user_model::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect('/')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
