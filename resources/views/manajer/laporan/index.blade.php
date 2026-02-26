@extends('layouts.app')

@section('title', 'Cetak Laporan')

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
    <li class="nav-item">
        <a href="{{ route('manajer.linens.index') }}">
            <i class="fas fa-tshirt"></i>
            <p>Kelola Jenis Linen</p>
        </a>
    </li>
    <li class="nav-item active">
        <a href="{{ route('manajer.laporan.index') }}">
            <i class="fas fa-file-alt"></i>
            <p>Laporan</p>
        </a>
    </li>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Laporan Transaksi Laundry</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}"><i class="flaticon-home"></i></a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Laporan</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Generate Laporan</a></li>
            </ul>
        </div>

        @if (session('error'))
            <div class="alert alert-danger shadow-sm" style="border-radius: 10px;">
                <b><i class="fas fa-exclamation-triangle mr-2"></i>Oops!</b> {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Filter Periode Laporan</div>
                    </div>
                    <form action="{{ route('manajer.laporan.generate') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group @error('start_date') has-error @enderror">
                                <label for="start_date">Tanggal Mulai <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control border-left-0" id="start_date"
                                        name="start_date" value="{{ old('start_date') }}" required>
                                </div>
                                @error('start_date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group @error('end_date') has-error @enderror">
                                <label for="end_date">Tanggal Akhir <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0">
                                            <i class="fas fa-calendar-alt text-primary"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control border-left-0" id="end_date" name="end_date"
                                        value="{{ old('end_date') }}" required>
                                </div>
                                @error('end_date')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-action text-right">
                            <button type="submit" class="btn btn-primary btn-round shadow-sm py-2 px-4">
                                <i class="fas fa-print mr-2"></i> Generate Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-status-gradient shadow-sm h-100">
                    <div class="card-body p-4">
                        <h4 class="mb-4 fw-bold text-white border-bottom border-white pb-3" style="border-opacity: 0.3;">
                            <i class="fas fa-info-circle mr-2"></i> Informasi Laporan
                        </h4>

                        <ul class="list-unstyled text-white mt-4" style="font-size: 1rem; line-height: 1.8;">
                            <li class="mb-4 d-flex align-items-start">
                                <i class="fas fa-check-circle mt-1 mr-3 text-white-50" style="font-size: 1.2rem;"></i>
                                <span>Laporan akan menampilkan seluruh transaksi laundry dalam rentang waktu periode yang
                                    Anda pilih.</span>
                            </li>
                            <li class="mb-4 d-flex align-items-start">
                                <i class="fas fa-check-circle mt-1 mr-3 text-white-50" style="font-size: 1.2rem;"></i>
                                <span>Data akan diurutkan secara otomatis berdasarkan waktu transaksi masuk <strong>(Sistem
                                        FCFS)</strong>.</span>
                            </li>
                            <li class="mb-4 d-flex align-items-start">
                                <i class="fas fa-check-circle mt-1 mr-3 text-white-50" style="font-size: 1.2rem;"></i>
                                <span>Setelah di-generate, laporan dapat langsung dicetak (Print) atau diekspor ke format
                                    <strong>PDF</strong>.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
