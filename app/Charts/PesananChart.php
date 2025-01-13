<?php

namespace App\Charts;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PesananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {

        if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner') {
            $FADHIL_laporanPesanan = Transaksi::selectRaw('MONTH(tgl) as bulan, YEAR(tgl) as tahun, COUNT(*) as total_pesanan')
                ->groupBy('tahun', 'bulan')
                ->orderBy('tahun')
                ->orderBy('bulan')
                ->get();
        } else {
            $FADHIL_laporanPesanan = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->selectRaw('MONTH(tgl) as bulan, YEAR(tgl) as tahun, COUNT(*) as total_pesanan')
                ->groupBy('tahun', 'bulan')
                ->orderBy('tahun')
                ->orderBy('bulan')
                ->get();
        }

        $FADHIL_bulans = [];
        $FADHIL_total_pesanan = [];

        foreach ($FADHIL_laporanPesanan as $FADHIL_pesanan) {
            $FADHIL_bulans[] = date('F Y', mktime(0, 0, 0, $FADHIL_pesanan->bulan, 1, $FADHIL_pesanan->tahun));
            $FADHIL_total_pesanan[] = $FADHIL_pesanan->total_pesanan;
        }


        return $this->chart->donutChart()
            ->setTitle('Total Pesanan per Bulan')
            ->setSubtitle('Data Pesanan Bulanan')
            ->addData($FADHIL_total_pesanan)
            ->setLabels($FADHIL_bulans)
            ->setFontFamily('OpenSans');
    }
}