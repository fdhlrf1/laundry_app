<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktifitas extends Model
{
    use HasFactory;
    protected $table = 'tb_log_aktifitas';
    protected $fillable = [
        'id_user',
        'aktifitas',
        'role',
        'deskripsi',
        'ip_address',
        'user_agent',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
