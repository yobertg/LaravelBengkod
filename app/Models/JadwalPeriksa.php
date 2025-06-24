<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPeriksa extends Model
{
    protected $table = 'jadwal_periksa';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id_dokter', 'hari', 'jam_mulai', 'jam_selesai', 'status'
    ];

    public function dokter()
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    public function daftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
}