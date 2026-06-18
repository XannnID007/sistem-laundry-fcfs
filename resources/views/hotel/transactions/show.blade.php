@extends('layouts.app')

@section('title', 'Detail Transaksi')

@push('styles')
    <style>
        /* Styling Kartu Kamar yang Clean & Minimalist */
        .room-detail-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .room-detail-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .room-label {
            color: #334155;
            font-weight: 700;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .room-total-badge {
            background: #fff;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 20px;
            padding: 4px 16px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .room-detail-body table {
            margin-bottom: 0;
        }

        .room-detail-body table th {
            background: #fff;
            color: #64748b;
            font-weight: 600;
            font-size: 0.82rem;
            text-transform: uppercase;
            border-bottom: 2px solid #f1f5f9 !important;
            border-top: none !important;
        }

        .room-detail-body table td {
            border-color: #f1f5f9;
            vertical-align: middle;
            padding: 12px 15px;
        }
    </style>
@endpush

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Lacak Transaksi
                        #{{ $transaction->transaction_id }}</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-search-location mr-2"></i> Rincian kamar dan status terkini cucian Anda
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
                <div class="card shadow-sm mb-4 border-0" style="border-radius: 12px;">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col-md-6 border-right">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-big text-center bg-light text-primary rounded-circle shadow-sm"
                                            style="width: 48px; height: 48px; line-height: 48px;">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-bold"
                                            style="font-size: 0.75rem;">Waktu Input (FCFS)</small>
                                        <strong class="text-dark"
                                            style="font-size: 1.05rem;">{{ $transaction->tgl_transaksi->format('d M Y, H:i') }}</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0 pl-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <div class="icon-big text-center bg-light text-success rounded-circle shadow-sm"
                                            style="width: 48px; height: 48px; line-height: 48px;">
                                            <i class="fas fa-layer-group"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block text-uppercase fw-bold"
                                            style="font-size: 0.75rem;">Total Seluruh Linen</small>
                                        <strong class="text-dark" style="font-size: 1.05rem;">{{ $transaction->total_qty }}
                                            Item ({{ $roomGroups->count() }} Kamar)</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="fw-bold mb-3 text-dark mt-2">
                    <i class="fas fa-bed text-primary mr-2"></i> Rincian Linen per Kamar
                </h5>

                @foreach ($roomGroups as $noRoom => $roomData)
                    <div class="room-detail-card shadow-sm">
                        <div class="room-detail-header">
                            <div class="room-label">
                                <i class="fas fa-door-open text-muted"></i> Kamar {{ $noRoom }}
                            </div>
                            <div class="room-total-badge">
                                {{ $roomData['total_qty'] }} Item
                            </div>
                        </div>

                        <div class="room-detail-body p-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;" class="text-center">No</th>
                                            <th style="width: 50%;">Jenis Linen</th>
                                            <th style="width: 20%;" class="text-center">Jumlah</th>
                                            <th style="width: 20%;" class="text-center">Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roomData['details'] as $i => $detail)
                                            <tr>
                                                <td class="text-center text-muted">{{ $i + 1 }}</td>
                                                <td class="font-weight-bold text-dark">
                                                    <i class="fas fa-caret-right text-muted mr-2"
                                                        style="font-size: 10px;"></i>
                                                    {{ $detail->linen->nama_linen }}
                                                </td>
                                                <td class="text-center font-weight-bold text-primary"
                                                    style="font-size: 1.1rem;">
                                                    {{ $detail->qty }}
                                                </td>
                                                <td class="text-center text-muted">{{ $detail->linen->satuan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-md-4 mt-2 mt-md-0">
                <div class="card shadow-sm h-100 border-0 sticky-top" style="border-radius: 12px; top: 80px;">
                    <div class="card-header bg-white pb-0 pt-4 border-bottom-0">
                        <h4 class="card-title fw-bold text-dark mb-0"><i
                                class="fas fa-map-marker-alt text-primary mr-2"></i> Status Tracker</h4>
                    </div>
                    <div class="card-body">

                        <div class="text-center mb-4 p-3 bg-light rounded border">
                            <span class="d-block text-muted small text-uppercase fw-bold mb-1">Posisi Saat Ini</span>
                            @if ($transaction->status == 'Pending')
                                <h3 class="text-warning font-weight-bold mb-0"><i class="fas fa-clock mr-2"></i>PENDING</h3>
                            @elseif($transaction->status == 'Dijemput')
                                <h3 class="text-info font-weight-bold mb-0"><i class="fas fa-truck-pickup mr-2"></i>DIJEMPUT
                                </h3>
                            @elseif($transaction->status == 'Proses')
                                <h3 class="text-primary font-weight-bold mb-0"><i
                                        class="fas fa-sync-alt fa-spin mr-2"></i>PROSES CUCI</h3>
                            @elseif($transaction->status == 'Selesai')
                                <h3 class="text-success font-weight-bold mb-0"><i
                                        class="fas fa-check-circle mr-2"></i>SELESAI</h3>
                            @elseif($transaction->status == 'Diantar')
                                <h3 class="text-dark font-weight-bold mb-0"><i class="fas fa-truck mr-2"></i>DIANTAR KEMBALI
                                </h3>
                            @else
                                <h3 class="text-secondary font-weight-bold mb-0">{{ strtoupper($transaction->status) }}
                                </h3>
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
                                border-left: 2px solid #e2e8f0;
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
                                border: 3px solid #e2e8f0;
                            }

                            /* Timeline Styling (Royal Purple Theme) */
                            .timeline-done {
                                border-left-color: var(--primary-color);
                            }

                            .timeline-done::after {
                                border-color: var(--primary-color);
                                background: var(--primary-color);
                                box-shadow: 0 0 0 3px rgba(104, 97, 206, 0.15);
                            }

                            .timeline-active {
                                border-left-color: #e2e8f0;
                            }

                            .timeline-active::after {
                                border-color: var(--primary-color);
                                background: #fff;
                                box-shadow: 0 0 0 3px rgba(104, 97, 206, 0.3);
                                animation: pulse 2s infinite;
                            }

                            .timeline-wait::after {
                                border-color: #e2e8f0;
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

                        <ul class="activity-feed px-2">
                            <li class="feed-item {{ $p1 }}">
                                <span
                                    class="text font-weight-bold {{ $p1 == 'timeline-done' || $p1 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">1.
                                    Diterima (Pending)</span>
                                <small class="text-muted d-block">Menunggu dijemput kurir.</small>
                            </li>
                            <li class="feed-item {{ $p2 }}">
                                <span
                                    class="text font-weight-bold {{ $p2 == 'timeline-done' || $p2 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">2.
                                    Pick Up</span>
                                <small class="text-muted d-block">Linen dibawa ke laundry.</small>
                            </li>
                            <li class="feed-item {{ $p3 }}">
                                <span
                                    class="text font-weight-bold {{ $p3 == 'timeline-done' || $p3 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">3.
                                    Proses Cuci</span>
                                <small class="text-muted d-block">Masuk tahap pencucian.</small>
                            </li>
                            <li class="feed-item {{ $p4 }}">
                                <span
                                    class="text font-weight-bold {{ $p4 == 'timeline-done' || $p4 == 'timeline-active' ? 'text-dark' : 'text-muted' }}">4.
                                    Selesai</span>
                                <small class="text-muted d-block">Bersih & siap dikirim.</small>
                            </li>
                            <li class="feed-item {{ $p5 }}">
                                <span
                                    class="text font-weight-bold {{ $p5 == 'timeline-done' ? 'text-primary' : 'text-muted' }}">5.
                                    Diantar</span>
                                <small class="text-muted d-block">Kembali ke hotel Anda.</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
