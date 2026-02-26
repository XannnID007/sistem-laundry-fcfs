@extends('layouts.app')

@section('title', 'Dashboard Hotel')

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div class="mb-3 mb-md-0">
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Dashboard Layanan</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-building mr-2"></i> Selamat datang kembali,
                        <strong>{{ Auth::user()->hotel->nama_hotel ?? 'Mitra RedDoorz' }}</strong>
                    </h5>
                    <p class="text-white-50 small mb-0">Pantau status cucian linen Anda secara real-time di sini.</p>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('hotel.transactions.create') }}"
                        class="btn btn-white btn-border btn-round shadow-sm fw-bold">
                        <i class="fas fa-plus-circle mr-2"></i> Kirim Cucian Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">

        <div class="row mt-2">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-uppercase fw-bold text-muted small">Total Order</p>
                                    <h4 class="card-title text-dark">{{ $totalTransactions ?? 0 }}</h4>
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
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-uppercase fw-bold text-muted small">Menunggu</p>
                                    <h4 class="card-title text-dark">{{ $pendingTransactions ?? 0 }}</h4>
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
                                <div class="icon-big text-center bg-primary text-white bubble-shadow-small">
                                    <i class="fas fa-sync-alt fa-spin"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category text-uppercase fw-bold text-muted small">Diproses</p>
                                    <h4 class="card-title text-dark">{{ $prosesTransactions ?? 0 }}</h4>
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
                                    <p class="card-category text-uppercase fw-bold text-muted small">Selesai</p>
                                    <h4 class="card-title text-dark">{{ $selesaiTransactions ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
