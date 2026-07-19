@extends('layouts.app')

@section('title', 'Laporan Transaksi Saya')

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Laporan Transaksi Laundry</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-file-chart-line mr-2"></i>
                        {{ Auth::user()->hotel->nama_hotel ?? 'Hotel Anda' }}
                    </h5>
                    <p class="text-white-50 small mb-0">Generate dan cetak laporan riwayat cucian linen berdasarkan periode.
                    </p>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('hotel.dashboard') }}" class="btn btn-white btn-border btn-round shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">

        @if (session('error'))
            <div class="alert alert-danger shadow-sm" style="border-radius: 10px;">
                <b><i class="fas fa-exclamation-triangle mr-2"></i>Oops!</b> {{ session('error') }}
            </div>
        @endif

        <div class="row">
            {{-- Form Filter --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header bg-white border-bottom-0 pt-4">
                        <h4 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-filter text-primary mr-2"></i> Filter Periode Laporan
                        </h4>
                        <p class="text-muted small mt-1 mb-0">Pilih rentang tanggal untuk generate laporan transaksi Anda.
                        </p>
                    </div>
                    <form action="{{ route('hotel.laporan.generate') }}" method="POST">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="form-group @error('start_date') has-error @enderror">
                                <label for="start_date" class="font-weight-bold text-dark">
                                    Tanggal Mulai <span class="text-danger">*</span>
                                </label>
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
                                <label for="end_date" class="font-weight-bold text-dark">
                                    Tanggal Akhir <span class="text-danger">*</span>
                                </label>
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
                        <div class="card-footer bg-white border-top-0 text-right pb-4">
                            <button type="submit" class="btn btn-primary btn-round shadow-sm px-4 py-2 font-weight-bold">
                                <i class="fas fa-chart-bar mr-2"></i> Generate Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Panel --}}
            <div class="col-md-6">
                <div class="card card-status-gradient shadow-sm" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h4 class="mb-3 fw-bold text-white">
                            <i class="fas fa-info-circle mr-2"></i> Informasi Laporan
                        </h4>
                        <ul class="list-unstyled text-white mb-4" style="font-size: 0.95rem; line-height: 1.9;">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle mt-1 mr-3 text-white-50" style="font-size: 1rem;"></i>
                                <span>Laporan menampilkan seluruh transaksi cucian
                                    <strong>{{ Auth::user()->hotel->nama_hotel ?? 'hotel Anda' }}</strong>
                                    dalam periode yang dipilih.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle mt-1 mr-3 text-white-50" style="font-size: 1rem;"></i>
                                <span>Data diurutkan otomatis berdasarkan waktu masuk <strong>(FCFS)</strong>.</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="fas fa-check-circle mt-1 mr-3 text-white-50" style="font-size: 1rem;"></i>
                                <span>Laporan yang di-generate dapat langsung dicetak atau diekspor ke
                                    <strong>PDF</strong>.</span>
                            </li>
                            <li class="d-flex align-items-start">
                                <i class="fas fa-lock mt-1 mr-3 text-white-50" style="font-size: 1rem;"></i>
                                <span>Laporan ini bersifat <strong>privat</strong> — hanya menampilkan data transaksi hotel
                                    Anda sendiri.</span>
                            </li>
                        </ul>

                        <div class="row text-center">
                            <div class="col-6">
                                <div class="stat-glass-box">
                                    <h3 class="fw-bold mb-0 text-white">
                                        {{ \App\Models\Transaction::where('user_id', Auth::id())->count() }}
                                    </h3>
                                    <small class="text-white-50 text-uppercase fw-bold" style="font-size:0.75rem;">Total
                                        Order</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-glass-box">
                                    <h3 class="fw-bold mb-0 text-white">
                                        {{ \App\Models\Transaction::where('user_id', Auth::id())->sum('total_qty') }}
                                    </h3>
                                    <small class="text-white-50 text-uppercase fw-bold" style="font-size:0.75rem;">Total
                                        Item</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
