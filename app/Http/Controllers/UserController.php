<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    // USER
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function kelola_user()
    {
        $user = User::all();

        return view('admin.user.kelola_user', compact('user'));
    }

    public function kelola_sampah_user()
    {
        $user = User::onlyTrashed()->get();

        return view('admin.user.sampah', compact('user'));
    }

    public function add_user()
    {
        return view('admin.user.add_user');
    }

    public function insert_user(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:15',
            'role' => 'required',
        ], [
            'name.required' => 'Nama user wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email sudah terdaftar!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.max' => 'Password maximal 15 karakter!',
            'role.required' => 'Role wajib diisi!',
        ]);

        $add_user = new User;
        $add_user->name = $request->input('name');
        $add_user->email = $request->input('email');
        $add_user->password = bcrypt($request->input('password'));
        $add_user->role = $request->input('role');
        $add_user->save();

        return redirect()->route('admin.user.kelola_user')->with('pesan', 'Data user berhasil ditambahkan!');
    }

    public function delete_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus!');
    }

    public function restore_user($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('pesan', 'Data berhasil direstore!');
    }

    public function delete_permanen_user($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->back()->with('pesan', 'Data berhasil dihapus permanen!');
    }
}
