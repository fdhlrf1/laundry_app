<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function cekLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // dd($credentials);
            $user = Auth::user();
            $outlet = $user->outlet;
            $role = Auth::user()->role;

            $welcomeMessage = [
                'name' => $user->nama, // Assuming 'nama' is the name field
                'role' => ucfirst($role), // Capitalize the first letter of the role
            ];
            session()->flash('login_message', $welcomeMessage);

            $request->session()->put('id_user', Auth::id());

            if ($outlet) {
                $request->session()->put('id_outlet', $outlet->id);
                $request->session()->put('nama_outlet', $outlet->nama);
            } else {
                $request->session()->put('id_outlet', null);
                $request->session()->put('nama_outlet', 'Outlet super admin');
            }

            // dd($outlet->nama);

            if ($role == 'admin' || $role == 'kasir' || $role == 'owner') {
                return redirect()->intended(route('beranda'));
            } elseif ($role == 'super_admin' || $role == 'super_owner') {
                return redirect()->intended(route('superadminberanda')); // You can create a separate route for super admin or super owner
            } else {
                // If role is unrecognized, log out and redirect to login
                Auth::logout();
                return redirect()->route('login')->withErrors(['failed' => 'Role tidak dikenali.']);
            }
        }

        return redirect()->route('login')->with('failed', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        // dd('oke');
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Kamu berhasil logout');
    }
}
