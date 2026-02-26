@extends('layouts.app')

@section('title', 'Semua Transaksi')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Riwayat Transaksi</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('laundry.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Operasional</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Semua Transaksi</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm" style="border-radius: 15px;">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Daftar Lengkap Transaksi Laundry</h4>
                    </div>
                    <div class="card-body">
                        @if ($transactions->isEmpty())
                            <div class="text-center p-5">
                                <i class="fas fa-file-invoice-dollar fa-4x text-muted opacity-50 mb-3"></i>
                                <h4 class="text-muted fw-bold">Belum Ada Data Transaksi</h4>
                                <p class="text-muted mb-0">Seluruh riwayat orderan dari berbagai hotel akan muncul di sini.
                                </p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-head-bg-primary mt-2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th>Nama Hotel</th>
                                            <th>Tanggal Masuk</th>
                                            <th class="text-center">Total Item</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td class="text-center font-weight-bold text-dark">
                                                    #{{ $transaction->transaction_id }}</td>
                                                <td class="fw-bold">{{ $transaction->user->hotel->nama_hotel }}</td>
                                                <td>
                                                    <i class="fas fa-calendar-day text-primary mr-1"></i>
                                                    {{ $transaction->tgl_transaksi->format('d/m/Y') }}
                                                    <span
                                                        class="text-muted ml-1">{{ $transaction->tgl_transaksi->format('H:i') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-light border text-dark">{{ $transaction->total_qty }}
                                                        pcs</span>
                                                </td>
                                                <td class="text-center">
                                                    @if ($transaction->status == 'Pending')
                                                        <span class="badge badge-warning text-white">Pending</span>
                                                    @elseif($transaction->status == 'Dijemput')
                                                        <span class="badge badge-info">Dijemput</span>
                                                    @elseif($transaction->status == 'Proses')
                                                        <span class="badge badge-primary">Proses Cuci</span>
                                                    @elseif($transaction->status == 'Selesai')
                                                        <span class="badge badge-success">Selesai</span>
                                                    @elseif($transaction->status == 'Diantar')
                                                        <span class="badge badge-dark">Diantar</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('laundry.transactions.show', $transaction->transaction_id) }}"
                                                        class="btn btn-primary btn-round btn-sm shadow-sm"
                                                        data-toggle="tooltip" title="Lihat Detail Transaksi">
                                                        <i class="fas fa-eye mr-1"></i> Detail
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
