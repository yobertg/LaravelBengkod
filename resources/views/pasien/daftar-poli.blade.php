@extends('layout')

@section('sidebar')
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('pasien.dashboard') }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <span class="badge badge-warning right">pasien</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pasien.daftar-poli') }}" class="nav-link ">
                    <p>
                        Poli
                        <span class="badge badge-warning right">pasien</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <form action={{route('auth.logout.post')}} method="post">
                    @csrf
                 <i class="nav-icon far fa-calendar-alt"></i>
                 <button type="submit" class="nav-link ">
                 <p>
                   Logout
                 </p>
                </button>
                </form>
                  
                 
               </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Daftar Poli</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="daftar-tab" data-toggle="pill" href="#daftar" role="tab" aria-controls="daftar" aria-selected="true">Daftar Poli</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="riwayat-tab" data-toggle="pill" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat Daftar Poli</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- Daftar Poli Tab -->
                                <div class="tab-pane fade show active" id="daftar" role="tabpanel" aria-labelledby="daftar-tab">
                                    <form action="{{ route('pasien.daftar-poli.store') }}" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="no_rm">Nomor Rekam Medis</label>
                                                <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{ auth()->user()->no_rm ?? '' }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_poli">Pilih Poli</label>
                                                <select class="custom-select rounded-0" id="id_poli" name="id_poli" required onchange="fetchSchedules()">
                                                    <option value="" disabled selected>Open this select menu</option>
                                                    @foreach ($polis as $poli)
                                                        <option value="{{ $poli->id }}" {{ old('id_poli') == $poli->id ? 'selected' : '' }}>
                                                            {{ $poli->nama_poli }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_jadwal">Pilih Jadwal</label>
                                                <select class="custom-select rounded-0" id="id_jadwal" name="id_jadwal" required>
                                                    <option value="" disabled selected>Open this select menu</option>
                                                    @foreach ($jadwals as $jadwal)
                                                        <option value="{{ $jadwal->id }}" {{ old('id_jadwal') == $jadwal->id ? 'selected' : '' }}>
                                                            {{ $jadwal->hari }} - {{ $jadwal->jam_mulai }} s/d {{ $jadwal->jam_selesai }} (Dr. {{ $jadwal->dokter->nama ?? 'N/A' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="keluhan">Keluhan</label>
                                                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required>{{ old('keluhan') }}</textarea>
                                                @error('keluhan')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Daftar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- Riwayat Daftar Poli Tab -->
                                <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Riwayat daftar poli</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Poli</th>
                                                        <th>Dokter</th>
                                                        <th>Hari</th>
                                                        <th>Mulai</th>
                                                        <th>Selesai</th>
                                                        <th>Antrian</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($riwayats as $riwayat)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $riwayat->jadwalPeriksa->dokter->poli->nama_poli ?? 'N/A' }}</td>
                                                            <td>{{ $riwayat->jadwalPeriksa->dokter->nama ?? 'N/A' }}</td>
                                                            <td>{{ $riwayat->jadwalPeriksa->hari ?? 'N/A' }}</td>
                                                            <td>{{ $riwayat->jadwalPeriksa->jam_mulai ?? 'N/A' }}</td>
                                                            <td>{{ $riwayat->jadwalPeriksa->jam_selesai ?? 'N/A' }}</td>
                                                            <td>{{ $riwayat->no_antrian ?? 'N/A' }}</td>
                                                            <td>{{ $riwayat->periksas->isNotEmpty() && $riwayat->periksas->first()->catatan ? 'Sudah diperiksa' : 'Belum diperiksa' }}</td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#detailModal{{ $riwayat->id }}">
                                                                    Detail
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="detailModal{{ $riwayat->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $riwayat->id }}" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header" style="background-color: #007bff; color: white;">
                                                                                <h5 class="modal-title" id="detailModalLabel{{ $riwayat->id }}">Detail Poli</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="form-group">
                                                                                    <label>Nama Poli</label>
                                                                                    <p>{{ $riwayat->jadwalPeriksa->dokter->poli->nama_poli ?? 'N/A' }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Nama Dokter</label>
                                                                                    <p>{{ $riwayat->jadwalPeriksa->dokter->nama ?? 'N/A' }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Hari</label>
                                                                                    <p>{{ $riwayat->jadwalPeriksa->hari ?? 'N/A' }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Mulai</label>
                                                                                    <p>{{ $riwayat->jadwalPeriksa->jam_mulai ?? 'N/A' }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Selesai</label>
                                                                                    <p>{{ $riwayat->jadwalPeriksa->jam_selesai ?? 'N/A' }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label>Nomor Antrian</label>
                                                                                    <p>{{ $riwayat->no_antrian ?? 'N/A' }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">Tidak ada data</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script>
        function fetchSchedules() {
            let poliId = document.getElementById('id_poli').value;
            fetch(`/pasien/daftar-poli/show-poli?id_poli=${poliId}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                let jadwalSelect = document.getElementById('id_jadwal');
                jadwalSelect.innerHTML = '<option value="" disabled selected>Open this select menu</option>';
                data.jadwals.forEach(jadwal => {
                    let option = new Option(`${jadwal.hari} - ${jadwal.jam_mulai} s/d ${jadwal.jam_selesai} (Dr. ${jadwal.dokter.nama ?? 'N/A'})`, jadwal.id);
                    jadwalSelect.add(option);
                });
            })
            .catch(error => console.error('Error fetching schedules:', error));
        }
    </script>
@endsection

<!-- bs-custom-file-input -->
<script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>