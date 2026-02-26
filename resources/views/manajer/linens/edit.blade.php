@extends('layouts.app')

@section('title', 'Edit Jenis Linen')

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
    <li class="nav-item">
        <a href="{{ route('manajer.hotels.index') }}">
            <i class="fas fa-building"></i>
            <p>Kelola Hotel</p>
        </a>
    </li>
    <li class="nav-item active">
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
            <h4 class="page-title text-primary fw-bold">Edit Jenis Linen</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}"><i class="flaticon-home"></i></a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('manajer.linens.index') }}">Kelola Jenis Linen</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Edit Linen</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Update Jenis Linen</div>
                    </div>
                    <form action="{{ route('manajer.linens.update', $linen->linen_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group @error('nama_linen') has-error @enderror">
                                <label for="nama_linen">Nama Linen <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_linen" name="nama_linen"
                                    value="{{ old('nama_linen', $linen->nama_linen) }}" required>
                                @error('nama_linen')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('satuan') has-error @enderror">
                                <label for="satuan">Satuan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="satuan" name="satuan"
                                    value="{{ old('satuan', $linen->satuan) }}" required>
                                @error('satuan')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-action text-right">
                            <a href="{{ route('manajer.linens.index') }}" class="btn btn-danger btn-round mr-2">Batal</a>
                            <button type="submit" class="btn btn-primary btn-round">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
