@extends('layouts.app')

@section('title', 'Dashboard Manajer')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h4 class="page-title text-primary fw-bold">Dashboard Overview</h4>
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ route('manajer.dashboard') }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator"><i class="flaticon-right-arrow"></i></li>
                    <li class="nav-item"><a href="#">Dashboard</a></li>
                </ul>
            </div>

            @if (session('success'))
                <div class="alert alert-success shadow-sm" style="border-radius: 10px;">
                    <b><i class="fas fa-check-circle mr-2"></i>Sukses!</b> {{ session('success') }}
                </div>
            @endif

            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card card-status-gradient">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-white text-primary fw-bold px-3 py-2 mr-2">
                                            <i class="fas fa-server mr-1"></i> SYSTEM V2.0
                                        </span>
                                        <span class="text-white small text-uppercase fw-bold">
                                            <span class="live-indicator"></span> ONLINE
                                        </span>
                                    </div>
                                    <h2 class="text-white fw-bold mb-1">Algoritma FCFS Aktif</h2>
                                    <p class="text-white-50 mb-4" style="font-size: 0.95rem;">
                                        Sistem sedang memproses antrean berdasarkan urutan kedatangan (First Come First
                                        Served).
                                    </p>
                                    <button class="btn btn-light btn-round text-primary fw-bold btn-sm shadow-sm"
                                        onclick="location.reload()">
                                        <i class="fas fa-sync-alt mr-1"></i> Refresh Realtime
                                    </button>
                                </div>

                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="stat-glass-box">
                                                <h2 class="fw-bold mb-0 text-white">{{ $totalTransactions ?? 0 }}</h2>
                                                <small class="text-white-50 text-uppercase fw-bold">Diproses</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-glass-box">
                                                <h2 class="fw-bold mb-0 text-white">{{ $totalHotels ?? 0 }}</h2>
                                                <small class="text-white-50 text-uppercase fw-bold">Hotel Aktif</small>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="stat-glass-box">
                                                <h2 class="fw-bold mb-0 text-white">0</h2>
                                                <small class="text-white-50 text-uppercase fw-bold">Pending</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-hotel"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Hotel</p>
                                        <h4 class="card-title">{{ $totalHotels ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total User</p>
                                        <h4 class="card-title">{{ $totalUsers ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-tshirt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Jenis Linen</p>
                                        <h4 class="card-title">{{ $totalLinens ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Transaksi</p>
                                        <h4 class="card-title">{{ $totalTransactions ?? 0 }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Aksi Cepat</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-sm-3 text-center mb-3">
                                    <a href="{{ route('manajer.users.index') }}"
                                        class="btn btn-light btn-block py-3 text-primary border"
                                        style="border-radius: 15px;">
                                        <i class="fas fa-user-plus fa-2x mb-2"></i><br>User
                                    </a>
                                </div>
                                <div class="col-6 col-sm-3 text-center mb-3">
                                    <a href="{{ route('manajer.hotels.index') }}"
                                        class="btn btn-light btn-block py-3 text-primary border"
                                        style="border-radius: 15px;">
                                        <i class="fas fa-hotel fa-2x mb-2"></i><br>Hotel
                                    </a>
                                </div>
                                <div class="col-6 col-sm-3 text-center mb-3">
                                    <a href="{{ route('manajer.linens.index') }}"
                                        class="btn btn-light btn-block py-3 text-primary border"
                                        style="border-radius: 15px;">
                                        <i class="fas fa-tshirt fa-2x mb-2"></i><br>Linen
                                    </a>
                                </div>
                                <div class="col-6 col-sm-3 text-center mb-3">
                                    <a href="{{ route('manajer.laporan.index') }}"
                                        class="btn btn-light btn-block py-3 text-primary border"
                                        style="border-radius: 15px;">
                                        <i class="fas fa-print fa-2x mb-2"></i><br>Cetak
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">System Health</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted">Database</span>
                                <span class="badge badge-success">Connected</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted">Server Load</span>
                                <span class="text-primary fw-bold">12%</span>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-muted">Versi</span>
                                <span class="text-muted">v2.1 Stable</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
