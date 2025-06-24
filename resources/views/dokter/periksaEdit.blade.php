@extends('layout')
@section('sidebar')
    <!-- Sidebar content remains unchanged -->
    <li class="nav-item menu-open">
        <a href="#" class="nav-link {{ Request::is('/') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/dokter/jadwalPeriksa" class="nav-link {{ Request::is('dokter/jadwalPeriksa*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Jadwal Periksa
                <span class="right badge badge-danger">New</span>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/dokter/polis" class="nav-link {{ Request::is('dokter/polis*') ? 'active' : '' }}">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Memeriksa Pasien
                <span class="badge badge-info right">dokter</span>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/dokter/riwayatPasien" class="nav-link {{ Request::is('dokter/riwayatPasien*') ? 'active' : '' }}">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Riwayat Pasien
                <span class="badge badge-info right">dokter</span>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/dokter/profile" class="nav-link {{ Request::is('dokter/profile*') ? 'active' : '' }}">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
                Profile
                <span class="badge badge-info right">dokter</span>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <form action="{{ route('auth.logout.post') }}" method="post">
            @csrf
            <button type="submit" class="nav-link btn btn-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </button>
        </form>
    </li>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periksa Pasien</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Periksa Pasien</h3>
                            </div>
                            @if ($daftarPoli->periksas->isEmpty() || !$daftarPoli->periksas->first()->catatan)
                                <form method="POST" action="{{ route('dokter.periksaUpdate', $daftarPoli->id) }}">
                                    @csrf
                            @else
                                <form method="POST" action="{{ route('dokter.periksaUpdate2', $daftarPoli->id) }}">
                                    @csrf
                                    @method('PUT') <!-- Untuk update, gunakan PUT -->
                            @endif
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Pasien</label>
                                        <input value="{{ $daftarPoli->pasien->nama }}" type="text" name="nama" class="form-control" id="exampleInputEmail1" disabled>
                                    </div>
                                   <div class="form-group">
                                      <label for="exampleInputEmail1">Catatan</label>
                                      <input value="{{ $daftarPoli->periksas->first() ? $daftarPoli->periksas->first()->catatan ?? '' : '' }}" type="text" name="catatan" class="form-control" id="exampleInputEmail1" placeholder="Catatan untuk pasien">
                                      @error('catatan')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="tgl_periksa">Tanggal Periksa</label>
                                      <input value="{{ $daftarPoli->periksas->first() ? (\Carbon\Carbon::parse($daftarPoli->periksas->first()->tgl_periksa)->format('Y-m-d\TH:i') ?? '') : now()->format('Y-m-d\TH:i') }}" type="datetime-local" name="tgl_periksa" class="form-control" id="tgl_periksa" placeholder="Pilih tanggal dan jam periksa">
                                      @error('tgl_periksa')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="id_obat">Obat</label>
                                      <select class="form-control" id="id_obat" name="id_obat[]" multiple style="min-height: 150px;">
                                          @forelse ($obats as $obat)
                                              <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}" {{ in_array($obat->id, $selectedObats) ? 'selected' : '' }}>
                                                  {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp. {{ number_format($obat->harga, 0, ',', '.') }}
                                              </option>
                                          @empty
                                              <option value="" disabled>Tidak ada obat tersedia</option>
                                          @endforelse
                                      </select>
                                      @error('id_obat')
                                          <span class="text-danger">{{ $message }}</span>
                                      @enderror
                                      <small class="text-muted">Tekan CTRL (atau CMD di Mac) untuk memilih lebih dari satu obat.</small>
                                  </div>

                                  <div class="form-group">
                                      <label for="biaya_periksa">Total Harga</label>
                                      <input type="text" class="form-control" id="biaya_periksa" value="{{ number_format($biayaPeriksa, 0, ',', '.') }}" disabled>
                                      <input type="hidden" name="biaya_periksa" id="biaya_periksa_hidden" value="{{ $biayaPeriksa }}">
                                  </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update periksa</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <script>
        // Fungsi untuk mengformat angka ke format Rupiah
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Ambil elemen dengan pengecekan
        const selectObat = document.getElementById('id_obat');
        const biayaPeriksaInput = document.getElementById('biaya_periksa');
        const biayaPeriksaHidden = document.getElementById('biaya_periksa_hidden');
        const basePrice = 150000; // Harga awal 150k

        if (selectObat && biayaPeriksaInput && biayaPeriksaHidden) {
            // Fungsi untuk menghitung total harga berdasarkan obat yang dipilih
            function updateTotalHarga() {
                let totalHargaObat = 0;
                const selectedOptions = Array.from(selectObat.selectedOptions);

                // Hitung total harga dari semua obat yang dipilih
                selectedOptions.forEach(option => {
                    totalHargaObat += parseFloat(option.getAttribute('data-harga')) || 0;
                });

                // Tambahkan harga dasar
                const totalHarga = basePrice + totalHargaObat;

                // Update input yang terlihat (format Rupiah) dan input hidden
                biayaPeriksaInput.value = 'Rp. ' + formatRupiah(totalHarga);
                biayaPeriksaHidden.value = totalHarga;
                console.log('Selected Obat Count:', selectedOptions.length, 'Total Harga:', totalHarga);
            }

            // Panggil fungsi saat halaman dimuat untuk menginisialisasi total harga
            document.addEventListener('DOMContentLoaded', function() {
                updateTotalHarga(); // Inisialisasi berdasarkan opsi yang sudah dipilih
            });

            // Tambahkan event listener untuk mendeteksi perubahan pada dropdown
            selectObat.addEventListener('change', updateTotalHarga);
        } else {
            console.error('Elemen yang diperlukan tidak ditemukan:', { selectObat, biayaPeriksaInput, biayaPeriksaHidden });
        }
    </script>
@endsection

