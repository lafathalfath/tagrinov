<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ManageAccountController extends Controller
{
    public function index(Request $request)
    {
        // Ambil role pengguna yang sedang login
        $role = Auth::user()->role;
    
        // Filter user berdasarkan role
        $query = User::where('role', $role);
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('no_hp', 'LIKE', "%{$search}%");
        }
    
        $users = $query->orderBy('name', 'asc')->get();
    
        // Tentukan view berdasarkan role
        if ($role === 'admin') {
            return view('admin.kelola-akun.index', compact('users'));
        } elseif ($role === 'tim_kerja') {
            return view('timkerja.kelola-akun.index', compact('users'));
        }
    
        return abort(403, 'Akses tidak diizinkan.');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'no_hp' => 'required|numeric|digits_between:10,13|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Password minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'email.unique' => 'Email sudah digunakan.',
            'no_hp.unique' => 'Nomor HP sudah digunakan.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Akun berhasil ditambahkan!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.min' => 'Password minimal terdiri dari 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);
    
        $user = User::findOrFail($request->user_id);
    
        // Cek apakah password lama benar
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama salah!');
        }
    
        // Cek jika password baru sama dengan password lama
        if (Hash::check($request->new_password, $user->password)) {
            return back()->with('error', 'Password baru tidak boleh sama dengan password lama!');
        }
    
        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);
    
        return back()->with('success', 'Password berhasil diperbarui!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->ignore($request->user_id),
            ],
            'no_hp' => [
                'required',
                Rule::unique('users')->ignore($request->user_id),
            ],
        ], [
            'email.unique' => 'Email ini sudah digunakan oleh pengguna lain.',
            'no_hp.unique' => 'Nomor HP ini sudah digunakan oleh pengguna lain.',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);
    
        $user = User::findOrFail($id);
    
        // Cek apakah password yang dimasukkan cocok dengan password user yang login
        if (!Hash::check($request->password, auth()->user()->password)) {
            return back()->with('error', 'Password salah! Coba lagi.');
        }
    
        // Hapus akun jika password benar
        $user->delete();
    
        return back()->with('success', 'Akun berhasil dihapus!');
    }
    
}
