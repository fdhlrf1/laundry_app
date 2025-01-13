<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    public function index()
    {
        $FADHIL_members = Member::all();

        if (Auth::user()->role == 'super_admin') {
            $FADHIL_pakets = Paket::latest()->get(); // Mengambil semua paket
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_pakets = Paket::where('id_outlet', Auth::user()->id_outlet)
                ->latest()
                ->get(); // Mengambil paket sesuai outlet admin
        }

        $FADHIL_kode_invoice =  DB::table('view_next_kode_invoice')->value('nextkodeinvoice');
        return view('transaksi.transaksi', [
            'title' => 'Transaksi',
            'FADHIL_pakets' => $FADHIL_pakets,
            'FADHIL_members' => $FADHIL_members,
            'FADHIL_kode_invoice' => $FADHIL_kode_invoice,
        ]);
    }

    public function store(Request $FADHIL_request)
    {
        $FADHIL_request->validate(
            [
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
                // 'bayar' => 'nullable',
                // 'kembalian' => 'required',
                //tb_detail_transaksi
                'id_paket' => 'required',
                'kuantitas' => 'required',
                'keterangan' => 'nullable',
            ]
        );

        // dd($FADHIL_validasi);

        $FADHIL_member = Member::where('id', $FADHIL_request->id_member)->first();

        // dd($FADHIL_member->nama);


        DB::beginTransaction();

        try {
            Log::info('Data transaksi:', [
                'kode_invoice' => $FADHIL_request->kode_invoice,
                'id_member' => $FADHIL_request->id_member,
                'nama_pelanggan' => $FADHIL_request->nama_pelanggan ?? ($FADHIL_member->nama ?? null),
                'alamat' => $FADHIL_request->alamat ?? ($FADHIL_member->alamat ?? null),
                'tlp' => $FADHIL_request->telepon ?? ($FADHIL_member->telepon ?? null),
                'batas_waktu' => $FADHIL_request->batas_waktu,
                'biaya_tambahan' => $FADHIL_request->biaya_tambahan ?? 0,
                'diskon' => $FADHIL_request->diskon ?? 0,
                'pajak' => $FADHIL_request->pajak ?? 0,
                'total' => $FADHIL_request->total,
                'id_paket' => $FADHIL_request->id_paket,
                'kuantitas' => $FADHIL_request->kuantitas,
                'keterangan' => $FADHIL_request->keterangan ?? null
            ]);

            // die;
            $FADHIL_transaksi = new Transaksi();
            $FADHIL_transaksi->kode_invoice = $FADHIL_request->kode_invoice;
            $FADHIL_transaksi->id_member = $FADHIL_request->id_member !== null ? $FADHIL_request->id_member : null;
            $FADHIL_transaksi->nama_pelanggan = $FADHIL_request->nama_pelanggan !== null ? $FADHIL_request->nama_pelanggan : ($FADHIL_member->nama ?? null);
            $FADHIL_transaksi->alamat = $FADHIL_request->alamat !== null ? $FADHIL_request->alamat : ($FADHIL_member->alamat ?? null);
            $FADHIL_transaksi->tlp = $FADHIL_request->telepon !== null ? $FADHIL_request->telepon : ($FADHIL_member->tlp ?? null);
            $FADHIL_transaksi->tgl = now();
            $FADHIL_transaksi->batas_waktu = $FADHIL_request->batas_waktu;
            $FADHIL_transaksi->tgl_bayar = null;
            $FADHIL_transaksi->biaya_tambahan = $FADHIL_request->biaya_tambahan !== null ? $FADHIL_request->biaya_tambahan : 0;
            $FADHIL_transaksi->diskon = $FADHIL_request->diskon !== null ? $FADHIL_request->diskon : 0;
            $FADHIL_transaksi->pajak = $FADHIL_request->pajak  !== null ? $FADHIL_request->pajak : 0;
            $FADHIL_transaksi->status = 'baru';
            $FADHIL_transaksi->dibayar = 'belum_dibayar';
            $FADHIL_transaksi->id_user = Auth()->id();
            $FADHIL_transaksi->total = $FADHIL_request->total;
            $FADHIL_transaksi->bayar = 0;
            $FADHIL_transaksi->kembalian = 0;
            $FADHIL_transaksi->save();

            DetailTransaksi::create([
                'id_transaksi' => $FADHIL_transaksi->id,
                'id_paket' => $FADHIL_request->id_paket,
                'qty' => $FADHIL_request->kuantitas,
                'keterangan' => $FADHIL_request->keterangan ?? null,
            ]);

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dilakukan.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat menyimpan transaksi: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
