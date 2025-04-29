<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'no_hp' => 'required|string|unique:users', // Validasi no_hp
            'password' => 'required|string|confirmed',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email already exists',
            'no_hp.required' => 'No HP is required', // Pesan kesalahan untuk no_hp
            'no_hp.unique' => 'No HP already exists', // Pesan kesalahan untuk no_hp
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation does not match',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp, // Menyimpan no_hp
            'password' => Hash::make($request->password),
        ]);

        // Melakukan login setelah registrasi
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        return redirect('/admin/dashboard'); // Redirect ke dashboard setelah registrasi
    }

    public function login(Request $request)
{
    // Validasi input
    $request->validate([
        'login' => 'required|string',
        'password' => 'required|string',
    ], [
        'login.required' => 'Email atau No HP wajib diisi',
        'password.required' => 'Password wajib diisi',
    ]);

    // Cek apakah login menggunakan email atau no_hp
    $user = User::where('email', $request->login)
                ->orWhere('no_hp', $request->login)
                ->first();

    if (!$user) {
        return redirect()->back()->with('error', 'Akun tidak ditemukan.');
    }

    // Periksa password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Password salah!');
    }

    // Login pengguna
    Auth::login($user, $request->has('remember'));

    // Redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect('/admin')->with('success', 'Login berhasil! Selamat datang Admin ' . $user->name . '.');
    } elseif ($user->role === 'tim_kerja') {
        return redirect('/timkerja')->with('success', 'Login berhasil! Selamat datang Tim Kerja ' . $user->name . '.');
    }

    // Default redirect jika role tidak dikenali
    return redirect('/')->with('error', 'Role tidak dikenali.');
}


    // public function login(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'login' => 'required|string', // Ganti menjadi satu field untuk email atau no_hp
    //         'password' => 'required|string',
    //     ], [
    //         'login.required' => 'Email or No HP is required',
    //         'password.required' => 'Password is required',
    //     ]);

    //     // Cek apakah pengguna menggunakan email atau no_hp
    //     $user = User::where('email', $request->login)
    //                 ->orWhere('no_hp', $request->login)
    //                 ->first();

    //     if (!$user) {
    //         return redirect()->back()->with('error', 'Akun tidak ditemukan.'); // Redirect dengan error
    //     }

    //     // Memeriksa password
    //     if (!Hash::check($request->password, $user->password)) {
    //         return redirect()->back()->with('error', 'Password salah!'); // Redirect dengan error
    //     }

    //     // Melakukan login
    //     Auth::login($user, $request->has('remember'));

    //     return redirect('/admin')->with('success', 'Login berhasil! Selamat datang Admin ' . $user->name . '.'); // Redirect ke dashboard setelah login
    // }

    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Redirect ke halaman login setelah logout
    }
}
