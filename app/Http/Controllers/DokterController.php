<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Periksa;
use App\Models\DetailPeriksa;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DokterController extends Controller
{
    public function dashboardDokter(){
        $periksas = Periksa::all(); 
        $obats = Obat::all(); 
        return view('dokter.dashboard', compact('periksas', 'obats'));
    }

     public function addJadwalPeriksa()
    {
        
        return view('dokter.jadwalPeriksaTambah');
    }

    public function storeJadwalPeriksa(Request $request){

            // Validasi input dari form
        $request->validate([
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        // Simpan data ke database
        JadwalPeriksa::create([
            'id_dokter' => auth()->user()->id, // diasumsikan dokter login
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => 'nonaktif', // hardcoded status
        ]);

        return redirect()->route('dokter.jadwalperiksa')->with('success', 'Jadwal periksa berhasil ditambahkan.');

    }

     public function editJadwalPeriksa($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwalPeriksaEdit', compact('jadwal'));
    }

    public function updateJadwalPeriksa(Request $request, $id){
        $request->validate([
        'status' => 'required|in:aktif,nonaktif',
        ]);

        $jadwal = JadwalPeriksa::findOrFail($id);

        if ($request->status == 'aktif') {
            // Nonaktifkan semua jadwal milik dokter yang sama
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('id', '!=', $jadwal->id)
                ->update(['status' => 'nonaktif']);
        }

        // Update status jadwal ini
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->route('dokter.jadwalperiksa')->with('success', 'Status jadwal berhasil diperbarui.');

    }

    public function showJadwalPeriksa()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', auth()->id())->get();
        return view('dokter.jadwalperiksa', compact('jadwals'));
    }

     public function showProfile()
    {
         $dokter = Auth::user(); // Jika user adalah dokter

        return view('dokter.profile', compact('dokter'));
    }

     public function profileUpdate(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $dokter = Auth::user(); // Ambil user yang sedang login

        // Update data
        $dokter->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }

  public function showPeriksa()
    {
        $dokterId = auth()->user()->id ?? null;
        if (!$dokterId) {
            $polis = collect(); // Koleksi kosong jika tidak ada dokter
        } else {
            $polis = DaftarPoli::whereHas('jadwalPeriksa', function ($query) use ($dokterId) {
                $query->where('id_dokter', $dokterId);
            })->with('jadwalPeriksa', 'pasien', 'periksas')->get();
        }

        return view('dokter.polis', compact('polis'));
    }

    public function showFormPeriksa($id_poli)
    {
        $obats = Obat::all();
        $jadwalPeriksas = JadwalPeriksa::where('id_poli', $id_poli)->with('dokter')->get();

        return view('dokter.periksa', compact('obats', 'jadwalPeriksas', 'id_poli'));
    }

    public function periksaStore(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'id_obat' => 'array',
            'id_obat.*' => 'exists:obats,id',
            'biaya_periksa' => 'required|numeric',
            'catatan' => 'nullable|string|max:255',
            'tgl_periksa' => 'required|date',
        ]);

        // Logika untuk menyimpan data ke tabel Periksa dan DetailPeriksa
        $periksa = Periksa::create([
            'id_pasien' => User::where('nama', $validatedData['nama'])->first()->id ?? null, // Sesuaikan logika pasien
            'catatan' => $validatedData['catatan'],
            'biaya_periksa' => $validatedData['biaya_periksa'],
            'tgl_periksa' => $validatedData['tgl_periksa'],
        ]);

        if (!empty($validatedData['id_obat'])) {
            foreach ($validatedData['id_obat'] as $obatId) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obatId,
                ]);
            }
        }

        return redirect()->route('dokter.periksa')->with('success', 'Periksa pasien berhasil disimpan.');
    }

   

    



public function updatePeriksa(Request $request, $id)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'catatan' => 'nullable|string|max:255',
                'tgl_periksa' => 'required|date_format:Y-m-d\TH:i',
                'biaya_periksa' => 'required|numeric|min:150000',
                'id_obat' => 'required|array',
                'id_obat.*' => 'exists:obats,id',
            ]);

            // Cari DaftarPoli berdasarkan ID
            $daftarPoli = DaftarPoli::findOrFail($id);
            Log::info('DaftarPoli found with ID: ' . $id);

            // Buat record Periksa baru
            $periksa = new Periksa();
            $periksa->id_daftar_poli = $id;
            $periksa->catatan = $validated['catatan'];
            $periksa->tgl_periksa = $validated['tgl_periksa'];
            $periksa->biaya_periksa = $validated['biaya_periksa'];

            // Simpan record dan periksa keberhasilannya
            if ($periksa->save()) {
                Log::info('Periksa saved successfully with ID: ' . $periksa->id);

                // Tambahkan detail periksa untuk setiap obat yang dipilih
                foreach ($validated['id_obat'] as $obatId) {
                    $detail = $periksa->detailPeriksas()->create(['id_obat' => $obatId]);
                    Log::info('DetailPeriksa created with id_periksa: ' . $detail->id_periksa . ', id_obat: ' . $obatId);
                }

                // Redirect dengan pesan sukses
                return redirect()->route('dokter.polis')->with('success', 'Pemeriksaan pasien berhasil ditambahkan.');
            } else {
                Log::error('Failed to save Periksa record.');
                throw new \Exception('Gagal menyimpan data pemeriksaan.');
            }

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('ModelNotFoundException: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('ValidationException: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updatePeriksa2(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'catatan' => 'nullable|string|max:255',
                'tgl_periksa' => 'required|date_format:Y-m-d\TH:i',
                'biaya_periksa' => 'required|numeric|min:150000',
                'id_obat' => 'required|array',
                'id_obat.*' => 'exists:obats,id',
            ]);

            $daftarPoli = DaftarPoli::findOrFail($id);
            $periksa = $daftarPoli->periksas()->firstOrFail(); // Ambil record periksa yang ada

            // Update data Periksa
            $periksa->update([
                'catatan' => $validated['catatan'],
                'tgl_periksa' => $validated['tgl_periksa'],
                'biaya_periksa' => $validated['biaya_periksa'],
            ]);

            // Hapus detail periksa lama dan tambahkan yang baru
            $periksa->detailPeriksas()->delete();
            foreach ($validated['id_obat'] as $obatId) {
                $periksa->detailPeriksas()->create(['id_obat' => $obatId]);
            }

            Log::info('Periksa updated successfully with ID: ' . $periksa->id);

            return redirect()->route('dokter.polis')->with('success', 'Pemeriksaan pasien berhasil diperbarui.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('ModelNotFoundException: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Data pendaftaran atau pemeriksaan tidak ditemukan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('ValidationException: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyObat($id){

        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat');
    }

    public function editObat($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obatEdit', compact('obat'));
    }

 public function editPeriksa($id)
    {
        try {
            $daftarPoli = DaftarPoli::with('periksas.detailPeriksas')->findOrFail($id);
            $obats = Obat::select('id', 'nama_obat', 'kemasan', 'harga')->get();
            
            // Ambil semua id_obat dari detail_periksas terkait periksa pertama
            $selectedObats = $daftarPoli->periksas->first() 
                ? $daftarPoli->periksas->first()->detailPeriksas->pluck('id_obat')->toArray() 
                : [];

            // Ambil catatan dan biaya_periksa dari periksa pertama (jika ada)
            $catatan = $daftarPoli->periksas->first() ? $daftarPoli->periksas->first()->catatan ?? '' : '';
            $biayaPeriksa = $daftarPoli->periksas->first() ? $daftarPoli->periksas->first()->biaya_periksa ?? 150000 : 150000;

            return view('dokter.periksaEdit', compact('daftarPoli', 'obats', 'selectedObats', 'catatan', 'biayaPeriksa'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

   public function showRiwayatPasien()
    {
        try {
            // Ambil dokter yang sedang login
            $dokter = auth()->user();
            if (!$dokter || $dokter->role !== 'dokter') {
                return redirect()->back()->with('error', 'Anda bukan dokter.');
            }

            // Ambil semua jadwal dokter yang login
            $jadwals = $dokter->jadwalPeriksa()->get();

            // Ambil semua daftar poli berdasarkan jadwal dokter
            $daftarPolis = DaftarPoli::whereIn('id_jadwal', $jadwals->pluck('id'))
                ->with(['pasien'])
                ->get();

            // Ambil daftar unik pasien berdasarkan id_pasien
            $uniquePasien = $daftarPolis->unique('id_pasien')->map(function ($daftarPoli) {
                $pasien = $daftarPoli->pasien;
                return [
                    'no' => null,
                    'id' => $pasien->id ?? 'N/A',
                    'nama_pasien' => $pasien->nama ?? 'N/A',
                    'alamat' => $pasien->alamat ?? 'N/A',
                    'no_ktp' => $pasien->no_ktp ?? 'N/A',
                    'no_telepon' => $pasien->no_telepon ?? 'N/A',
                    'no_rm' => $pasien->no_rm ?? 'N/A',
                    'aksi' => $daftarPoli->id, // Gunakan id dari DaftarPoli pertama untuk aksi
                ];
            })->values();

            return view('dokter.riwayatPasien', compact('uniquePasien'));
        } catch (\Exception $e) {
            Log::error('Error in showRiwayatPasien: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pasien.');
        }
    }

    public function showPasienDetail($id)
    {
        try {
            // Ambil data DaftarPoli berdasarkan ID
            $daftarPoli = DaftarPoli::with(['pasien', 'periksas.detailPeriksas.obat', 'jadwalPeriksa.dokter'])->findOrFail($id);

            // Ambil semua periksa untuk pasien ini berdasarkan id_pasien
            $allPeriksas = DaftarPoli::where('id_pasien', $daftarPoli->id_pasien)
                ->with(['periksas.detailPeriksas.obat', 'jadwalPeriksa.dokter'])
                ->get()
                ->pluck('periksas')
                ->flatten();

            $riwayat = [];
            foreach ($allPeriksas as $index => $periksa) {
                $obatList = $periksa->detailPeriksas->map(function ($detail) {
                    return $detail->obat ? "{$detail->obat->nama_obat} {$detail->obat->kemasan} {$detail->obat->harga}" : 'N/A';
                })->implode('<br>');
                
                $riwayat[] = [
                    'no' => $index + 1,
                    'tanggal_periksa' => $periksa ? \Carbon\Carbon::parse($periksa->tgl_periksa)->format('Y-m-d H:i:s') : 'Belum diperiksa',
                    'nama_pasien' => $daftarPoli->pasien->nama ?? 'N/A',
                    'nama_dokter' => $periksa->daftarPoli->jadwalPeriksa->dokter->nama ?? 'N/A',
                    'keluhan' => $periksa->daftarPoli->keluhan ?? 'N/A',
                    'catatan' => $periksa->catatan ?? 'Belum ada catatan',
                    'obat' => $obatList,
                    'biaya_periksa' => $periksa ? "Rp" . number_format($periksa->biaya_periksa ?? 0, 0, ',', '.') : 'Rp0',
                ];
            }

            return response()->json($riwayat);
        } catch (\Exception $e) {
            Log::error('Error in showPasienDetail: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan saat memuat detail pasien.'], 500);
        }
    }
}




