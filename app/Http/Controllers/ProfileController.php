<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller {
    /**
     * Menampilkan formulir profil pengguna.
     */
    public function ubah_profil(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update informasi profil pengguna.
     */
    public function update_profil(ProfileUpdateRequest $request): RedirectResponse {
        // Mengisi data pengguna dengan data yang telah divalidasi
        $request->user()->fill($request->validated());

        // Cek bila ada sebuah file yang di upload ke server
        if ($request->hasFile('photo_path') && $request->file('photo_path')->isValid()) {
            // Ambil file yang diupload dan simpan di variabel
            $file = $request->file('photo_path');
            // Upload file ke storage dengan nama folder 'foto_profil', nama file di-hash, dan ambil path-nya
            $path = $file->storeAs('users/foto_profil', $file->hashName(), 'public');
            // Simpan path file yang diupload ke database
            $request->user()->photo_path = $path;
        }

        // Cek bila ada sebuah file yang di upload ke server
        if ($request->hasFile('ttd_path') && $request->file('ttd_path')->isValid()) {
            // Ambil file yang diupload dan simpan di variabel
            $file = $request->file('ttd_path');
            // Upload file ke storage dengan nama folder 'ttd', nama file di-hash, dan ambil path-nya
            $path = $file->storeAs('users/ttd', $file->hashName(), 'public');
            // Simpan path file yang diupload ke database
            $request->user()->ttd_path = $path;
        }

        // Cek bila pengguna mengubah email

        // Jika email pengguna berubah, set email_verified_at menjadi null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Simpan perubahan data pengguna ke database
        $request->user()->save();

        // Redirect ke halaman edit profil dengan pesan status 'profile-updated'
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun pengguna.
     */
    public function hapus_profil(Request $request): RedirectResponse {
        // Validasi password pengguna sebelum penghapusan
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Dapatkan pengguna yang terautentikasi
        $user = $request->user();

        // Logout pengguna
        Auth::logout();

        // Hapus akun pengguna
        $user->delete();

        // Invalidasi sesi saat ini
        $request->session()->invalidate();

        // Regenerasi token sesi
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return Redirect::to('/');
    }
}