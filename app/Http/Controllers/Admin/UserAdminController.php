<?php

namespace App\Http\Controllers\Admin;

use App\Models\Peminjam;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserAdminController extends Controller
{
    // Mengambil data user
    public function index()
    {
        $users = User::all();
        return view('admin.layouts.pages.user.data-user', compact('users'))->with('title', 'Manajemen User');
    }

    // Create User
    public function store(Request $request)
    {
        // Validasi input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,user,petugas',
        ]);

        // Membuat user baru
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        // Redirect setelah user berhasil dibuat
        return redirect()->route('admin.layouts.pages.user.data-user')->with('success', 'User created successfully');
    }
}
