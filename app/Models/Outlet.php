<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table = 'tb_outlet';
    protected $fillable = [
        'nama',
        'alamat',
        'tlp',
    ];

    public function paket()
    {
        return $this->hasMany(Paket::class, 'id_outlet', 'id');
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function transaksi()
    {
        return $this->hasManyThrough(
            Transaksi::class,
            User::class,
            'id_outlet', // Foreign key di tabel User
            'id_user',   // Foreign key di tabel Transaksi
            'id',        // Primary key di tabel Outlet
            'id'         // Primary key di tabel User
        );
    }
}
