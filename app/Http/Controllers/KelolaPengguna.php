<?php

namespace App\Http\Controllers;

use App\Models\LogAktifitas;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class KelolaPengguna extends Controller
{

    public function index(Request $FADHIL_request)
    {
        $FADHIL_search = $FADHIL_request->input('search');

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_penggunas = User::with('outlet')
                ->when($FADHIL_search, function ($FADHIL_query) use ($FADHIL_search) {
                    return $FADHIL_query->where(function ($FADHIL_query) use ($FADHIL_search) {
                        $FADHIL_query->whereHas('outlet', function ($FADHIL_query) use ($FADHIL_search) {
                            $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%");
                        })
                            ->orWhere('nama', 'like', "%{$FADHIL_search}%")
                            ->orWhere('username', 'like', "%{$FADHIL_search}%")
                            ->orWhere('role', 'like', "%{$FADHIL_search}%");;
                    });
                })
                ->whereIn('role', ['admin', 'kasir', 'owner'])
                ->latest()
                ->simplePaginate(5);

            $FADHIL_outlets = Outlet::all();
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_penggunas = User::where('id_outlet', Auth::user()->id_outlet)
                ->when($FADHIL_search, function ($FADHIL_query) use ($FADHIL_search) {
                    return $FADHIL_query->where(function ($FADHIL_query) use ($FADHIL_search) {
                        $FADHIL_query->whereHas('outlet', function ($FADHIL_query) use ($FADHIL_search) {
                            $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%");
                        })
                            ->orWhere('nama', 'like', "%{$FADHIL_search}%")
                            ->orWhere('username', 'like', "%{$FADHIL_search}%")
                            ->orWhere('role', 'like', "%{$FADHIL_search}%");;
                    });
                })
                ->whereIn('role', ['kasir', 'owner'])
                ->latest()
                ->simplePaginate(5);
            $FADHIL_outlets = Outlet::where('id', Auth::user()->id_outlet);
        }

        return view('pengguna.kelola-pengguna', [
            'title' => 'Kelola Pengguna',
            'FADHIL_penggunas' => $FADHIL_penggunas,
            'FADHIL_outlets' => $FADHIL_outlets,
        ]);
    }

    public function store(Request $FADHIL_request): RedirectResponse
    {
        $FADHIL_request->validate([
            'id_outlet' => 'required',
            'nama' => 'required|string|max:100|regex:/^[\pL\s\-\d]+$/u',
            'username' => 'required|string|max:200|unique:tb_user,username|alpha_dash|regex:/^[a-z0-9_-]+$/',
            'password' => 'nullable|string|min:6|max:50',
            'role' => 'required',
        ]);

        // dd($FADHIL_request->all());

        if (is_numeric($FADHIL_request->id_outlet)) {
            // Jika id_outlet berupa angka (misal "1"), biarkan dan cari outlet berdasarkan ID
            $FADHIL_outlet = Outlet::find($FADHIL_request->id_outlet);
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        } else {
            // Jika id_outlet adalah nama outlet (misal "Outlet 1"), cari outlet berdasarkan nama
            $FADHIL_outlet = Outlet::where('nama', $FADHIL_request->id_outlet)->first();
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        }
        // dd($FADHIL_id_outlet);
        if (!$FADHIL_outlet) {
            return redirect()->back()->with(['error' => 'Invalid id_outlet']);
        }

        //validasi owner
        if ($FADHIL_request->role === 'owner') {
            $FADHIL_cekOwner = User::where('role', 'owner')
                ->where('id_outlet', $FADHIL_id_outlet)
                ->exists();

            if ($FADHIL_cekOwner) {
                return back()->with(['error' => 'Owner sudah ada di Outlet ini']);
            }
        }

        $FADHIL_pengguna = User::create([
            'id_outlet' => $FADHIL_id_outlet,
            'nama' => $FADHIL_request->nama,
            'username' => $FADHIL_request->username,
            'password' => Hash::make($FADHIL_request->password),
            'role' => $FADHIL_request->role,
        ]);

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Buat Pengguna',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil membuat pengguna',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_pengguna) {
            return redirect()->back()->with(['success' => 'Pengguna berhasil ditambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Pengguna gagal ditambahkan']);
        }
    }

    public function update(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_request->validate([
            'id_outlet' => 'required',
            'nama' => 'required|string|max:100|regex:/^[\pL\s\-\d]+$/u',
            'username' => 'required|string|max:200|alpha_dash|regex:/^[a-z0-9_-]+$/',
            'password' => 'nullable|string|min:6|max:50',
            'role' => 'required',
        ]);

        // dd($FADHIL_request->all());


        // Cek jika id_outlet berbentuk angka dalam bentuk string (misal "1")
        if (is_numeric($FADHIL_request->id_outlet)) {
            // Jika id_outlet berupa angka (misal "1"), biarkan dan cari outlet berdasarkan ID
            $FADHIL_outlet = Outlet::find($FADHIL_request->id_outlet);
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        } else {
            // Jika id_outlet adalah nama outlet (misal "Outlet 1"), cari outlet berdasarkan nama
            $FADHIL_outlet = Outlet::where('nama', $FADHIL_request->id_outlet)->first();
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        }

        // dd($FADHIL_request->all());

        $FADHIL_pengguna = User::findOrFail($FADHIL_id);
        // dd($FADHIL_pengguna->role);
        //validasi owner
        if ($FADHIL_request->role === 'owner') {
            $FADHIL_cekOwner = User::where('role', 'owner')
                ->where('id_outlet', $FADHIL_id_outlet)
                ->exists();

            if ($FADHIL_cekOwner) {
                return back()->with(['error' => 'Owner sudah ada']);
            }
        }

        $FADHIL_pengguna->id_outlet = $FADHIL_id_outlet;
        $FADHIL_pengguna->nama = $FADHIL_request->nama;
        $FADHIL_pengguna->username = $FADHIL_request->username;
        if ($FADHIL_request->filled('password')) {
            $FADHIL_pengguna->password = Hash::make($FADHIL_request->password);
        }
        $FADHIL_pengguna->role = $FADHIL_request->role;
        $FADHIL_pengguna->save();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Edit Pengguna',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil mengedit pengguna',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_pengguna) {
            return redirect()->back()->with(['success' => 'Pengguna berhasil diedit']);
        } else {
            return redirect()->back()->with(['error' => 'Pengguna gagal diedit']);
        }
    }

    public function destroy(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_pengguna = User::findOrFail($FADHIL_id);

        $FADHIL_pengguna->delete();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Hapus Pengguna',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil menghapus pengguna',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with(['success' => 'Pengguna berhasil dihapus']);
    }
}