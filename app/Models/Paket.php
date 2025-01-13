<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'tb_paket';
    protected $fillable = [
        'id_outlet',
        'jenis',
        'nama_paket',
        'harga',
        'lama_proses'
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }
}
