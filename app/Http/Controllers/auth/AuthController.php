<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LogAktifitas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function cekLogin(Request $FADHIL_request)
    {
        $FADHIL_credentials = $FADHIL_request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // dd($FADHIL_credentials);
        if (Auth::attempt($FADHIL_credentials)) {
            $FADHIL_request->session()->regenerate();
            // dd($FADHIL_credentials);
            $FADHIL_user = Auth::user();
            $FADHIL_outlet = $FADHIL_user->outlet;
            $FADHIL_role = Auth::user()->role;

            $FADHIL_welcomeMessage = [
                'name' => $FADHIL_user->nama,
                'role' => ucfirst($FADHIL_role),
            ];
            session()->flash('login_message', $FADHIL_welcomeMessage);

            $FADHIL_request->session()->put('id_user', Auth::id());

            if ($FADHIL_outlet) {
                $FADHIL_request->session()->put('id_outlet', $FADHIL_outlet->id);
                $FADHIL_request->session()->put('nama_outlet', $FADHIL_outlet->nama);
            } else {
                $FADHIL_request->session()->put('id_outlet', null);
                $FADHIL_request->session()->put('nama_outlet', 'Laundry Jaya Pusat');
            }

            // Log aktivitas login
            LogAktifitas::create([
                'id_user' => $FADHIL_user->id,
                'aktifitas' => 'Login',
                'role' => $FADHIL_user->role,
                'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil login',
                'ip_address' => $FADHIL_request->ip(),
                'user_agent' => $FADHIL_request->header('User-Agent'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // dd($level);
            if ($FADHIL_role == 'admin' || $FADHIL_role == 'kasir' || $FADHIL_role == 'owner' || $FADHIL_role == 'super_admin' || $FADHIL_role == 'super_owner') {
                return redirect()->intended(route('beranda'))->with(['success', 'Selamat Datang' . $FADHIL_user->nama . 'Role:' . ucfirst($FADHIL_user->role)]);
            } else {
                Auth::logout();
                return redirect()->route('login')->with(['error' => 'Role tidak dikenali.']);
            }
        }

        return redirect()->route('login')->with(['error' => 'Username atau Password Salah']);
    }

    public function logout(Request $FADHIL_request)
    {
        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Logout',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil logout',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Auth::logout();

        $FADHIL_request->session()->invalidate();
        $FADHIL_request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }

    public function namafungsi(){
        
    }
}