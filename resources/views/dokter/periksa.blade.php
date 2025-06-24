@extends('layout')

@section('sidebar')
    <!-- Sidebar content (unchanged) -->
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
            <button type="submit" class="nav-link">
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
                            <form method="POST" action="{{ route('dokter.periksaStore') }}">
                                @csrf
                                <input type="hidden" name="id_poli" value="{{ $id_poli }}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="nama_pasien">Nama Pasien</label>
                                        <input type="text" name="nama" class="form-control" id="nama_pasien" placeholder="Masukkan nama pasien" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Jadwal Periksa</label>
                                        <select class="form-control" name="id_jadwal" required>
                                            <option value="">Pilih Jadwal...</option>
                                            @foreach ($jadwalPeriksas as $jadwal)
                                                <option value="{{ $jadwal->id }}">{{ $jadwal->hari }} - {{ $jadwal->jam_mulai }} s/d {{ $jadwal->jam_selesai }} (Dr. {{ $jadwal->dokter->nama ?? 'N/A' }})</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pilih Obat</label>
                                        <div id="selected-obats"></div>
                                        <select class="form-control" id="obat-select" name="obat_select" style="margin-top: 10px;">
                                            <option value="">Pilih Obat...</option>
                                            @foreach ($obats as $obat)
                                                <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-kemasan="{{ $obat->kemasan }}" data-harga="{{ $obat->harga }}">
                                                    {{ $obat->nama_obat }} - {{ $obat->kemasan }} - Rp. {{ number_format($obat->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="add-obat" class="btn btn-primary btn-sm mt-2">Tambah Obat</button>
                                        <input type="hidden" name="id_obat" id="id_obat" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="total_harga">Total Harga</label>
                                        <input value="150000" type="text" name="biaya_periksa" class="form-control" id="total_harga" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <input type="text" name="catatan" class="form-control" id="catatan" placeholder="Catatan untuk pasien">
                                    </div>

                                    <div class="form-group">
                                        <label for="tgl_periksa">Tanggal Periksa</label>
                                        <input type="date" name="tgl_periksa" class="form-control" id="tgl_periksa" required>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.getElementById('add-obat').addEventListener('click', function() {
        const select = document.getElementById('obat-select');
        const selectedValue = select.value;
        if (selectedValue) {
            const option = select.querySelector(`option[value="${selectedValue}"]`);
            const nama = option.getAttribute('data-nama');
            const kemasan = option.getAttribute('data-kemasan');
            const harga = parseInt(option.getAttribute('data-harga'));

            const obatItem = document.createElement('div');
            obatItem.className = 'selected-obat-item';
            obatItem.innerHTML = `
                <span>${nama} - ${kemasan} - Rp. ${harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}</span>
                <button type="button" class="btn btn-danger btn-sm remove-obat" data-obat-id="${selectedValue}">×</button>
            `;

            document.getElementById('selected-obats').appendChild(obatItem);

            // Update hidden input
            const hiddenInput = document.getElementById('id_obat');
            const currentIds = hiddenInput.value.split(',').filter(id => id);
            currentIds.push(selectedValue);
            hiddenInput.value = currentIds.join(',');

            // Reset select
            select.value = '';

            // Update total harga
            updateTotalHarga(harga);
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-obat')) {
            const obatId = e.target.getAttribute('data-obat-id');
            const option = document.querySelector(`#obat-select option[value="${obatId}"]`);
            const harga = parseInt(option.getAttribute('data-harga')) || 0;
            e.target.parentElement.remove();

            // Update hidden input
            const hiddenInput = document.getElementById('id_obat');
            let currentIds = hiddenInput.value.split(',').filter(id => id);
            currentIds = currentIds.filter(id => id !== obatId);
            hiddenInput.value = currentIds.join(',');

            // Update total harga
            updateTotalHarga(-harga);
        }
    });

    function updateTotalHarga(hargaTambahan = 0) {
        let currentTotal = parseInt(document.getElementById('total_harga').value.replace(/\./g, '')) || 150000;
        currentTotal += hargaTambahan;
        document.getElementById('total_harga').value = currentTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Inisialisasi total harga awal
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('total_harga').value = '150000';
    });
</script>
@endpush