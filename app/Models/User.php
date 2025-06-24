<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'email',
        'password',
        'id_poli',
        'no_ktp',
        'no_rm',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jadwalPeriksa()
    {
       return $this->hasMany(JadwalPeriksa::class, 'id_dokter');
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_pasien');
    }


    // Relasi-relasi bisa ditambahkan kembali di sini jika dibutuhkan
}
