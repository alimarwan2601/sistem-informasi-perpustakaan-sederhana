<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas',
        ]);

        User::create($validated);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,petugas',
        ]);

        // Cegah admin mengubah role akun sendiri menjadi petugas.
        if (
            $user->id === auth()->id() &&
            $validated['role'] !== 'admin'
        ) {
            return back()->withInput()->withErrors([
                'role' => 'Anda tidak bisa mengubah role akun sendiri menjadi petugas.',
            ]);
        }

        // Jangan izinkan admin terakhir diturunkan menjadi petugas.
        if (
            $user->role === 'admin' &&
            $validated['role'] === 'petugas' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()->withInput()->withErrors([
                'role' => 'Tidak bisa mengubah role admin terakhir menjadi petugas.',
            ]);
        }

        // Password kosong berarti password lama tetap digunakan.
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Admin tidak boleh menghapus akunnya sendiri.
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak bisa menghapus akun sendiri.');
        }

        // Cegah penghapusan pengguna yang memiliki riwayat transaksi.
        if ($user->borrowings()->exists()) {
            return redirect()->route('users.index')
                ->with('error', 'Pengguna tidak bisa dihapus karena memiliki riwayat transaksi.');
        }

        // Cegah penghapusan admin terakhir.
        if (
            $user->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return redirect()->route('users.index')
                ->with('error', 'Admin terakhir tidak bisa dihapus.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
