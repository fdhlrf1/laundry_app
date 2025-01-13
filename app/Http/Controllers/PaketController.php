<?php

namespace App\Http\Controllers;

use App\Models\LogAktifitas;
use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PaketController extends Controller
{
    public function index(Request $FADHIL_request)
    {
        $FADHIL_search = $FADHIL_request->input('search');

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_pakets = Paket::with('outlet')
                ->when($FADHIL_search, function ($FADHIL_query) use ($FADHIL_search) {
                    return $FADHIL_query->where(function ($FADHIL_query) use ($FADHIL_search) {
                        $FADHIL_query->whereHas('outlet', function ($FADHIL_query) use ($FADHIL_search) {
                            $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%");
                        })
                            ->orWhere('jenis', 'like', "%{$FADHIL_search}%")
                            ->orWhere('nama_paket', 'like', "%{$FADHIL_search}%")
                            ->orWhere('harga', 'like', "%{$FADHIL_search}%")
                            ->orWhere('lama_proses', 'like', "%{$FADHIL_search}%");
                    });
                })
                ->latest()->simplePaginate(5);
            $FADHIL_outlets = Outlet::all();
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_pakets = Paket::where('id_outlet', Auth()->user()->id_outlet)
            ->when($FADHIL_search, function ($FADHIL_query) use ($FADHIL_search) {
                return $FADHIL_query->where(function ($FADHIL_query) use ($FADHIL_search) {
                    $FADHIL_query->whereHas('outlet', function ($FADHIL_query) use ($FADHIL_search) {
                        $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%");
                    })
                        ->orWhere('jenis', 'like', "%{$FADHIL_search}%")
                        ->orWhere('nama_paket', 'like', "%{$FADHIL_search}%")
                        ->orWhere('harga', 'like', "%{$FADHIL_search}%")
                        ->orWhere('lama_proses', 'like', "%{$FADHIL_search}%");
                });
            })
                ->latest()
                ->simplePaginate(5);
            $FADHIL_outlets = Outlet::all();
        } else {
            abort(403, 'FORBIDDEN');
        }

        return view('paket.paket', [
            'FADHIL_outlets' => $FADHIL_outlets,
            'FADHIL_pakets' => $FADHIL_pakets,
            'title' => 'Kelola Paket Cucian'
        ]);
    }

    public function store(Request $FADHIL_request): RedirectResponse
    {
        $FADHIL_request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required|string|max:200|regex:/^[\pL\s\-\d]+$/u',
            'lama_proses' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:1',
        ]);

        // dd($FADHIL_request->all());

        if (is_numeric($FADHIL_request->id_outlet)) {
            $FADHIL_outlet = Outlet::find($FADHIL_request->id_outlet);
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        } else {
            $FADHIL_outlet = Outlet::where('nama', $FADHIL_request->id_outlet)->first();
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        }
        // dd($FADHIL_id_outlet);
        if (!$FADHIL_outlet) {
            return redirect()->back()->with(['error' => 'Invalid id_outlet']);
        }

        $FADHIL_paket = Paket::create([
            'id_outlet' => $FADHIL_id_outlet,
            'jenis' => $FADHIL_request->jenis,
            'nama_paket' => $FADHIL_request->nama_paket,
            'harga' => $FADHIL_request->harga,
            'lama_proses' => $FADHIL_request->lama_proses,
        ]);

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Buat Paket',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil membuat paket',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_paket) {
            return redirect()->back()->with(['success' => 'Paket Cucian berhasil ditambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Paket Cucian gagal ditambahkan']);
        }
    }

    public function update(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required|string|max:200|regex:/^[\pL\s\-\d]+$/u',
            'lama_proses' => 'required|numeric|min:1',
            'harga' => 'required|numeric|min:1',
        ]);

        if (is_numeric($FADHIL_request->id_outlet)) {
            $FADHIL_outlet = Outlet::find($FADHIL_request->id_outlet);
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        } else {
            $FADHIL_outlet = Outlet::where('nama', $FADHIL_request->id_outlet)->first();
            $FADHIL_id_outlet = $FADHIL_outlet->id;
        }
        // dd($FADHIL_id_outlet);

        $FADHIL_paket = Paket::findOrFail($FADHIL_id);

        $FADHIL_paket->id_outlet = $FADHIL_id_outlet;
        $FADHIL_paket->jenis = $FADHIL_request->jenis;
        $FADHIL_paket->nama_paket = $FADHIL_request->nama_paket;
        $FADHIL_paket->harga = $FADHIL_request->harga;
        $FADHIL_paket->lama_proses = $FADHIL_request->lama_proses;
        $FADHIL_paket->save();


        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Edit Paket',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil mengedit paket',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        if ($FADHIL_paket) {
            return redirect()->back()->with(['success' => 'Paket Cucian berhasil diedit']);
        } else {
            return redirect()->back()->with(['error' => 'Paket Cucian gagal diedit']);
        }
    }

    public function destroy(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_paket = Paket::findOrFail($FADHIL_id);

        $FADHIL_paket->delete();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Hapus Paket',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil menghapus paket',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with(['success' => 'Paket Cucian berhasil dihapus']);
    }
}
