<?php

namespace App\Http\Controllers;

use App\Exports\LogExport;
use App\Models\Transaksi;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    //

    public function index(Request $FADHIL_request)
    {
        $FADHIL_search = $FADHIL_request->input('search');

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_logs = LogAktifitas::with('user')
                ->when($FADHIL_search, function ($FADHIL_query) use ($FADHIL_search) {
                    return $FADHIL_query->where(function ($FADHIL_query) use ($FADHIL_search) {
                        $FADHIL_query->whereHas('user', function ($FADHIL_query) use ($FADHIL_search) {
                            $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%");
                        })
                            ->orWhere('aktifitas', 'like', "%{$FADHIL_search}%")
                            ->orWhere('role', 'like', "%{$FADHIL_search}%")
                            ->orWhere('deskripsi', 'like', "%{$FADHIL_search}%");;
                    });
                })
                ->latest()->simplePaginate(20);
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                ->with('user')
                ->when($FADHIL_search, function ($FADHIL_query) use ($FADHIL_search) {
                    return $FADHIL_query->where(function ($FADHIL_query) use ($FADHIL_search) {
                        $FADHIL_query->whereHas('user', function ($FADHIL_query) use ($FADHIL_search) {
                            $FADHIL_query->where('nama', 'like', "%{$FADHIL_search}%");
                        })
                            ->orWhere('aktifitas', 'like', "%{$FADHIL_search}%")
                            ->orWhere('deskripsi', 'like', "%{$FADHIL_search}%");
                    });
                })
                ->simplePaginate(10);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('log.log', [
            'title' => 'Log Aktifitas',
            'FADHIL_logs' => $FADHIL_logs,
        ]);
    }


    public function laporanLogFilter(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');

        if (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        }

        $FADHIL_role = $FADHIL_request->input('role');

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_logs = LogAktifitas::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                return $FADHIL_query->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
            })
                ->when($FADHIL_role, function ($FADHIL_query) use ($FADHIL_role) {
                    return $FADHIL_query->where('role', $FADHIL_role);
                })
                ->simplePaginate(20);
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereBetween('tb_log_aktifitas.created_at', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                ->when($FADHIL_role, function ($query) use ($FADHIL_role) {
                    return $query->where('tb_user.role', $FADHIL_role);
                })
                ->select('tb_log_aktifitas.*', 'tb_user.nama as user_name', 'tb_user.role') // Tambahkan select untuk menghindari ambiguitas
                ->simplePaginate(20);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Filter Laporan Log',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil memfilter laporan log',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('log.log', [
            'title' => 'Laporan Log',
            'FADHIL_logs' => $FADHIL_logs,
        ]);
    }

    public function laporanLogShow(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');
        $FADHIL_role = $FADHIL_request->input('role');

        if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_role)) {
            if (Auth::user()->role == 'super_admin') {
                $FADHIL_logs = LogAktifitas::get();
            } elseif (Auth::user()->role == 'admin') {
                $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                    ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                    ->get();
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        } elseif (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        } else {
            if (Auth::user()->role == 'super_admin') {
                $FADHIL_logs = LogAktifitas::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                    ->when($FADHIL_role, function ($FADHIL_query) use ($FADHIL_role) {
                        return $FADHIL_query->where('role', $FADHIL_role);
                    })
                    ->get();
            } elseif (Auth::user()->role == 'admin') {
                $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                    ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                    ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                        return $FADHIL_query->whereBetween('tb_log_aktifitas.created_at', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                    })
                    ->when($FADHIL_role, function ($query) use ($FADHIL_role) {
                        return $query->where('tb_user.role', $FADHIL_role);
                    })
                    ->select('tb_log_aktifitas.*', 'tb_user.nama as user_name', 'tb_user.role')
                    ->get();
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        return view('log.log_show', [
            'title' => 'Show Laporan Penjualan',
            'FADHIL_logs' => $FADHIL_logs,
            'FADHIL_tanggal_mulai' => $FADHIL_tanggal_mulai,
            'FADHIL_tanggal_akhir' => $FADHIL_tanggal_akhir,
            'FADHIL_role' => $FADHIL_role,

        ]);
    }

    public function laporanLogEksporPDF(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');
        $FADHIL_role = $FADHIL_request->input('role');

        if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_role)) {
            if (Auth::user()->role == 'super_admin') {
                $FADHIL_logs = LogAktifitas::get();

                $FADHIL_namaFile = 'laporan_log__semua_periode.pdf';
            } elseif (Auth::user()->role == 'admin') {
                $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                    ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                    ->get();
                $FADHIL_namaFile = 'laporan_log__semua_periode.pdf';
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        } elseif (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        } else {
            if (Auth::user()->role == 'super_admin') {
                $FADHIL_logs = LogAktifitas::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                    ->when($FADHIL_role, function ($FADHIL_query) use ($FADHIL_role) {
                        return $FADHIL_query->where('role', $FADHIL_role);
                    })
                    ->orderBy('created_at', 'desc')->get();

                $FADHIL_namaFile = "laporan_log-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.pdf";
            } elseif (Auth::user()->role == 'admin') {
                $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                    ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                    ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                        return $FADHIL_query->whereBetween('tb_log_aktifitas.created_at', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                    })
                    ->when($FADHIL_role, function ($query) use ($FADHIL_role) {
                        return $query->where('tb_user.role', $FADHIL_role);
                    })
                    ->select('tb_log_aktifitas.*', 'tb_user.nama as user_name', 'tb_user.role')
                    ->get();
                $FADHIL_namaFile = "laporan_log-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.pdf";
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        $FADHIL_pdf = app('dompdf.wrapper')->loadview('log.log_cetak_pdf', [
            'FADHIL_logs' => $FADHIL_logs,
            'FADHIL_tanggal_mulai' => $FADHIL_tanggal_mulai,
            'FADHIL_tanggal_akhir' => $FADHIL_tanggal_akhir,
            'FADHIL_role' => $FADHIL_role,
        ]);

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Ekspor Log PDF',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil ekspor laporan log PDF',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $FADHIL_pdf->download($FADHIL_namaFile);
    }



    public function laporanLogEksporXLS(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');
        $FADHIL_role = $FADHIL_request->input('role');


        if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_role)) {
            if (Auth::user()->role == 'super_admin') {
                $FADHIL_logs = LogAktifitas::get();

                $FADHIL_namaFile = 'laporan_log__semua_periode.xlsx';
            } elseif (Auth::user()->role == 'admin') {
                $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                    ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                    ->get();
                $FADHIL_namaFile = 'laporan_log_' . (session('nama_outlet') ?? 'Laundry Jaya Pusat') . '_semua_periode.xlsx';
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        } elseif (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        } else {
            if (Auth::user()->role == 'super_admin') {
                $FADHIL_logs = LogAktifitas::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                    ->when($FADHIL_role, function ($FADHIL_query) use ($FADHIL_role) {
                        return $FADHIL_query->where('role', $FADHIL_role);
                    })
                    ->orderBy('created_at', 'desc')->get();

                $FADHIL_namaFile = "laporan_log-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.xlsx";
            } elseif (Auth::user()->role == 'admin') {
                $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                    ->where('tb_user.id_outlet', Auth::user()->id_outlet)
                    ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                        return $FADHIL_query->whereBetween('tb_log_aktifitas.created_at', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                    })
                    ->when($FADHIL_role, function ($query) use ($FADHIL_role) {
                        return $query->where('tb_user.role', $FADHIL_role);
                    })
                    ->select('tb_log_aktifitas.*', 'tb_user.nama as user_name', 'tb_user.role')
                    ->get();
                $FADHIL_namaFile = "laporan_log_" . (session('nama_outlet') ?? 'Laundry Jaya Pusat') . "-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.xlsx";
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Ekspor Laporan Log Excel',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil ekspor laporan log Excel',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Excel::download(new LogExport($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir, $FADHIL_role), $FADHIL_namaFile);
    }
}
