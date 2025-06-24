<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    protected $table = 'daftar_poli';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id_pasien', 'id_jadwal', 'keluhan', 'no_antrian'
    ];

    public function pasien()
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function jadwalPeriksa()
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }
    /**
     * Relasi One to Many dengan Periksa
     * Satu DaftarPoli bisa memiliki banyak Periksa
     */
    public function periksas()
    {
        return $this->hasMany(Periksa::class, 'id_daftar_poli');
    }
}