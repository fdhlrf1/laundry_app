<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromCollection, WithHeadings
{

    protected $FADHIL_tanggal_mulai;
    protected $FADHIL_tanggal_akhir;
    protected $FADHIL_total;
    protected $FADHIL_pendapatan;
    protected $FADHIL_statusBayar;
    protected $FADHIL_statusCucian;


    public function headings(): array
    {
        return [
            "No.",
            "Kode Invoice",
            "Nama Pelanggan",
            "Tanggal Pesan",
            "Batas Waktu",
            "Status Cucian",
            "Status Pembayaran",
            "Total",
        ];
    }

    public function __construct($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir, $FADHIL_statusBayar, $FADHIL_statusCucian, $FADHIL_pendapatan, $FADHIL_total)
    {
        $this->FADHIL_tanggal_mulai = $FADHIL_tanggal_mulai;
        $this->FADHIL_tanggal_akhir = $FADHIL_tanggal_akhir;
        $this->FADHIL_statusBayar = $FADHIL_statusBayar;
        $this->FADHIL_statusCucian = $FADHIL_statusCucian;
        $this->FADHIL_pendapatan = $FADHIL_pendapatan;
        $this->FADHIL_total = $FADHIL_total;

        // Log output
        // Log::info('PenjualanExport constructed with data:', [
        //     'start' => $this->start,
        //     'end' => $this->end,
        //     'metode_pembayaran' => $this->metode_pembayaran,
        //     'status' => $this->status,
        // ]);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()->role == 'super_admin' || Auth::user()->role == 'super_owner') {
            $FADHIL_transaksis = Transaksi::query();
        } elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'kasir' || Auth::user()->role == 'owner') {
            $FADHIL_transaksis = Transaksi::join('tb_detail_transaksi', 'tb_transaksi.id', '=', 'tb_detail_transaksi.id_transaksi')
                ->join('tb_paket', 'tb_detail_transaksi.id_paket', '=', 'tb_paket.id')
                ->where('tb_paket.id_outlet', Auth::user()->id_outlet);
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($this->FADHIL_tanggal_mulai && $this->FADHIL_tanggal_akhir) {
            $FADHIL_transaksis->whereRaw('DATE(tgl) BETWEEN ? AND ?', [$this->FADHIL_tanggal_mulai, $this->FADHIL_tanggal_akhir]);
        }

        if ($this->FADHIL_statusBayar) {
            $FADHIL_transaksis->where('dibayar', $this->FADHIL_statusBayar);
        }

        if ($this->FADHIL_statusCucian) {
            $FADHIL_transaksis->where('status', $this->FADHIL_statusCucian);
        }

        $FADHIL_transaksis = $FADHIL_transaksis->get();

        $FADHIL_data = $FADHIL_transaksis->map(function ($FADHIL_transaksi, $FADHIL_index) {
            return [
                $FADHIL_index + 1,
                "'" . $FADHIL_transaksi->kode_invoice,
                $FADHIL_transaksi->nama_pelanggan ?? 'N/A',
                Carbon::parse($FADHIL_transaksi->tgl)->format('Y-m-d'),
                Carbon::parse($FADHIL_transaksi->batas_waktu)->format('Y-m-d'),
                $FADHIL_transaksi->status,
                $FADHIL_transaksi->dibayar,
                'Rp. ' . number_format($FADHIL_transaksi->total, 0, ',', '.'),
            ];
        });

        $FADHIL_data->push([
            '',
            '',
            '',
            'Total Pendapatan',
            'Rp. ' . number_format($this->FADHIL_pendapatan, 0, ',', '.'),
            '',
            '',
            '',
            ''
        ]);
        $FADHIL_data->push([
            '',
            '',
            '',
            'Total Cucian',
            $this->FADHIL_total,
            '',
            '',
            '',
            ''
        ]);

        return $FADHIL_data;
    }
}
