@extends('layouts.app')

@section('title', 'Dashboard Laundry')

@section('sidebar')
    <li class="nav-item active">
        <a href="{{ route('laundry.dashboard') }}">
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Operasional</h4>
    </li>

    <li class="nav-item">
        <a href="{{ route('laundry.queue.index') }}">
            <i class="fas fa-clipboard-list"></i>
            <p>Antrean Cucian <span class="badge badge-warning">{{ $pendingTransactions ?? 0 }}</span></p>
        </a>
    </li>

    <li class="nav-item">
        <a href="{{ route('laundry.transactions.index') }}">
            <i class="fas fa-history"></i>
            <p>Riwayat Transaksi</p>
        </a>
    </li>
@endsection

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Dashboard Operasional</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('laundry.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Dashboard Laundry</a></li>
            </ul>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card card-status-gradient shadow-sm mb-0">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-7 mb-3 mb-md-0">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge badge-white text-primary fw-bold px-3 py-2 mr-2">
                                        <i class="fas fa-microchip mr-1"></i> FCFS SYSTEM
                                    </span>
                                    <span class="text-white small text-uppercase fw-bold">
                                        <span class="live-indicator"></span> STANDBY
                                    </span>
                                </div>
                                <h2 class="text-white fw-bold mb-1">Pusat Antrean Cucian</h2>
                                <p class="text-white-50 mb-4" style="font-size: 0.95rem;">
                                    Harap proses cucian (linen) berdasarkan urutan antrean. Transaksi yang masuk lebih dulu
                                    berada di urutan paling atas.
                                </p>
                                <a href="{{ route('laundry.queue.index') }}"
                                    class="btn btn-light btn-round text-primary fw-bold shadow-sm">
                                    <i class="fas fa-play mr-1"></i> Mulai Proses Antrean
                                </a>
                            </div>

                            <div class="col-md-5 text-right d-none d-md-block">
                                <i class="fas fa-washing-machine fa-5x text-white opacity-50 mr-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Total Order</p>
                                    <h4 class="card-title">{{ $totalTransactions ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bg-danger text-white bubble-shadow-small">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Menunggu</p>
                                    <h4 class="card-title">{{ $pendingTransactions ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bg-warning text-white bubble-shadow-small">
                                    <i class="fas fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Diproses</p>
                                    <h4 class="card-title">{{ $prosesTransactions ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bg-success text-white bubble-shadow-small">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Selesai</p>
                                    <h4 class="card-title">{{ $selesaiTransactions ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
