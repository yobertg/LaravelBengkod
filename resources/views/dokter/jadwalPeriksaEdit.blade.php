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
        <form action={{route('auth.logout.post')}} method="post">
            @csrf
        
        <button type="submit" class="nav-link ">
        <p>
          Logout
        </p>
        </button>
        </form>
     </li>

@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
    {{ session('error') }}
</div>
@endif

   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Jadwal Periksa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">
            
            <!-- Tambah Jadwal Periksa -->
           
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Edit Jadwal Periksa</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('dokter.jadwalperiksaUpdate', $jadwal->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="hari">Hari</label>
                            <input type="text" class="form-control" value="{{ $jadwal->hari }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <input type="time" class="form-control" value="{{ $jadwal->jam_mulai }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <input type="time" class="form-control" value="{{ $jadwal->jam_selesai }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Status</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="aktif" 
                                    {{ $jadwal->status == 'aktif' ? 'checked' : '' }}>
                                <label class="form-check-label">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" value="nonaktif"
                                    {{ $jadwal->status == 'nonaktif' ? 'checked' : '' }}>
                                <label class="form-check-label">Tidak Aktif</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>




          
            
           
          </div>
        </div>
      </div>
    </section>
    
@endsection