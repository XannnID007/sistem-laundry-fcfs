@extends('layouts.app')

@section('title', 'Kelola Hotel')

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
            <h4 class="page-title text-primary fw-bold">Data Hotel</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Management</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Kelola Hotel</a></li>
            </ul>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" style="border-radius: 10px;">
                <b><i class="fas fa-check-circle mr-2"></i>Sukses!</b> {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title mb-0">Daftar Cabang Hotel RedDoorz</h4>
                            <a href="{{ route('manajer.hotels.create') }}"
                                class="btn btn-primary btn-round ml-auto shadow-sm">
                                <i class="fa fa-plus mr-1"></i> Tambah Hotel
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-head-bg-primary mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" width="5%">No</th>
                                        <th scope="col" width="30%">Nama Hotel</th>
                                        <th scope="col">Alamat Lengkap</th>
                                        <th scope="col" class="text-center" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($hotels as $index => $hotel)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $hotel->nama_hotel }}</td>
                                            <td class="text-muted"><i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                                {{ $hotel->alamat }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('manajer.hotels.edit', $hotel->hotel_id) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Data"
                                                        class="btn btn-warning btn-sm btn-round mr-2 shadow-sm text-white"
                                                        style="min-width: 80px;">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('manajer.hotels.destroy', $hotel->hotel_id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data hotel ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" data-toggle="tooltip" data-placement="top"
                                                            title="Hapus Data"
                                                            class="btn btn-danger btn-sm btn-round shadow-sm"
                                                            style="min-width: 80px;">
                                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="fas fa-building fa-3x mb-3 opacity-50"></i><br>
                                                Belum ada data hotel.
                                            </td>
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
@endsection
