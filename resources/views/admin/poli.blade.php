@extends('layout')
@section('sidebar')

    <li class="nav-item menu-open">
      <a href="/admin" class="nav-link {{ Request::is('/admin') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dashboard
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="/admin/poli" class="nav-link {{ Request::is('admin/poli*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Poli
          <span class="right badge badge-danger">New</span>
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="/admin/obat" class="nav-link {{ Request::is('admin/obat*') ? 'active' : '' }}">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
          Obat
          
        </p>
      </a>
    </li>
      <li class="nav-item">
      <a href="/admin/pasien" class="nav-link {{ Request::is('admin/pasien*') ? 'active' : '' }}">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
          Pasien
          
        </p>
      </a>
    </li>
      <li class="nav-item">
      <a href="/admin/dokter" class="nav-link {{ Request::is('admin/dokter*') ? 'active' : '' }}">
        <i class="nav-icon far fa-calendar-alt"></i>
        <p>
          Dokter
          
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
            <h1>Dokter</h1>
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
            
 <!-- Form Tambah Poli -->
<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Form Tambah Poli</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.poliStore') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="nama_poli">Nama Poli</label>
        <input type="text" name="nama_poli" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" class="form-control" required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Tambah Poli</button>
    </form>
  </div>
</div>


          
            
<!-- Tabel List Poli -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">List Poli</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Poli</th>
          <th>Keterangan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($polis as $poli)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $poli->nama_poli }}</td>
          <td>{{ $poli->keterangan }}</td>
          <td>
            <a href="{{ route('admin.poliEdit', $poli->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.poliDelete', $poli->id) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

          </div>
        </div>
      </div>
    </section>
    
@endsection