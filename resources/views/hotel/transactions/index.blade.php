@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@push('styles')
    <style>
        /* Clean & Minimalist Style untuk Tabel */
        .clean-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .clean-table {
            margin-bottom: 0;
        }

        .clean-table th {
            background: #f8fafc !important;
            color: #64748b !important;
            font-weight: 700 !important;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0 !important;
            border-top: none !important;
            padding: 16px 20px !important;
        }

        .clean-table td {
            padding: 16px 20px !important;
            vertical-align: middle !important;
            border-bottom: 1px solid #f1f5f9;
        }

        .clean-table tbody.transaction-rows tr {
            transition: background-color 0.2s ease;
        }

        .clean-table tbody.transaction-rows tr:hover {
            background-color: #fbfafc;
        }

        /* Header Grup Harian */
        .daily-group-header {
            background: #f8f7ff !important;
            border-bottom: 2px solid #e0ddf5 !important;
            border-top: 4px solid #fff !important;
        }

        /* Custom Badge untuk Status */
        .status-badge {
            padding: 6px 14px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
    </style>
@endpush

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Riwayat Pengiriman Linen</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-list-alt mr-2"></i> Daftar semua transaksi dan rekapitulasi harian Anda
                    </h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="{{ route('hotel.transactions.create') }}"
                        class="btn btn-white btn-border btn-round shadow-sm fw-bold">
                        <i class="fas fa-plus-circle mr-2"></i> Buat Pesanan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row">
            <div class="col-md-12">
                <div class="clean-card">
                    <div class="card-body p-0">
                        @if ($transactions->isEmpty())
                            <div class="text-center py-5 my-5">
                                <div class="avatar avatar-xxl mb-4">
                                    <span class="avatar-title rounded-circle bg-light text-primary shadow-sm"
                                        style="border: 3px solid var(--primary-color);">
                                        <i class="fas fa-box-open fa-3x"></i>
                                    </span>
                                </div>
                                <h4 class="text-dark fw-bold mb-3">Belum Ada Transaksi</h4>
                                <p class="text-muted mb-4 px-3">Anda belum mengirimkan cucian kotor ke pihak laundry. Mulai
                                    input transaksi pertama Anda sekarang.</p>
                                <a href="{{ route('hotel.transactions.create') }}"
                                    class="btn btn-primary btn-round shadow-sm px-4 py-2 font-weight-bold">
                                    <i class="fas fa-plus mr-2"></i> Input Transaksi
                                </a>
                            </div>
                        @else
                            @php

                                // 1. Mengelompokkan transaksi berdasarkan tanggal (Y-m-d)
                                $groupedTransactions = $transactions->groupBy(function ($item) {
                                    return $item->tgl_transaksi->format('Y-m-d');
                                });
                            @endphp

                            <div class="table-responsive">
                                <table class="table clean-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 15%;">ID Transaksi</th>
                                            <th>Waktu Input</th>
                                            <th class="text-center">Total Item</th>
                                            <th class="text-center" style="width: 20%;">Status Tracker</th>
                                            <th class="text-center" style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>

                                    @foreach ($groupedTransactions as $date => $dailyTransactions)
                                        @php
                                            // 2. Menghitung rekapitulasi harian (TAMBAHKAN \ DI DEPAN Carbon)
                                            $tanggalFormat = \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM Y');
                                            $totalLinenHariIni = $dailyTransactions->sum('total_qty');

                                            // Mengambil daftar nomor kamar unik dari semua transaksi di hari tersebut
                                            $totalKamarHariIni = $dailyTransactions
                                                ->flatMap(function ($trx) {
                                                    return $trx->details->pluck('no_room');
                                                })
                                                ->filter()
                                                ->unique()
                                                ->count();
                                        @endphp

                                        <tbody>
                                            <tr class="daily-group-header">
                                                <td colspan="5" class="py-3 px-4">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center flex-wrap">
                                                        <h5 class="mb-0 font-weight-bold text-primary">
                                                            <i class="fas fa-calendar-day mr-2"></i> {{ $tanggalFormat }}
                                                        </h5>
                                                        <div class="d-flex gap-2 mt-2 mt-md-0">
                                                            <span
                                                                class="badge bg-white text-dark border shadow-sm px-3 py-2"
                                                                style="font-size: 0.85rem;">
                                                                <i class="fas fa-door-open text-muted mr-1"></i>
                                                                {{ $totalKamarHariIni }} Kamar Checkout
                                                            </span>
                                                            <span class="badge bg-primary text-white shadow-sm px-3 py-2"
                                                                style="font-size: 0.85rem;">
                                                                <i class="fas fa-tshirt mr-1"></i> {{ $totalLinenHariIni }}
                                                                Total Linen
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <tbody class="transaction-rows">
                                            @foreach ($dailyTransactions as $transaction)
                                                <tr>
                                                    <td class="text-center">
                                                        <span
                                                            class="font-weight-bold text-dark bg-light px-3 py-1 rounded border shadow-sm"
                                                            style="font-size: 0.95rem;">
                                                            #{{ $transaction->transaction_id }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold d-block text-dark">Jam
                                                            {{ $transaction->tgl_transaksi->format('H:i') }} WIB</span>
                                                        <small class="text-muted"><i class="fas fa-user-clock mr-1"></i>
                                                            Antrean FCFS</small>
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge badge-light border text-dark font-weight-bold p-2 shadow-sm"
                                                            style="font-size: 0.95rem;">
                                                            {{ $transaction->total_qty }} pcs
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($transaction->status == 'Pending')
                                                            <span class="status-badge bg-warning text-white shadow-sm"><i
                                                                    class="fas fa-clock"></i> Pending</span>
                                                        @elseif($transaction->status == 'Dijemput')
                                                            <span class="status-badge bg-info text-white shadow-sm"><i
                                                                    class="fas fa-truck-pickup"></i> Dijemput</span>
                                                        @elseif($transaction->status == 'Proses')
                                                            <span class="status-badge bg-primary text-white shadow-sm"><i
                                                                    class="fas fa-sync-alt fa-spin"></i> Proses Cuci</span>
                                                        @elseif($transaction->status == 'Selesai')
                                                            <span class="status-badge bg-success text-white shadow-sm"><i
                                                                    class="fas fa-check-circle"></i> Selesai</span>
                                                        @elseif($transaction->status == 'Diantar')
                                                            <span class="status-badge bg-dark text-white shadow-sm"><i
                                                                    class="fas fa-truck"></i> Diantar</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="{{ route('hotel.transactions.show', $transaction->transaction_id) }}"
                                                            class="btn btn-outline-primary btn-round btn-sm font-weight-bold shadow-sm px-3"
                                                            data-toggle="tooltip" title="Lacak Pesanan">
                                                            <i class="fas fa-search mr-1"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
