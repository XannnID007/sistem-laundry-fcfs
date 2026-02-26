@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Lacak Transaksi
                        #{{ $transaction->transaction_id }}</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-search-location mr-2"></i> Rincian lengkap dan status terkini cucian Anda
                    </h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('hotel.transactions.index') }}"
                        class="btn btn-white btn-border btn-round shadow-sm font-weight-bold">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-sm h-100" style="border-radius: 15px;">
                    <div class="card-header pb-0 pt-4 border-0">
                        <h4 class="card-title fw-bold text-primary"><i class="fas fa-clipboard-list mr-2"></i>Rincian
                            Pesanan</h4>
                    </div>
                    <div class="card-body">

                        <div class="row mb-4 bg-light p-3 rounded border mx-1">
                            <div class="col-md-6 border-right-md mb-3 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-md mr-3">
                                        <span class="avatar-title rounded-circle bg-primary text-white shadow-sm">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-bold">Waktu Input</small>
                                        <h5 class="text-dark font-weight-bold mb-0">
                                            {{ $transaction->tgl_transaksi->format('d M Y, H:i') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center ml-md-3">
                                    <div class="avatar avatar-md mr-3">
                                        <span class="avatar-title rounded-circle bg-success text-white shadow-sm">
                                            <i class="fas fa-layer-group"></i>
                                        </span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-bold">Total Muatan</small>
                                        <h5 class="text-dark font-weight-bold mb-0">{{ $transaction->total_qty }} Item</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 mt-4 text-dark border-bottom pb-2">Daftar Linen yang Dicuci</h5>
                        <div class="table-responsive px-1">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th style="width: 10%" class="text-center text-white">No</th>
                                        <th class="text-white">Jenis Linen</th>
                                        <th class="text-center text-white" style="width: 25%">Jumlah</th>
                                        <th class="text-center text-white" style="width: 20%">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->details as $index => $detail)
                                        <tr>
                                            <td class="text-center text-muted">{{ $index + 1 }}</td>
                                            <td class="font-weight-bold text-dark"><i
                                                    class="fas fa-tshirt text-primary mr-2"></i>
                                                {{ $detail->linen->nama_linen }}</td>
                                            <td class="text-center font-weight-bold text-dark" style="font-size: 1.1em;">
                                                {{ $detail->qty }}
                                            </td>
                                            <td class="text-center text-muted">{{ $detail->linen->satuan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light">
                                        <td colspan="2" class="text-right font-weight-bold text-uppercase">Total Item:
                                        </td>
                                        <td class="text-center font-weight-bold text-primary" style="font-size: 1.3em;">
                                            {{ $transaction->total_qty }}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100" style="border-radius: 15px; border-top: 4px solid var(--primary-color);">
                    <div class="card-header border-0 pb-0 pt-4">
                        <h4 class="card-title fw-bold text-primary mb-0"><i class="fas fa-map-marker-alt mr-2"></i> Live
                            Tracking</h4>
                    </div>
                    <div class="card-body">

                        <div class="text-center mb-4 pb-3 border-bottom">
                            <span class="d-block text-muted small text-uppercase fw-bold mb-2">Posisi Saat Ini:</span>
                            @if ($transaction->status == 'Pending')
                                <h2 class="text-warning font-weight-bold mb-0"><i class="fas fa-clock mr-2"></i>PENDING</h2>
                            @elseif($transaction->status == 'Dijemput')
                                <h2 class="text-info font-weight-bold mb-0"><i class="fas fa-truck-pickup mr-2"></i>DIJEMPUT
                                </h2>
                            @elseif($transaction->status == 'Proses')
                                <h2 class="text-primary font-weight-bold mb-0"><i
                                        class="fas fa-sync-alt fa-spin mr-2"></i>PROSES CUCI</h2>
                            @elseif($transaction->status == 'Selesai')
                                <h2 class="text-success font-weight-bold mb-0"><i
                                        class="fas fa-check-circle mr-2"></i>SELESAI</h2>
                            @elseif($transaction->status == 'Diantar')
                                <h2 class="text-dark font-weight-bold mb-0"><i class="fas fa-truck mr-2"></i>DIANTAR KEMBALI
                                </h2>
                            @else
                                <h2 class="text-secondary font-weight-bold mb-0">{{ strtoupper($transaction->status) }}</h2>
                            @endif
                        </div>

                        <style>
                            .activity-feed {
                                padding: 5px 15px;
                                list-style: none;
                                margin-bottom: 0;
                            }

                            .feed-item {
                                position: relative;
                                padding-bottom: 25px;
                                padding-left: 25px;
                                border-left: 2px solid #e4e8eb;
                            }

                            .feed-item:last-child {
                                border-left: 2px solid transparent;
                                padding-bottom: 0;
                            }

                            .feed-item::after {
                                content: "";
                                display: block;
                                position: absolute;
                                top: 0;
                                left: -8px;
                                width: 14px;
                                height: 14px;
                                border-radius: 50%;
                                background: #fff;
                                border: 3px solid #e4e8eb;
                            }

                            /* Warna Timeline Berdasarkan Status (Royal Purple Theme) */
                            .timeline-done {
                                border-left-color: var(--primary-color);
                            }

                            .timeline-done::after {
                                border-color: var(--primary-color);
                                background: var(--primary-color);
                                box-shadow: 0 0 0 3px rgba(104, 97, 206, 0.2);
                            }

                            .timeline-active {
                                border-left-color: #e4e8eb;
                            }

                            .timeline-active::after {
                                border-color: var(--primary-color);
                                background: #fff;
                                box-shadow: 0 0 0 3px rgba(104, 97, 206, 0.4);
                                animation: pulse 2s infinite;
                            }

                            .timeline-wait::after {
                                border-color: #e4e8eb;
                                background: #fff;
                            }

                            @keyframes pulse {
                                0% {
                                    box-shadow: 0 0 0 0 rgba(104, 97, 206, 0.4);
                                }

                                70% {
                                    box-shadow: 0 0 0 8px rgba(104, 97, 206, 0);
                                }

                                100% {
                                    box-shadow: 0 0 0 0 rgba(104, 97, 206, 0);
                                }
                            }
                        </style>

                        @php
                            // Logika sederhana untuk menentukan class timeline
                            $s = $transaction->status;
                            $p1 = 'timeline-done';
                            $p2 = 'timeline-wait';
                            $p3 = 'timeline-wait';
                            $p4 = 'timeline-wait';
                            $p5 = 'timeline-wait';

                            if ($s == 'Pending') {
                                $p1 = 'timeline-active';
                            }
                            if ($s == 'Dijemput') {
                                $p2 = 'timeline-active';
                            }
                            if ($s == 'Proses') {
                                $p2 = 'timeline-done';
                                $p3 = 'timeline-active';
                            }
                            if ($s == 'Selesai') {
                                $p2 = 'timeline-done';
                                $p3 = 'timeline-done';
                                $p4 = 'timeline-active';
                            }
                            if ($s == 'Diantar') {
                                $p2 = 'timeline-done';
                                $p3 = 'timeline-done';
                                $p4 = 'timeline-done';
                                $p5 = 'timeline-done';
                            }
                        @endphp

                        <ul class="activity-feed">
                            <li class="feed-item {{ $p1 }}">
                                <span
                                    class="text font-weight-bold {{ $p1 == 'timeline-done' || $p1 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">1.
                                    Pesanan Diterima (Pending)</span>
                                <small class="text-muted d-block">Menunggu kurir laundry menjemput.</small>
                            </li>
                            <li class="feed-item {{ $p2 }}">
                                <span
                                    class="text font-weight-bold {{ $p2 == 'timeline-done' || $p2 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">2.
                                    Dijemput (Pick Up)</span>
                                <small class="text-muted d-block">Linen sedang dibawa oleh kurir.</small>
                            </li>
                            <li class="feed-item {{ $p3 }}">
                                <span
                                    class="text font-weight-bold {{ $p3 == 'timeline-done' || $p3 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">3.
                                    Proses Cuci (Washing)</span>
                                <small class="text-muted d-block">Sedang dicuci & disetrika di laundry.</small>
                            </li>
                            <li class="feed-item {{ $p4 }}">
                                <span
                                    class="text font-weight-bold {{ $p4 == 'timeline-done' || $p4 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">4.
                                    Selesai (Ready)</span>
                                <small class="text-muted d-block">Cucian sudah bersih dan rapi.</small>
                            </li>
                            <li class="feed-item {{ $p5 }}">
                                <span
                                    class="text font-weight-bold {{ $p5 == 'timeline-done' ? 'text-primary' : 'text-muted' }}">5.
                                    Diantar (Delivered)</span>
                                <small class="text-muted d-block">Pesanan sedang dalam perjalanan ke Hotel.</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .border-right-md {
            border-right: 1px solid #dee2e6;
        }

        @media (max-width: 768px) {
            .border-right-md {
                border-right: none;
                padding-bottom: 15px;
                border-bottom: 1px dashed #dee2e6;
            }
        }
    </style>
@endsection
