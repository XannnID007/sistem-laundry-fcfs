@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Rincian Transaksi</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('laundry.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('laundry.transactions.index') }}">Semua Transaksi</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Detail #{{ $transaction->transaction_id }}</a></li>
            </ul>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" style="border-radius: 10px;">
                <b><i class="fas fa-check-circle mr-2"></i>Sukses!</b> {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title fw-bold mb-0">Informasi Order #{{ $transaction->transaction_id }}</h4>
                        <a href="{{ url()->previous() }}"
                            class="btn btn-light btn-round btn-sm border shadow-sm text-primary">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4 bg-light p-3 rounded border">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-muted mb-1 small text-uppercase fw-bold"><i
                                        class="fas fa-hotel text-primary mr-1"></i> Asal Hotel</label>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $transaction->user->hotel->nama_hotel }}</h5>
                                <p class="mb-0 text-muted mt-1 small"><i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                    {{ $transaction->user->hotel->alamat }}</p>
                            </div>
                            <div class="col-md-6 border-left-md">
                                <label class="text-muted mb-1 small text-uppercase fw-bold"><i
                                        class="fas fa-clock text-primary mr-1"></i> Waktu Input (Sistem FCFS)</label>
                                <h5 class="font-weight-bold text-dark mb-0">
                                    {{ $transaction->tgl_transaksi->format('d F Y') }}
                                </h5>
                                <span class="badge badge-primary mt-1">{{ $transaction->tgl_transaksi->format('H:i') }}
                                    WIB</span>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 text-primary border-bottom pb-2"><i class="fas fa-list mr-2"></i>Rincian
                            Item Cucian</h5>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th style="width: 5%" class="text-center text-white">No</th>
                                        <th class="text-white">Jenis Linen</th>
                                        <th style="width: 20%" class="text-center text-white">Qty</th>
                                        <th style="width: 20%" class="text-center text-white">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->details as $index => $detail)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="font-weight-bold">{{ $detail->linen->nama_linen }}</td>
                                            <td class="text-center font-weight-bold" style="font-size: 1.1em;">
                                                {{ $detail->qty }}</td>
                                            <td class="text-center text-muted">{{ $detail->linen->satuan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="2" class="text-right font-weight-bold">Total Keseluruhan Item:</td>
                                        <td class="text-center font-weight-bold text-primary" style="font-size: 1.3em;">
                                            {{ $transaction->total_qty }}
                                        </td>
                                        <td class="text-center text-muted">Item</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        .border-left-md {
            border-left: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .border-left-md {
                border-left: none;
                padding-top: 15px;
                border-top: 1px dashed #dee2e6;
                mt-3;
            }
        }
    </style>
@endsection
