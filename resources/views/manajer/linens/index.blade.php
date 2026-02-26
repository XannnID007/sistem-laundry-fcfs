@extends('layouts.app')

@section('title', 'Kelola Jenis Linen')

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
            <h4 class="page-title text-primary fw-bold">Data Jenis Linen</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Management</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Kelola Jenis Linen</a></li>
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
                            <h4 class="card-title mb-0">Data Master Jenis Linen</h4>
                            <a href="{{ route('manajer.linens.create') }}"
                                class="btn btn-primary btn-round ml-auto shadow-sm">
                                <i class="fa fa-plus mr-1"></i> Tambah Jenis Linen
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-head-bg-primary mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" width="5%">No</th>
                                        <th scope="col">Nama Linen</th>
                                        <th scope="col">Satuan</th>
                                        <th scope="col" class="text-center" style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($linens as $index => $linen)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $linen->nama_linen }}</td>
                                            <td><span class="badge badge-light border">{{ $linen->satuan }}</span></td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('manajer.linens.edit', $linen->linen_id) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Data"
                                                        class="btn btn-warning btn-sm btn-round mr-2 shadow-sm text-white"
                                                        style="min-width: 80px;">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('manajer.linens.destroy', $linen->linen_id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis linen ini?')">
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
                                                <i class="fas fa-tshirt fa-3x mb-3 opacity-50"></i><br>
                                                Belum ada data jenis linen.
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
