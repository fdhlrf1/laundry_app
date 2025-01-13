<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use App\Charts\LaporanChart;
use App\Charts\PesananChart;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index(LaporanChart $FADHIL_laporanChart, PesananChart $FADHIL_pesananChart)
    {

        \Carbon\Carbon::setLocale('id');
        $FADHIL_now = \Carbon\Carbon::now('Asia/Jakarta');

        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {

            $FADHIL_transaksiBulanini = Transaksi::whereYear('tgl', $FADHIL_now->year)
                ->whereMonth('tgl', $FADHIL_now->month)
                ->sum('total');
            $FADHIL_transaksiBulanlalu = Transaksi::whereYear('tgl', $FADHIL_now->copy()->subMonth()->year)
                ->whereMonth('tgl', $FADHIL_now->copy()->subMonth()->month)
                ->sum('total');
            $FADHIL_persentaseKenaikanTransaksi = $FADHIL_transaksiBulanlalu > 0
                ? (($FADHIL_transaksiBulanini - $FADHIL_transaksiBulanlalu) / $FADHIL_transaksiBulanlalu) * 100
                : 0;

            $FADHIL_outletAktif = Outlet::count();
            $FADHIL_totalMember = Member::count();
            $FADHIL_totalPendapatan = Transaksi::sum('total');
            $FADHIL_totalPesanan = Transaksi::count();

            $FADHIL_dataTransaksiBulanini = Transaksi::whereYear('tgl', $FADHIL_now->year)
                ->whereMonth('tgl', $FADHIL_now->month)
                ->count();
            // dd($tPenjualanBulanIni);
            $FADHIL_dataTransaksiBulanlalu = Transaksi::whereYear('tgl', $FADHIL_now->copy()->subMonth()->year)
                ->whereMonth('tgl', $FADHIL_now->copy()->subMonth()->month)
                ->count();

            $FADHIL_persentaseKenaikanPesanan = $FADHIL_dataTransaksiBulanlalu > 0
                ? (($FADHIL_dataTransaksiBulanini - $FADHIL_dataTransaksiBulanlalu) / $FADHIL_dataTransaksiBulanlalu) * 100
                : 0;

            $FADHIL_transaksiTerbaru = Transaksi::orderBy('tgl', 'desc')
                ->take(3)
                ->get();

            $FADHIL_outlet = Outlet::all();
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
            $FADHIL_transaksiBulanini = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->whereYear('tgl', $FADHIL_now->year)
                ->whereMonth('tgl', $FADHIL_now->month)
                ->sum('total');
            // dd($FADHIL_transaksiBulanini);
            $FADHIL_transaksiBulanlalu = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->whereYear('tgl', $FADHIL_now->copy()->subMonth()->year)
                ->whereMonth('tgl', $FADHIL_now->copy()->subMonth()->month)
                ->sum('total');
            // dd($FADHIL_transaksiBulanlalu);
            $FADHIL_persentaseKenaikanTransaksi = $FADHIL_transaksiBulanlalu > 0
                ? (($FADHIL_transaksiBulanini - $FADHIL_transaksiBulanlalu) / $FADHIL_transaksiBulanlalu) * 100
                : 0;

            $FADHIL_outletAktif = Outlet::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })->count();
            $FADHIL_totalMember = Member::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->count();
            $FADHIL_totalPendapatan = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->sum('total');
            $FADHIL_totalPesanan = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->count();

            $FADHIL_dataTransaksiBulanini = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->whereYear('tgl', $FADHIL_now->year)
                ->whereMonth('tgl', $FADHIL_now->month)
                ->count();
            // dd($tPenjualanBulanIni);
            $FADHIL_dataTransaksiBulanlalu = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->whereYear('tgl', $FADHIL_now->copy()->subMonth()->year)
                ->whereMonth('tgl', $FADHIL_now->copy()->subMonth()->month)
                ->count();
            $FADHIL_persentaseKenaikanPesanan = $FADHIL_dataTransaksiBulanlalu > 0
                ? (($FADHIL_dataTransaksiBulanini - $FADHIL_dataTransaksiBulanlalu) / $FADHIL_dataTransaksiBulanlalu) * 100
                : 0;

            $FADHIL_transaksiTerbaru = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->orderBy('tgl', 'desc')
                ->take(3)
                ->get();


            $FADHIL_outlet  = Outlet::all();
        } else {
            abort(403);
        }

        return view('beranda', [
            'title' => 'Beranda',
            'FADHIL_persentaseKenaikanTransaksi' => $FADHIL_persentaseKenaikanTransaksi,
            'FADHIL_persentaseKenaikanPesanan' => $FADHIL_persentaseKenaikanPesanan,
            'FADHIL_outletAktif' => $FADHIL_outletAktif,
            'FADHIL_totalMember' => $FADHIL_totalMember,
            'FADHIL_totalPendapatan' => $FADHIL_totalPendapatan,
            'FADHIL_totalPesanan' => $FADHIL_totalPesanan,
            'FADHIL_transaksiTerbaru' => $FADHIL_transaksiTerbaru,
            'FADHIL_outlet' => $FADHIL_outlet,
            'FADHIL_laporanChart' => $FADHIL_laporanChart->build(),
            'FADHIL_pesananChart' => $FADHIL_pesananChart->build(),
        ]);
    }
}