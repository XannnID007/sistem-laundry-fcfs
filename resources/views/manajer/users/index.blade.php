@extends('layouts.app')

@section('title', 'Kelola User')

@section('sidebar')
    <li class="nav-item">
        <a href="{{ route('manajer.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item active">
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
            <h4 class="page-title text-primary fw-bold">Data Pengguna</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Management</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Kelola User</a></li>
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
                            <h4 class="card-title mb-0">Daftar Pengguna Sistem</h4>
                            <a href="{{ route('manajer.users.create') }}"
                                class="btn btn-primary btn-round ml-auto shadow-sm">
                                <i class="fa fa-plus mr-1"></i> Tambah User
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-head-bg-primary mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center" width="5%">No</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Hotel</th>
                                        <th scope="col" class="text-center" style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $index => $user)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="fw-bold">{{ $user->username }}</td>
                                            <td>
                                                @if ($user->role == 'Manajer')
                                                    <span class="badge badge-primary px-3 py-1">Manajer</span>
                                                @elseif($user->role == 'Hotel')
                                                    <span class="badge badge-info px-3 py-1">Hotel</span>
                                                @else
                                                    <span class="badge badge-success px-3 py-1">Laundry</span>
                                                @endif
                                            </td>
                                            <td>{{ $user->hotel ? $user->hotel->nama_hotel : '-' }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="{{ route('manajer.users.edit', $user->user_id) }}"
                                                        data-toggle="tooltip" data-placement="top" title="Edit Data"
                                                        class="btn btn-warning btn-sm btn-round mr-2 shadow-sm text-white"
                                                        style="min-width: 80px;">
                                                        <i class="fas fa-edit mr-1"></i> Edit
                                                    </a>

                                                    <form action="{{ route('manajer.users.destroy', $user->user_id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Data tidak dapat dikembalikan.')">
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
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="fas fa-folder-open fa-3x mb-3 opacity-50"></i><br>
                                                Belum ada data user.
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
