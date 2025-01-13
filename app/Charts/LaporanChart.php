<?php

namespace App\Charts;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class LaporanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        if (Auth()->user()->role == 'super_admin' || Auth()->user()->role == 'super_owner') {
            $FADHIL_laporanPendapatan = Transaksi::selectRaw('MONTH(tgl) as bulan, YEAR(tgl) as tahun, SUM(total) as total_pendapatan')
                ->groupBy('tahun', 'bulan')
                ->orderBy('tahun')
                ->orderBy('bulan')
                ->get();
        } else {
            $FADHIL_laporanPendapatan = Transaksi::whereHas('paket', function ($FADHIL_query) {
                $FADHIL_query->where('id_outlet', Auth::user()->id_outlet);
            })
                ->selectRaw('MONTH(tgl) as bulan, YEAR(tgl) as tahun, SUM(total) as total_pendapatan')
                ->groupBy('tahun', 'bulan')
                ->orderBy('tahun')
                ->orderBy('bulan')
                ->get();
        }

        $FADHIL_bulans = [];
        $FADHIL_total_pendapatan = [];

        foreach ($FADHIL_laporanPendapatan as $FADHIL_pendapatan) {
            $FADHIL_bulans[] = date('F Y', mktime(0, 0, 0, $FADHIL_pendapatan->bulan, 1, $FADHIL_pendapatan->tahun));
            $FADHIL_total_pendapatan[] = $FADHIL_pendapatan->total_pendapatan;
        }

        return $this->chart->barChart()
            ->setTitle('Total Pendapatan per Bulan')
            ->setSubtitle('Data Pendapatan Bulanan')
            ->addData('Pendapatan', $FADHIL_total_pendapatan)
            ->setLabels($FADHIL_bulans)
            ->setFontFamily('OpenSans');

        // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}