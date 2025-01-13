<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_transaksi')->insert([
            [
                'kode_invoice' => 'INV0001',
                'id_member' => 1, // Misalkan id_member 1 untuk member yang ada di tabel tb_member
                'nama_pelanggan' => 'John Doe',
                'alamat' => 'Jl. Raya No. 123, Jakarta',
                'tlp' => '081234567890',
                'tgl' => Carbon::now(), // Tanggal transaksi
                'batas_waktu' => Carbon::now()->addDays(3), // Batas waktu 3 hari
                'tgl_bayar' => Carbon::now()->addDays(2), // Pembayaran 2 hari setelah transaksi
                'biaya_tambahan' => 5000,
                'diskon' => 10, // Diskon 10%
                'pajak' => 5, // Pajak 5%
                'status' => 'baru', // Status awal transaksi
                'dibayar' => 'belum_dibayar', // Status pembayaran
                'id_user' => 1, // id_user yang membuat transaksi
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
