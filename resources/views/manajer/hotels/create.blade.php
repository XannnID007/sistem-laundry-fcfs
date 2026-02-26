@extends('layouts.app')

@section('title', 'Tambah Hotel')

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('manajer.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manajer.users.index') }}">
            <i class="fas fa-users"></i>
            <p>Kelola User</p>
        </a>
    </li>
    <li class="nav-item active">
        <a href="{{ route('manajer.hotels.index') }}">
            <i class="fas fa-building"></i>
            <p>Kelola Hotel</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manajer.linens.index') }}">
            <i class="fas fa-tshirt"></i>
            <p>Kelola Jenis Linen</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('manajer.laporan.index') }}">
            <i class="fas fa-file-alt"></i>
            <p>Laporan</p>
        </a>
    </li>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Tambah Hotel Baru</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}"><i class="flaticon-home"></i></a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('manajer.hotels.index') }}">Kelola Hotel</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Tambah Hotel</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Data Hotel</div>
                    </div>
                    <form action="{{ route('manajer.hotels.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group @error('nama_hotel') has-error @enderror">
                                <label for="nama_hotel">Nama Hotel <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_hotel" name="nama_hotel"
                                    placeholder="Contoh: RedDoorz @ Dago" value="{{ old('nama_hotel') }}" required>
                                @error('nama_hotel')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('alamat') has-error @enderror">
                                <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="4"
                                    placeholder="Masukkan alamat lengkap hotel..." required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-action text-right">
                            <a href="{{ route('manajer.hotels.index') }}" class="btn btn-danger btn-round mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-round">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
