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
            
           <!-- Form Tambah Pasien -->
<div class="card">
  <div class="card-header bg-primary text-white">
    <h3 class="card-title">Form Tambah Pasien</h3>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.pasienStore') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="no_ktp">No KTP</label>
        <input type="text" name="no_ktp" id="no_ktp" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="no_hp">No HP</label>
        <input type="text" name="no_hp" id="no_hp" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="no_rm">No RM</label>
        <input type="text" name="no_rm" id="no_rm" class="form-control" value="{{ $no_rm }}">
      </div>
      <button class="btn btn-primary">Tambah Pasien</button>
    </form>
  </div>
</div>


          
            
        <!-- Tabel List Pasien -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">List Pasien</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>Alamat</th>
          <th>No KTP</th>
          <th>No HP</th>
          <th>No RM</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pasiens as $pasien)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $pasien->nama }}</td>
          <td>{{ $pasien->alamat }}</td>
          <td>{{ $pasien->no_ktp }}</td>
          <td>{{ $pasien->no_hp }}</td>
          <td>{{ $pasien->no_rm }}</td>
          <td>
            <a href="{{ route('admin.pasienEdit', $pasien->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.pasienDelete', $pasien->id) }}" method="POST" style="display:inline;">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm">Hapus</button>
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