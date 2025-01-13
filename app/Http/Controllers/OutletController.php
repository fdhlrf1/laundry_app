<?php

namespace App\Http\Controllers;

use App\Models\LogAktifitas;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{
    public function index(Request $FADHIL_request)
    {
        $FADHIL_search = $FADHIL_request->input('search');

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_outlets = Outlet::when($FADHIL_search, function ($FADHIL_query, $FADHIL_search) {
                return $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%")
                    ->orWhere('alamat', 'like', "%{$FADHIL_search}%")
                    ->orWhere('tlp', 'like', "%{$FADHIL_search}%");
            })
                ->latest()
                ->simplePaginate(5);
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_outlets = Outlet::where('id', Auth()->user()->id_outlet)->latest()->simplePaginate(5);
        } else {
            abort(403, 'FORBIDDEN');
        }

        // dd($FADHIL_outlets);
        return view('outlet.outlet', [
            'title' => 'Kelola Outlet',
            'FADHIL_outlets' => $FADHIL_outlets
        ]);
    }

    public function store(Request $FADHIL_request): RedirectResponse
    {
        $FADHIL_request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:200',
            'tlp' => 'required|string|max:50|regex:/^(\(?\d+\)?)?[\s\d\-]+$/',
        ]);

        $FADHIL_outlet = Outlet::create([
            'nama' => $FADHIL_request->nama,
            'alamat' => $FADHIL_request->alamat,
            'tlp' => $FADHIL_request->tlp,
        ]);


        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Buat Outlet',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil membuat outlet',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_outlet) {
            return redirect()->back()->with(['success' => 'Outlet berhasil ditambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Outlet gagal ditambahkan']);
        }
    }

    public function update(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string|max:200',
            'tlp' => 'required|string|max:50|regex:/^(\(?\d+\)?)?[\s\d\-]+$/',
        ]);

        // dd($FADHIL_request->all());

        $FADHIL_outlet = Outlet::findOrFail($FADHIL_id);
        // dd($FADHIL_outlet);

        $FADHIL_outlet->nama = $FADHIL_request->nama;
        $FADHIL_outlet->alamat = $FADHIL_request->alamat;
        $FADHIL_outlet->tlp = $FADHIL_request->tlp;
        $FADHIL_outlet->save();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Edit Outlet',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil mengedit outlet',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_outlet) {
            return redirect()->back()->with(['success' => 'Outlet berhasil diedit']);
        } else {
            return redirect()->back()->with(['error' => 'Outlet gagal diedit']);
        }
    }

    public function destroy(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_outlet = Outlet::findOrFail($FADHIL_id);
        // dd($FADHIL_outlet);
        $FADHIL_outlet->delete();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Hapus Outlet',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil menghapus outlet',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with(['success' => 'Outlet berhasil dihapus']);
    }
}
