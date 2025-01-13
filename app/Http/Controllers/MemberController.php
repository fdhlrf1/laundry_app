<?php

namespace App\Http\Controllers;

use App\Models\LogAktifitas;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index(Request $FADHIL_request)
    {
        $FADHIL_search = $FADHIL_request->input('search');

        $FADHIL_members = Member::when($FADHIL_search, function ($FADHIL_query, $FADHIL_search) {
            return $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%")
                ->orWhere('alamat', 'like', "%{$FADHIL_search}%")
                ->orWhere('jenis_kelamin', 'like', "%{$FADHIL_search}%")
                ->orWhere('tlp', 'like', "%{$FADHIL_search}%");
        })
            ->latest()
            ->simplePaginate(5);
        return view('member.member', [
            'FADHIL_members' => $FADHIL_members,
            'title' => 'Daftar Member',
        ]);
    }

    public function store(Request $FADHIL_request): RedirectResponse
    {
        $FADHIL_request->validate([
            'nama' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
            'alamat' => 'required|string|max:300',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|string|max:50|regex:/^[0-9\s+\(\)]*$/',
        ]);

        $FADHIL_member = Member::create([
            'nama' => $FADHIL_request->nama,
            'alamat' => $FADHIL_request->alamat,
            'jenis_kelamin' => $FADHIL_request->jenis_kelamin,
            'tlp' => $FADHIL_request->tlp,
        ]);

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Buat Member',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil membuat member',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_member) {
            return redirect()->back()->with(['success' => 'Member berhasil ditambahkan']);
        } else {
            return redirect()->back()->with(['error' => 'Member gagal ditambahkan']);
        }
    }

    public function update(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_request->validate([
            'nama' => 'required|string|max:100|regex:/^[\pL\s\-]+$/u',
            'alamat' => 'required|string|max:300',
            'jenis_kelamin' => 'required|in:L,P',
            'tlp' => 'required|string|max:50|regex:/^[0-9\s+\(\)]*$/',
        ]);


        // dd($FADHIL_request->all());

        $FADHIL_member = Member::findOrFail($FADHIL_id);

        $FADHIL_member->nama = $FADHIL_request->nama;
        $FADHIL_member->alamat = $FADHIL_request->alamat;
        $FADHIL_member->jenis_kelamin = $FADHIL_request->jenis_kelamin;
        $FADHIL_member->tlp = $FADHIL_request->tlp;
        $FADHIL_member->save();


        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Edit Member',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil mengedit member',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($FADHIL_member) {
            return redirect()->back()->with(['success' => 'Member berhasil diedit']);
        } else {
            return redirect()->back()->with(['error' => 'Member gagal diedit']);
        }
    }

    public function destroy(Request $FADHIL_request, $FADHIL_id): RedirectResponse
    {
        $FADHIL_member = Member::findOrFail($FADHIL_id);

        $FADHIL_member->delete();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Hapus Member',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil menghapus member',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with(['success' => 'Member berhasil dihapus']);
    }
}
