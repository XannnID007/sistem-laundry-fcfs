@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="panel-header card-status-gradient shadow-sm">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold" style="letter-spacing: 1px;">Riwayat Pengiriman Linen</h2>
                    <h5 class="text-white op-8 mb-2">
                        <i class="fas fa-list-alt mr-2"></i> Daftar semua transaksi dan status laundry Anda
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
                <div class="card shadow-sm" style="border-radius: 15px;">
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
                                    class="btn btn-primary btn-round shadow-sm px-4 py-2">
                                    <i class="fas fa-plus mr-2"></i> Input Transaksi
                                </a>
                            </div>
                        @else
                            <div class="table-responsive p-3">
                                <table class="table table-hover table-head-bg-primary mb-0 mt-2 rounded">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 15%;">ID Transaksi</th>
                                            <th>Waktu Input</th>
                                            <th class="text-center">Total Item</th>
                                            <th class="text-center" style="width: 20%;">Status Tracker</th>
                                            <th class="text-center" style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="text-center font-weight-bold text-dark">
                                                    <span
                                                        class="bg-light px-3 py-1 rounded border">#{{ $transaction->transaction_id }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="fw-bold d-block text-dark">{{ $transaction->tgl_transaksi->format('d F Y') }}</span>
                                                    <small class="text-muted"><i class="fas fa-clock text-primary mr-1"></i>
                                                        {{ $transaction->tgl_transaksi->format('H:i') }} WIB</small>
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
                                                        <span class="badge badge-warning text-white px-3 py-1 shadow-sm"><i
                                                                class="fas fa-clock mr-1"></i> Pending</span>
                                                    @elseif($transaction->status == 'Dijemput')
                                                        <span class="badge badge-info px-3 py-1 shadow-sm"><i
                                                                class="fas fa-truck-pickup mr-1"></i> Dijemput</span>
                                                    @elseif($transaction->status == 'Proses')
                                                        <span class="badge badge-primary px-3 py-1 shadow-sm"><i
                                                                class="fas fa-sync-alt fa-spin mr-1"></i> Proses Cuci</span>
                                                    @elseif($transaction->status == 'Selesai')
                                                        <span class="badge badge-success px-3 py-1 shadow-sm"><i
                                                                class="fas fa-check-circle mr-1"></i> Selesai</span>
                                                    @elseif($transaction->status == 'Diantar')
                                                        <span class="badge badge-dark px-3 py-1 shadow-sm"><i
                                                                class="fas fa-truck mr-1"></i> Diantar</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('hotel.transactions.show', $transaction->transaction_id) }}"
                                                        class="btn btn-outline-primary btn-round btn-sm shadow-sm font-weight-bold"
                                                        data-toggle="tooltip" title="Lacak Pesanan">
                                                        <i class="fas fa-search mr-1"></i> Cek
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
