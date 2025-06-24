<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Poli;
use App\Models\Obat;

class AdminController extends Controller
{
    // DASHBOARD
    public function dashboardAdmin()
    {
       $jumlahDokter = User::where('role', 'dokter')->count();
       $jumlahPasien = User::where('role', 'pasien')->count();
        $jumlahPoli = Poli::count();

        return view('admin.dashboard', compact('jumlahDokter', 'jumlahPasien', 'jumlahPoli'));
    }

    // =================== DOKTER ===================
   public function showDokter()
{
    $dokters = User::where('role', 'dokter')->with('poli')->get(); // asumsikan ada relasi ke poli
    $polis = Poli::all();
    return view('admin.dokter', compact('dokters', 'polis'));
}

public function storeDokter(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required',
        'id_poli' => 'required|exists:poli,id',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
        'id_poli' => $request->id_poli,
        'role' => 'dokter',
        'email' => strtolower($request->email),
        'password' => bcrypt($request->password),
    ]);

    return redirect()->back()->with('success', 'Dokter berhasil ditambahkan.');
}





public function updateDokter(Request $request, $id)
{
    $dokter = User::where('role', 'dokter')->findOrFail($id);
    $dokter->update($request->all());
    return redirect()->route('admin.dokter')->with('success', 'Data dokter berhasil diupdate.');
}

public function destroyDokter($id)
{
    $dokter = User::where('role', 'dokter')->findOrFail($id);
    $dokter->delete();
    return redirect()->back()->with('success', 'Data dokter berhasil dihapus.');
}

// =================== PASIEN ===================
public function showPasien()
{
    $pasiens = User::where('role', 'pasien')->get();
    $jumlahPasien = User::where('role', 'pasien')->count() + 1;
    // Format no_rm: YYYYMM-XXX
    $no_rm = now()->format('Ym') . '-' . str_pad($jumlahPasien, 3, '0', STR_PAD_LEFT);

    return view('admin.pasien', compact('pasiens', 'no_rm'));;
}

public function storePasien(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'no_ktp' => 'required',
        'no_hp' => 'required',
        'no_rm' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'no_ktp' => $request->no_ktp,
        'no_hp' => $request->no_hp,
        'no_rm' => $request->no_rm,
        'role' => 'pasien',
        'email' => strtolower($request->email),
        'password' => bcrypt($request->password),
    ]);

    return redirect()->back()->with('success', 'Pasien berhasil ditambahkan.');
}


public function updatePasien(Request $request, $id)
{
    $pasien = User::where('role', 'pasien')->findOrFail($id);
    $pasien->update($request->all());
    return redirect()->route('admin.pasien')->with('success', 'Data pasien berhasil diupdate.');
}

public function destroyPasien($id)
{
    $pasien = User::where('role', 'pasien')->findOrFail($id);
    $pasien->delete();
    return redirect()->route('admin.pasien')->with('success', 'Data pasien berhasil dihapus.');
}

    // =================== POLI ===================
    public function showPoli()
    {
        $polis = Poli::all();
        return view('admin.poli', compact('polis'));
    }

    public function storePoli(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'required'
        ]);

        Poli::create($request->all());
        return redirect()->back()->with('success', 'Poli berhasil ditambahkan.');
    }

    public function updatePoli(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);
        $poli->update($request->all());
        return redirect()->route('admin.poli')->with('success', 'Data poli berhasil diupdate.');
    }

    public function destroyPoli($id)
    {
        Poli::findOrFail($id)->delete();
        return redirect()->route('admin.poli')->with('success', 'Data poli berhasil dihapus.');
    }

    public function showObat()
    {
        $obats = Obat::all();
        return view('admin.obat', compact('obats'));
    }

    public function storeObat(Request $request)
    {
        $validateData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => ['required']
        ]);

        Obat::create([
            'nama_obat' => $validateData['nama_obat'],
            'kemasan' => $validateData['kemasan'],
            'harga' => $validateData['harga']
        ]);

        return redirect()->route('admin.obat')->with('success', 'Obat Berhasil di Buat');
    }

    public function updateObat(Request $request, $id){

        $validatedData = $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => ['required'],
        ]);

        $obat = Obat::findOrFail($id);

        $obat->update([
            'nama_obat' => $validatedData['nama_obat'],
            'kemasan' => $validatedData['kemasan'],
            'harga' => $validatedData['harga'],
        ]);

        return redirect()->route('admin.obat')->with('success', 'Obat Berhasil di edit');

    }

     public function destroyObat($id){

        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('admin.obat');
    }

    public function editObat($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obatEdit', compact('obat'));
    }
     public function editPasien($id)
    {
        $pasien = User::where('role', 'pasien')->findOrFail($id);
        // $jumlahPasien = User::where('role', 'pasien')->count() + 1;
        // // Format no_rm: YYYYMM-XXX
        // $no_rm = now()->format('Ym') . '-' . str_pad($jumlahPasien, 3, '0', STR_PAD_LEFT);
        return view('admin.pasienEdit', compact('pasien'));
    }
    public function editDokter($id)
    {
        $dokter = User::where('role', 'dokter')->findOrFail($id);
        $polis = Poli::all(); // ambil semua data poli
        return view('admin.dokterEdit', compact('dokter', 'polis'));
    }

     public function editPoli($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.poliEdit', compact('poli'));
    }
}
