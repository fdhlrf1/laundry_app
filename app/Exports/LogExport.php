<?php

namespace App\Exports;

use App\Models\LogAktifitas;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogExport implements FromCollection, WithHeadings
{
    protected $FADHIL_tanggal_mulai;
    protected $FADHIL_tanggal_akhir;
    protected $FADHIL_role;


    public function headings(): array
    {
        return [
            "No.",
            "Nama Lengkap",
            "Aktifitas",
            "Role",
            "Deskripsi",
        ];
    }

    public function __construct($FADHIL_tanggal_mulai, $FADHIL_tanggal_akhir, $FADHIL_role)
    {
        $this->FADHIL_tanggal_mulai = $FADHIL_tanggal_mulai;
        $this->FADHIL_tanggal_akhir = $FADHIL_tanggal_akhir;
        $this->FADHIL_role = $FADHIL_role;


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
        if (Auth::user()->role == 'super_admin') {
            $FADHIL_logs = LogAktifitas::query();

            if ($this->FADHIL_role) {
                $FADHIL_logs->where('role', $this->FADHIL_role);
            }
        } elseif (Auth::user()->role == 'admin') {
            $FADHIL_logs = LogAktifitas::join('tb_user', 'tb_user.id', '=', 'tb_log_aktifitas.id_user')
                ->where('tb_user.id_outlet', Auth::user()->id_outlet);

            if ($this->FADHIL_role) {
                $FADHIL_logs->where('tb_user.role', $this->FADHIL_role);
            }
        } else {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        if ($this->FADHIL_tanggal_mulai && $this->FADHIL_tanggal_akhir) {
            // $FADHIL_logs->whereRaw('DATE(created_at) BETWEEN ? AND ?', [$this->FADHIL_tanggal_mulai, $this->FADHIL_tanggal_akhir]);
            $FADHIL_logs->whereBetween('tb_log_aktifitas.created_at', [$this->FADHIL_tanggal_mulai, $this->FADHIL_tanggal_akhir]);
        }



        $FADHIL_logs = $FADHIL_logs->get();

        $FADHIL_datalog = $FADHIL_logs->map(function ($FADHIL_logs, $FADHIL_index) {
            return [
                $FADHIL_index + 1,
                $FADHIL_logs->user->nama ?? 'N/A',
                $FADHIL_logs->aktifitas,
                $FADHIL_logs->role,
                $FADHIL_logs->deskripsi,
            ];
        });

        $FADHIL_datalog->push([
            '',
            '',
            '',
            'Role yang dipilih:',
            ($this->FADHIL_role) ?? 'Semua Role',
            '',
            '',
            '',
            ''
        ]);


        return $FADHIL_datalog;
    }
}
