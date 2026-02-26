@extends('layouts.app')

@section('title', 'Hasil Laporan')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Hasil Generate Laporan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('manajer.dashboard') }}"><i class="flaticon-home"></i></a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('manajer.laporan.index') }}">Laporan</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Hasil Generate</a></li>
            </ul>
        </div>

        <div class="row mb-3">
            <div class="col-md-8 align-self-center">
                <h4 class="fw-bold mb-1">Periode: <span
                        class="text-primary">{{ date('d M Y', strtotime($request->start_date)) }} -
                        {{ date('d M Y', strtotime($request->end_date)) }}</span></h4>
                <p class="text-muted small">Diurutkan berdasarkan waktu masuk (FCFS)</p>
            </div>
            <div class="col-md-4 text-md-right mt-2 mt-md-0 d-flex flex-column flex-md-row justify-content-end">
                <a href="{{ route('manajer.laporan.index') }}"
                    class="btn btn-light btn-border btn-round shadow-sm mr-2 mb-2 mb-md-0">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
                <a href="{{ route('manajer.laporan.pdf', ['start_date' => $request->start_date, 'end_date' => $request->end_date]) }}"
                    class="btn btn-primary btn-round shadow-sm" target="_blank">
                    <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
                </a>
            </div>
        </div>

        @if ($transactions->isEmpty())
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted opacity-50 mb-3"></i>
                    <h4 class="text-dark fw-bold">Tidak Ada Data Ditemukan</h4>
                    <p class="text-muted">Tidak ada satupun transaksi yang tercatat pada periode tanggal yang Anda pilih.
                    </p>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-4">
                    <div class="card card-stats card-round shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small"><i
                                            class="fas fa-shopping-cart"></i></div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Transaksi</p>
                                        <h4 class="card-title">{{ $transactions->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-stats card-round shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small"><i
                                            class="fas fa-layer-group"></i></div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Item Linen</p>
                                        <h4 class="card-title">{{ $transactions->sum('total_qty') }} pcs</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-stats card-round shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small"><i
                                            class="fas fa-check-circle"></i></div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Telah Selesai</p>
                                        <h4 class="card-title">
                                            {{ $transactions->whereIn('status', ['Selesai', 'Diantar'])->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="table-responsive p-3">
                        <table class="table table-hover table-head-bg-primary mb-0 mt-2 rounded">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th>ID Transaksi</th>
                                    <th>Nama Hotel</th>
                                    <th>Waktu Input</th>
                                    <th class="text-center">Total Qty</th>
                                    <th class="text-center">Status Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $index => $transaction)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="font-weight-bold text-dark">#{{ $transaction->transaction_id }}</td>
                                        <td class="fw-bold">{{ $transaction->user->hotel->nama_hotel }}</td>
                                        <td>
                                            <i class="fas fa-clock text-muted mr-1"></i>
                                            {{ $transaction->tgl_transaksi->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-light border">{{ $transaction->total_qty }} pcs</span>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
