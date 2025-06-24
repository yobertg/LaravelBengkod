@extends('layout')

@section('sidebar')
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
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dokter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Periksa</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Antrian</th>
                                        <th>Nama Pasien</th>
                                        <th>Keluhan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($polis as $poli)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $poli->no_antrian ?? 'N/A' }}</td>
                                            <td>{{ $poli->pasien->nama ?? 'N/A' }}</td>
                                            <td>{{ $poli->keluhan ?? 'N/A' }}</td>
                                            <td>
                                                @if ($poli->periksas->isEmpty() || !$poli->periksas->first()->catatan) <!-- Jika belum ada pemeriksaan atau catatan kosong -->
                                                    <a href="{{ route('dokter.periksaEdit', $poli->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-stethoscope"></i> Periksa
                                                    </a>
                                                @else
                                                    <a href="{{ route('dokter.periksaEdit', $poli->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection