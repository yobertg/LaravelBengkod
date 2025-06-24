<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\JadwalPeriksa;
use App\Models\DaftarPoli;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function dashboardPasien(){
        $periksas = Periksa::all(); 
        return view('pasien.dashboard', compact('periksas'));
    }
    public function index()
    {
        $polis = Poli::all();
        $jadwals = JadwalPeriksa::with('dokter')->get();
        $riwayats = DaftarPoli::with('jadwalPeriksa.dokter.poli')->where('id_pasien', Auth::id())->get();
        return view('pasien.daftar-poli', compact('polis', 'jadwals', 'riwayats'));
    }

    public function showPoli(Request $request)
    {
        $polis = Poli::all();
        $selectedPoliId = $request->input('id_poli');
        $jadwals = JadwalPeriksa::with('dokter')
            ->when($selectedPoliId, function ($query) use ($selectedPoliId) {
                return $query->whereHas('dokter.poli', function ($query) use ($selectedPoliId) {
                    $query->where('id', $selectedPoliId);
                });
            })
            ->get();

        if ($request->ajax()) {
            return response()->json(['jadwals' => $jadwals]);
        }

        return view('pasien.daftar-poli', compact('polis', 'jadwals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_poli' => 'required|exists:poli,id',
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string|max:1000',
        ]);

        DaftarPoli::create([
            'id_pasien' => Auth::id(),
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $this->generateQueueNumber(),
        ]);

        return redirect()->route('pasien.daftar-poli')->with('success', 'Pendaftaran berhasil.');
    }

    private function generateQueueNumber()
    {
        $latest = DaftarPoli::latest()->first();
        return $latest ? $latest->no_antrian + 1 : 1;
    }
}