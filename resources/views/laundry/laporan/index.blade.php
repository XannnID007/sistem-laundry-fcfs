@extends('layouts.app')

@section('title', 'Laporan Operasional Laundry')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Laporan Operasional</h4>
            <ul class="breadcrumbs">
                <li class="nav-home"><a href="{{ route('laundry.dashboard') }}"><i class="flaticon-home"></i></a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Laporan</a></li>
            </ul>
        </div>

        @if (session('error'))
            <div class="alert alert-danger shadow-sm" style="border-radius: 10px;">
                <b><i class="fas fa-exclamation-triangle mr-2"></i>Oops!</b> {{ session('error') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card card-status-gradient shadow-sm mb-0">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stamp stamp-md bg-white text-primary mr-4 shadow-sm"
                                style="border-radius: 12px; width:56px; height:56px; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-file-alt fa-2x"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 text-white fw-bold">Generate Laporan Operasional</h4>
                                <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                                    Pilih periode dan filter status untuk menghasilkan laporan transaksi dari semua hotel
                                    mitra.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Form Filter --}}
            <div class="col-md-7">
                <div class="card shadow-sm border-0" style="border-radius: 15px;">
                    <div class="card-header bg-white border-bottom-0 pt-4">
                        <h4 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-sliders-h text-primary mr-2"></i> Filter Laporan
                        </h4>
                        <p class="text-muted small mt-1 mb-0">Atur filter sesuai kebutuhan laporan operasional laundry.</p>
                    </div>
                    <form action="{{ route('laundry.laporan.generate') }}" method="POST">
                        @csrf
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group @error('start_date') has-error @enderror">
                                        <label class="font-weight-bold text-dark">
                                            Tanggal Mulai <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0">
                                                    <i class="fas fa-calendar-alt text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control border-left-0" name="start_date"
                                                value="{{ old('start_date') }}" required>
                                        </div>
                                        @error('start_date')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group @error('end_date') has-error @enderror">
                                        <label class="font-weight-bold text-dark">
                                            Tanggal Akhir <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0">
                                                    <i class="fas fa-calendar-alt text-primary"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control border-left-0" name="end_date"
                                                value="{{ old('end_date') }}" required>
                                        </div>
                                        @error('end_date')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold text-dark">
                                    <i class="fas fa-filter text-primary mr-1"></i> Filter Status
                                    <small class="text-muted font-weight-normal">(opsional)</small>
                                </label>
                                <select name="status" class="form-control">
                                    <option value="all">Semua Status</option>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Dijemput" {{ old('status') == 'Dijemput' ? 'selected' : '' }}>Dijemput
                                        (Pick Up)</option>
                                    <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Proses Cuci
                                    </option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="Diantar" {{ old('status') == 'Diantar' ? 'selected' : '' }}>Diantar
                                    </option>
                                </select>
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

            {{-- Panel Statistik --}}
            <div class="col-md-5">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 15px;">
                    <div class="card-header bg-white border-bottom pt-4">
                        <h4 class="card-title fw-bold text-dark mb-0">
                            <i class="fas fa-chart-pie text-primary mr-2"></i> Statistik Keseluruhan
                        </h4>
                    </div>
                    <div class="card-body">
                        @php
                            use App\Models\Transaction;
                            $statPending = Transaction::where('status', 'Pending')->count();
                            $statDijemput = Transaction::where('status', 'Dijemput')->count();
                            $statProses = Transaction::where('status', 'Proses')->count();
                            $statSelesai = Transaction::where('status', 'Selesai')->count();
                            $statDiantar = Transaction::where('status', 'Diantar')->count();
                            $statTotal = Transaction::count();
                        @endphp
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-circle text-warning mr-2"></i> Pending</span>
                            <span class="badge badge-warning text-white px-3"
                                style="border-radius:20px; font-size:0.85rem;">{{ $statPending }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-circle text-info mr-2"></i> Dijemput</span>
                            <span class="badge badge-info px-3"
                                style="border-radius:20px; font-size:0.85rem;">{{ $statDijemput }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-circle text-primary mr-2"></i> Proses Cuci</span>
                            <span class="badge badge-primary px-3"
                                style="border-radius:20px; font-size:0.85rem;">{{ $statProses }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-circle text-success mr-2"></i> Selesai</span>
                            <span class="badge badge-success px-3"
                                style="border-radius:20px; font-size:0.85rem;">{{ $statSelesai }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted"><i class="fas fa-circle text-dark mr-2"></i> Diantar</span>
                            <span class="badge badge-dark px-3"
                                style="border-radius:20px; font-size:0.85rem;">{{ $statDiantar }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3 mt-1 bg-light rounded px-3">
                            <span class="text-dark font-weight-bold">Total Seluruh Transaksi</span>
                            <span class="font-weight-bold text-primary"
                                style="font-size: 1.2rem;">{{ $statTotal }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
