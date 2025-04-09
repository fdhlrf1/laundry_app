<?php

namespace App\Http\Controllers;

use App\Charts\LaporanChart;
use App\Exports\TransaksiExport;
use App\Models\DetailTransaksi;
use App\Models\LogAktifitas;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    public function index()
    {
        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
            $FADHIL_transaksis = Transaksi::latest()->simplePaginate(10);
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
            $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })->latest()->simplePaginate(10);
        } else {
            abort(403);
        }

        return view('laporan.laporan', [
            'title' => 'Laporan dan Transaksi',
            'FADHIL_transaksis' => $FADHIL_transaksis,
        ]);
    }

    public function laporanStatus(Request $FADHIL_request, $FADHIL_id)
    {
        $FADHIL_request->validate([
            'status' => 'required',
        ]);

        // dd($FADHIL_request->all());
        $FADHIL_status = Transaksi::findOrFail($FADHIL_id);

        $FADHIL_status->status = $FADHIL_request->status;
        $FADHIL_status->save();

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Perbarui Status',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil memperbarui status',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        if ($FADHIL_status) {
            return redirect()->route('laporan')->with('success', 'Status berhasil diupdate.');
        } else {
            return redirect()->route('laporan')->with('error', 'Status gagal diupdate.');
        }
    }

    public function laporanDetail(Request $FADHIL_request, string $FADHIL_id)
    {
        // dd($FADHIL_id);
        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
            $FADHIL_details = Transaksi::findOrFail($FADHIL_id);
            $FADHIL_details_trs = DetailTransaksi::where('id_transaksi', $FADHIL_details->id)->get();
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
            $FADHIL_details = Transaksi::where('id', $FADHIL_id)
                ->whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                ->firstOrFail();

            $FADHIL_details_trs = DetailTransaksi::where('id_transaksi', $FADHIL_details->id)
                ->whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                ->get();
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Melihat Detail',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil melihat detail transaksi',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('laporan.detail_transaksi', [
            'FADHIL_details_trs' => $FADHIL_details_trs,
            'FADHIL_details' => $FADHIL_details,
            'title' => 'Detail Transaksi',
        ]);
    }

    public function laporanFaktur(Request $FADHIL_request, string $FADHIL_id)
    {
        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
            $FADHIL_details = Transaksi::findOrFail($FADHIL_id);
            $FADHIL_details_trs = DetailTransaksi::where('id_transaksi', $FADHIL_details->id)->get();
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
            $FADHIL_details = Transaksi::where('id', $FADHIL_id)
                ->whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                ->firstOrFail();
            $FADHIL_details_trs = DetailTransaksi::where('id_transaksi', $FADHIL_details->id)
                ->whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                ->get();
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Mencetak Faktur',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil mencetak faktur',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('laporan.cetak_faktur', [
            'title' => 'Faktur Transaksi',
            'FADHIL_details_trs' => $FADHIL_details_trs,
            'FADHIL_details' => $FADHIL_details,
        ]);
    }
    public function update(Request $FADHIL_request, $FADHIL_id)
    {
        $FADHIL_request->validate([
            'bayar' => 'required',
            'total' => 'required',
            'kembalian' => 'nullable',
        ]);

        // dd($FADHIL_request->all());

        $FADHIL_kembalianS = str_replace('.', '', str_replace('Rp.', '', $FADHIL_request->kembalian));

        $FADHIL_kembalian = intval($FADHIL_kembalianS);
        $FADHIL_total = intval($FADHIL_request->total);
        $FADHIL_bayar = intval($FADHIL_request->bayar);

        if ($FADHIL_bayar < $FADHIL_total) {
            return redirect()->back()->with('error', 'Jumlah pembayaran tidak mencukupi. Silakan masukkan jumlah yang sesuai dengan total pembayaran.');
        } else {
            $FADHIL_pembayaran = Transaksi::findOrFail($FADHIL_id);

            \Carbon\Carbon::setLocale('id');
            $FADHIL_now = \Carbon\Carbon::now('Asia/Jakarta');
            $FADHIL_tgl_bayar = $FADHIL_now;

            $FADHIL_pembayaran->tgl_bayar = $FADHIL_tgl_bayar;
            $FADHIL_pembayaran->dibayar = 'dibayar';
            $FADHIL_pembayaran->bayar = $FADHIL_bayar;
            $FADHIL_pembayaran->kembalian = $FADHIL_kembalian;
            $FADHIL_pembayaran->save();

            $FADHIL_user = Auth::user();

            LogAktifitas::create([
                'id_user' => Auth::id(),
                'aktifitas' => 'Transaksi Pembayaran',
                'role' => $FADHIL_user->role,
                'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil melakukan transaksi pembayaran',
                'ip_address' => $FADHIL_request->ip(),
                'user_agent' => $FADHIL_request->header('User-Agent'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($FADHIL_pembayaran) {
                return redirect()->route('laporan')->with('success', 'Pembayaran berhasil dilakukan.');
            } else {
                return redirect()->route('laporan')->with('error', 'Pembayaran gagal dilakukan.');
            }
        }
    }

    public function laporanFilter(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');

        if (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        }

        $FADHIL_statusBayar = $FADHIL_request->input('dibayar');
        $FADHIL_statusCucian = $FADHIL_request->input('status');

        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
            $FADHIL_transaksis = Transaksi::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                // dd('star$startFormatted Date:', $startFormatted, 'end$endFormatted Date:', $endFormatted);
                return $FADHIL_query->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
            })
                ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                    return $FADHIL_query->where('dibayar', $FADHIL_statusBayar);
                })
                ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                    return $FADHIL_query->where('status', $FADHIL_statusCucian);
                })
                ->simplePaginate(10);
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
            $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                    return $FADHIL_query->where('dibayar', $FADHIL_statusBayar);
                })
                ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                    return $FADHIL_query->where('status', $FADHIL_statusCucian);
                })
                ->simplePaginate(10);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Filter Laporan',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil memfilter laporan',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return view('laporan.laporan', [
            'title' => 'Laporan Transaksi',
            'FADHIL_transaksis' => $FADHIL_transaksis,
        ]);
    }

    public function laporanShow(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');
        $FADHIL_statusBayar = $FADHIL_request->input('dibayar');
        $FADHIL_statusCucian = $FADHIL_request->input('status');

        if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_statusBayar) && empty($FADHIL_statusCucian)) {
            if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
                $FADHIL_transaksis = Transaksi::get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();
            } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
                $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                    ->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        } elseif (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        } else {
            if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
                $FADHIL_transaksis = Transaksi::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                    ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                        return $FADHIL_query->where('dibayar', $FADHIL_statusBayar);
                    })
                    ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                        return $FADHIL_query->where('status', $FADHIL_statusCucian);
                    })
                    ->orderBy('tgl', 'desc')->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();
            } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
                $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                    ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                        return $FADHIL_query->whereBetween(DB::raw('DATE(tb_transaksi.tgl)'), [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                    })->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                        return $FADHIL_query->where('tb_transaksi.dibayar', $FADHIL_statusBayar);
                    })->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                        return $FADHIL_query->where('tb_transaksi.status', $FADHIL_statusCucian);
                    })
                    ->orderBy('tb_transaksi.tgl', 'desc')
                    ->get();

                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        return view('laporan.laporan_show', [
            'title' => 'Show Laporan Penjualan',
            'FADHIL_transaksis' => $FADHIL_transaksis,
            'FADHIL_pendapatan' => $FADHIL_pendapatan,
            'FADHIL_tanggal_mulai' => $FADHIL_tanggal_mulai,
            'FADHIL_tanggal_akhir' => $FADHIL_tanggal_akhir,
            'FADHIL_statusBayar' => $FADHIL_statusBayar,
            'FADHIL_statusCucian' => $FADHIL_statusCucian,
            'FADHIL_total' => $FADHIL_total,
        ]);
    }

    public function laporanEksporPDF(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');
        $FADHIL_statusBayar = $FADHIL_request->input('dibayar');
        $FADHIL_statusCucian = $FADHIL_request->input('status');

        if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_statusBayar) && empty($FADHIL_statusCucian)) {
            if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
                $FADHIL_transaksis = Transaksi::get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = 'laporan_laundry__semua_periode.pdf';
            } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
                $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = 'laporan_laundry__semua_periode.pdf';
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        } elseif (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        } else {
            if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
                $FADHIL_transaksis = Transaksi::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                    ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                        return $FADHIL_query->where('dibayar', $FADHIL_statusBayar);
                    })
                    ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                        return $FADHIL_query->where('status', $FADHIL_statusCucian);
                    })
                    ->orderBy('tgl', 'desc')->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = "laporan_laundry-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.pdf";
            } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
                $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                    ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                        return $FADHIL_query->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                    })
                    ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                        return $FADHIL_query->where('dibayar', $FADHIL_statusBayar);
                    })
                    ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                        return $FADHIL_query->where('status', $FADHIL_statusCucian);
                    })
                    ->orderBy('tgl', 'desc')->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = "laporan_laundry-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.pdf";
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        $FADHIL_pdf = app('dompdf.wrapper')->loadview('laporan.cetak_pdf', [
            'FADHIL_transaksis' => $FADHIL_transaksis,
            'FADHIL_tanggal_awal' => $FADHIL_tanggal_mulai,
            'FADHIL_tanggal_akhir' => $FADHIL_tanggal_akhir,
            'FADHIL_pendapatan' => $FADHIL_pendapatan,
            'FADHIL_total' => $FADHIL_total,
            'FADHIL_statusBayar' => $FADHIL_statusBayar,
            'FADHIL_statusCucian' => $FADHIL_statusCucian,
        ]);

        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Ekspor Laporan PDF',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil ekspor laporan PDF',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $FADHIL_pdf->download($FADHIL_namaFile);
    }

    public function laporanEksporXLS(Request $FADHIL_request)
    {
        $FADHIL_tanggal_mulai = $FADHIL_request->input('tanggal_mulai');
        $FADHIL_tanggal_akhir = $FADHIL_request->input('tanggal_akhir');
        $FADHIL_statusBayar = $FADHIL_request->input('dibayar');
        $FADHIL_statusCucian = $FADHIL_request->input('status');

        if (empty($FADHIL_tanggal_mulai) && empty($FADHIL_tanggal_akhir) && empty($FADHIL_statusBayar) && empty($FADHIL_statusCucian)) {
            if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
                $FADHIL_transaksis = Transaksi::get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = 'laporan_laundry__semua_periode.xlsx';
                // $FADHIL_namaFile = 'laporan_laundry_' . (session('nama_outlet') ?? 'Laundry Jaya Pusat') . '_semua_periode.xlsx';
            } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
                $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = 'laporan_laundry_' . (session('nama_outlet') ?? 'Laundry Jaya Pusat') . '_semua_periode.xlsx';
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        } elseif (empty($FADHIL_tanggal_mulai) || empty($FADHIL_tanggal_akhir)) {
            return redirect()->back()->with('error', 'Tanggal mulai dan tanggal akhir harus diisi');
        } else {
            if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
                $FADHIL_transaksis = Transaksi::when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                    return $FADHIL_query->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                })
                    ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                        return $FADHIL_query->where('dibayar', $FADHIL_statusBayar);
                    })
                    ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                        return $FADHIL_query->where('status', $FADHIL_statusCucian);
                    })
                    ->orderBy('tgl', 'desc')->get();
                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = "laporan_laundry-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.xlsx";
            } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
                $FADHIL_transaksis = Transaksi::whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                    ->when($FADHIL_tanggal_mulai && $FADHIL_tanggal_akhir, function ($FADHIL_query) use ($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir) {
                        return $FADHIL_query->whereBetween(DB::raw('DATE(tb_transaksi.tgl)'), [$FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir]);
                    })
                    ->when($FADHIL_statusBayar, function ($FADHIL_query) use ($FADHIL_statusBayar) {
                        return $FADHIL_query->where('tb_transaksi.dibayar', $FADHIL_statusBayar);
                    })
                    ->when($FADHIL_statusCucian, function ($FADHIL_query) use ($FADHIL_statusCucian) {
                        return $FADHIL_query->where('tb_transaksi.status', $FADHIL_statusCucian);
                    })
                    ->orderBy('tb_transaksi.tgl', 'desc')
                    ->get();

                $FADHIL_pendapatan = $FADHIL_transaksis->sum('total');
                $FADHIL_total = $FADHIL_transaksis->count();

                $FADHIL_namaFile = "laporan_laundry_" . (session('nama_outlet') ?? 'Laundry Jaya Pusat') . "-{$FADHIL_tanggal_mulai} - {$FADHIL_tanggal_akhir}.xlsx";
            } else {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }
        $FADHIL_user = Auth::user();

        LogAktifitas::create([
            'id_user' => Auth::id(),
            'aktifitas' => 'Ekspor Laporan Excel',
            'role' => $FADHIL_user->role,
            'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil ekspor laporan Excel',
            'ip_address' => $FADHIL_request->ip(),
            'user_agent' => $FADHIL_request->header('User-Agent'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Excel::download(new TransaksiExport($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir, $FADHIL_statusBayar, $FADHIL_statusCucian, $FADHIL_pendapatan, $FADHIL_total), $FADHIL_namaFile);
    }
}