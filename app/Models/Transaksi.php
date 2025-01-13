<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';
    protected $fillable = [
        'kode_invoice',
        'id_member',
        'nama_pelanggan',
        'alamat',
        'tlp',
        'tgl',
        'batas_waktu',
        'tgl_bayar',
        'biaya_tambahan',
        'diskon',
        'pajak',
        'status',
        'dibayar',
        'total',
        'bayar',
        'kembalian',
    ];

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function paket()
    {
        return $this->hasManyThrough(Paket::class, DetailTransaksi::class, 'id_transaksi', 'id', 'id', 'id_paket');
    }
}
