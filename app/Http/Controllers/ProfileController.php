<?php

namespace App\Http\Controllers;

use App\Models\data_user_model;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfilePage()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $userId = session('user_id');

        $existingUser = data_user_model::where('email', $request->email)
            ->where('id', '!=', $userId)
            ->first();

        if ($existingUser) {
            return back()->withErrors([
                'email' => 'Email sudah digunakan oleh pengguna lain'
            ])->withInput();
        }
        
        $user = data_user_model::find($userId);

        if (!$user) {
            return back()->with('error', 'Pengguna tidak ditemukan');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        session([
            'user_name' => $request->name,
            'user_email' => $request->email,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
