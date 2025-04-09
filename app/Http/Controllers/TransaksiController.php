<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Paket;
use App\Models\Member;
use App\Models\Transaksi;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Support\Str;
use App\Models\LogAktifitas;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewView;

class TransaksiController extends Controller
{
    public function index()
    {
        $FADHIL_members = Member::all();

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_pakets = Paket::latest()->get();
        } elseif (Auth::user()->role == 'admin' || Auth()->user()->role == 'kasir') {
            $FADHIL_pakets = Paket::where('id_outlet', Auth::user()->id_outlet)
                ->latest()
                ->get();
        }

        $FADHIL_kode_invoice =  DB::table('view_next_kode_invoice')->value('nextkodeinvoice');
        return view('transaksi.transaksi', [
            'title' => 'Transaksi Laundry',
            'FADHIL_pakets' => $FADHIL_pakets,
            'FADHIL_members' => $FADHIL_members,
            'FADHIL_kode_invoice' => $FADHIL_kode_invoice,

        ]);
    }

    public function store(Request $FADHIL_request)
    {
        $FADHIL_request->validate([
            //tb_transaksi
            'kode_invoice' => 'required',
            'id_member' => 'nullable',
            'nama_pelanggan' => 'nullable',
            'alamat' => 'nullable',
            'telepon' => 'nullable',
            'batas_waktu' => 'required',
            'biaya_tambahan' => 'nullable',
            'diskon' => 'required',
            'pajak' => 'required',
            'total' => 'required',
            //tb_detail_transaksi
            'id_paket' => 'required',
            'kuantitas' => 'required',
            'keterangan' => 'nullable',
        ]);

        // dd($FADHIL_request->all());
        Log::info('Data transaksi:', $FADHIL_request->all());
        $FADHIL_member = Member::where('id', $FADHIL_request->id_member)->first();

        $FADHIL_id_user = Auth()->id();

        DB::beginTransaction();
        try {
            Log::info('Data transaksi:', [
                'kode_invoice' => $FADHIL_request->kode_invoice,
                'id_member' => $FADHIL_request->id_member !== null ? $FADHIL_request->id_member : null,
                'nama_pelanggan' => $FADHIL_request->nama_pelanggan !== null ? $FADHIL_request->nama_pelanggan : $FADHIL_member->nama,
                'alamat' => $FADHIL_request->alamat !== null ? $FADHIL_request->alamat : $FADHIL_member->alamat,
                'tlp' => $FADHIL_request->telepon !== null ? $FADHIL_request->telepon : $FADHIL_member->tlp,
                'tgl' => now(),
                'batas_waktu' => $FADHIL_request->batas_waktu,
                'tgl_bayar' => null,
                'biaya_tambahan' => $FADHIL_request->biaya_tambahan !== null ? $FADHIL_request->biaya_tambahan : 0,
                'diskon' => $FADHIL_request->diskon !== null ? $FADHIL_request->diskon : 0,
                'pajak' => $FADHIL_request->pajak !== null ? $FADHIL_request->pajak : 0,
                'status' => 'baru',
                'dibayar' => 'belum dibayar',
                'id_user' => $FADHIL_id_user,
                'total' => $FADHIL_request->total,
                'bayar' => 0,
                'kembalian' => 0,
                'id_paket' => $FADHIL_request->id_paket,
                'kuantitas' => $FADHIL_request->kuantitas,
                'keterangan' => $FADHIL_request->keterangan !== null ? $FADHIL_request->keterangan : null
            ]);
            // dd([
            //     'kode_invoice' => $FADHIL_request->kode_invoice,
            //     'id_member' => $FADHIL_request->id_member !== null ? $FADHIL_request->id_member : null,
            //     'nama_pelanggan' => $FADHIL_request->nama_pelanggan !== null ? $FADHIL_request->nama_pelanggan : $FADHIL_member->nama,
            //     'alamat' => $FADHIL_request->alamat !== null ? $FADHIL_request->alamat : $FADHIL_member->alamat,
            //     'tlp' => $FADHIL_request->telepon !== null ? $FADHIL_request->telepon : $FADHIL_member->tlp,
            //     'tgl' => now(),
            //     'batas_waktu' => $FADHIL_request->batas_waktu,
            //     'tgl_bayar' => null,
            //     'biaya_tambahan' => $FADHIL_request->biaya_tambahan !== null ? $FADHIL_request->biaya_tambahan : 0,
            //     'diskon' => $FADHIL_request->diskon !== null ? $FADHIL_request->diskon : 0,
            //     'pajak' => $FADHIL_request->pajak !== null ? $FADHIL_request->pajak : 0,
            //     'status' => 'baru',
            //     'dibayar' => 'belum dibayar',
            //     'id_user' => $FADHIL_id_user,
            //     'total' => $FADHIL_request->total,
            //     'bayar' => 0,
            //     'kembalian' => 0,
            // ]);

            \Carbon\Carbon::setLocale('id');
            $FADHIL_now = \Carbon\Carbon::now('Asia/Jakarta');

            $FADHIL_transaksi = new Transaksi();
            $FADHIL_transaksi->kode_invoice = $FADHIL_request->kode_invoice;
            $FADHIL_transaksi->id_member = $FADHIL_request->id_member !== null ? $FADHIL_request->id_member : null;
            $FADHIL_transaksi->nama_pelanggan = $FADHIL_request->nama_pelanggan !== null ? $FADHIL_request->nama_pelanggan : ($FADHIL_member->nama ?? null);
            $FADHIL_transaksi->alamat = $FADHIL_request->alamat !== null ? $FADHIL_request->alamat : ($FADHIL_member->alamat ?? null);
            $FADHIL_transaksi->tlp = $FADHIL_request->telepon !== null ? $FADHIL_request->telepon : ($FADHIL_member->tlp ?? null);
            $FADHIL_transaksi->tgl = $FADHIL_now;
            $FADHIL_transaksi->batas_waktu = $FADHIL_request->batas_waktu;
            $FADHIL_transaksi->tgl_bayar = null;
            $FADHIL_transaksi->biaya_tambahan = $FADHIL_request->biaya_tambahan !== null ? $FADHIL_request->biaya_tambahan : 0;
            $FADHIL_transaksi->diskon = $FADHIL_request->diskon !== null ? $FADHIL_request->diskon : 0;
            $FADHIL_transaksi->pajak = $FADHIL_request->pajak !== null ? $FADHIL_request->pajak : 0;
            $FADHIL_transaksi->status = 'baru';
            $FADHIL_transaksi->dibayar = 'belum_dibayar';
            $FADHIL_transaksi->id_user = $FADHIL_id_user;
            $FADHIL_transaksi->total = $FADHIL_request->total;
            $FADHIL_transaksi->bayar = 0;
            $FADHIL_transaksi->kembalian = 0;
            $FADHIL_transaksi->save();

            DetailTransaksi::create([
                'id_transaksi' => $FADHIL_transaksi->id,
                'id_paket' => $FADHIL_request->id_paket,
                'qty' => $FADHIL_request->kuantitas,
                'keterangan' => $FADHIL_request->keterangan !== null ? $FADHIL_request->keterangan : null,
            ]);

            $FADHIL_user = Auth::user();

            LogAktifitas::create([
                'id_user' => Auth::id(),
                'aktifitas' => 'Melakukan Transaksi',
                'role' => $FADHIL_user->role,
                'deskripsi' => 'User ' . $FADHIL_user->nama . ' dengan role ' . ucfirst($FADHIL_user->role) . ' berhasil melakukan transaksi',
                'ip_address' => $FADHIL_request->ip(),
                'user_agent' => $FADHIL_request->header('User-Agent'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            DB::commit();

            return redirect()->route('cetakStruk', ['FADHIL_id' => $FADHIL_transaksi->id]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat menyimpan transaksi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function cetakStruk($FADHIL_id)
    {

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_struk = Transaksi::with(['detailTransaksi', 'detailTransaksi.paket', 'user.outlet'])
                ->where('id', $FADHIL_id)
                ->firstOrFail();

            if (!$FADHIL_struk) {
                return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
            }
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir') {
            $FADHIL_struk = Transaksi::with(['detailTransaksi', 'detailTransaksi.paket', 'user.outlet'])
                ->where('id', $FADHIL_id)
                ->whereHas('paket', function ($FADHIL_query) {
                    $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
                })
                ->firstOrFail();

            if (!$FADHIL_struk) {
                return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
            }
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }


        // $FADHIL_kodeStruk = 'STR-' . strtoupper(Guid::uuid4()->toString());
        $FADHIL_kodeStruk = strtoupper(Guid::uuid4()->toString());


        // if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
        //     $FADHIL_details = Transaksi::findOrFail($FADHIL_id);
        //     $FADHIL_details_trs = DetailTransaksi::where('id_transaksi', $FADHIL_details->id)->get();
        // } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
        //     $FADHIL_details = Transaksi::where('id', $FADHIL_id)
        //         ->whereHas('paket', function ($FADHIL_query) {
        //             $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
        //         })
        //         ->firstOrFail();

        //     $FADHIL_details_trs = DetailTransaksi::where('id_transaksi', $FADHIL_details->id)
        //         ->whereHas('paket', function ($FADHIL_query) {
        //             $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
        //         })
        //         ->get();
        // } else {
        //     abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        // }

        // dd($transaksi, $detailTransaksi);

        return view('transaksi.struk_transaksi', [
            'title' => 'Struk Transaksi',
            'FADHIL_kodeStruk' => $FADHIL_kodeStruk,
            'FADHIL_struk' => $FADHIL_struk,

        ]);
    }

    public function laporanRedirect()
    {
        session()->flash('success', 'Transaksi Berhasil');
        return redirect()->route('laporan');
    }
}