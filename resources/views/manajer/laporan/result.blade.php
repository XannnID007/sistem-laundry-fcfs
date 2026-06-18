@extends('layouts.app')

@section('title', 'Hasil Laporan')

@push('styles')
    <style>
        .room-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f2f1fa;
            border: 1.5px solid #e0ddf5;
            border-radius: 20px;
            padding: 3px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #6861CE;
            margin: 2px 2px 2px 0;
        }

        .room-detail-collapse {
            border: 1.5px solid #e8e6f8;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 8px;
        }

        .room-detail-collapse .room-header {
            background: linear-gradient(90deg, #6861CE, #9B59B6);
            padding: 7px 14px;
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .expand-btn {
            background: none;
            border: 1.5px solid #6861CE;
            border-radius: 20px;
            color: #6861CE;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 2px 12px;
            cursor: pointer;
            transition: all 0.15s;
        }

        .expand-btn:hover {
            background: #6861CE;
            color: #fff;
        }

        .grand-total-row td {
            background: linear-gradient(90deg, #6861CE, #9B59B6) !important;
            color: #fff !important;
            font-weight: 800 !important;
            font-size: 1.05rem !important;
        }
    </style>
@endpush

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Hasil Generate Laporan</h4>
            <ul class="breadcrumbs">
                <li class="nav-home"><a href="{{ route('manajer.dashboard') }}"><i class="flaticon-home"></i></a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('manajer.laporan.index') }}">Laporan</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Hasil Generate</a></li>
            </ul>
        </div>

        {{-- Periode & Tombol --}}
        <div class="row mb-3 align-items-center">
            <div class="col-md-8">
                <h4 class="fw-bold mb-1">
                    Periode: <span class="text-primary">{{ date('d M Y', strtotime($request->start_date)) }} —
                        {{ date('d M Y', strtotime($request->end_date)) }}</span>
                </h4>
                <p class="text-muted small mb-0">Diurutkan berdasarkan waktu masuk (FCFS) · Menampilkan rincian linen per
                    kamar</p>
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
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h4 class="text-dark fw-bold">Tidak Ada Data Ditemukan</h4>
                    <p class="text-muted">Tidak ada transaksi pada periode yang dipilih.</p>
                </div>
            </div>
        @else
            {{-- Summary Cards --}}
            <div class="row">
                <div class="col-sm-3">
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
                <div class="col-sm-3">
                    <div class="card card-stats card-round shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small"><i
                                            class="fas fa-door-open"></i></div>
                                </div>
                                <div class="col col-stats ml-3 ml-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Kamar</p>
                                        <h4 class="card-title">
                                            {{ $transactions->sum(fn($t) => $t->details->pluck('no_room')->unique()->count()) }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card card-stats card-round shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small"><i
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
                <div class="col-sm-3">
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

            {{-- Tabel Laporan --}}
            <div class="card shadow-sm" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="table-responsive p-3">
                        <table class="table table-hover table-head-bg-primary mb-0 mt-2" id="laporan-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:4%;">No</th>
                                    <th style="width:9%;">ID</th>
                                    <th style="width:18%;">Nama Hotel</th>
                                    <th style="width:14%;">Waktu Input</th>
                                    <th class="text-center" style="width:8%;">Kamar</th>
                                    <th style="width:28%;">Rincian per Kamar</th>
                                    <th class="text-center" style="width:9%;">Grand Total</th>
                                    <th class="text-center" style="width:10%;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $index => $transaction)
                                    @php
                                        $roomGroups = $transaction->details->groupBy('no_room');
                                    @endphp
                                    <tr>
                                        <td class="text-center text-muted align-middle">{{ $index + 1 }}</td>
                                        <td class="font-weight-bold text-dark align-middle">
                                            #{{ $transaction->transaction_id }}</td>
                                        <td class="fw-bold align-middle">{{ $transaction->user->hotel->nama_hotel }}</td>
                                        <td class="align-middle">
                                            <span class="d-block text-dark"
                                                style="font-size:0.9rem;">{{ $transaction->tgl_transaksi->format('d/m/Y') }}</span>
                                            <small class="text-muted"><i
                                                    class="fas fa-clock mr-1 text-primary"></i>{{ $transaction->tgl_transaksi->format('H:i') }}</small>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-primary"
                                                style="border-radius:20px; padding:5px 10px;">
                                                {{ $roomGroups->count() }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            {{-- Chip ringkasan per kamar --}}
                                            <div class="mb-1">
                                                @foreach ($roomGroups as $noRoom => $details)
                                                    <span class="room-chip">
                                                        <i class="fas fa-door-open" style="font-size:0.7rem;"></i>
                                                        Km {{ $noRoom }}: {{ $details->sum('qty') }} item
                                                    </span>
                                                @endforeach
                                            </div>
                                            {{-- Tombol expand detail --}}
                                            <button class="expand-btn mt-1" type="button" data-toggle="collapse"
                                                data-target="#detail-{{ $transaction->transaction_id }}"
                                                aria-expanded="false">
                                                <i class="fas fa-chevron-down mr-1"></i> Lihat Detail
                                            </button>
                                            {{-- Collapse detail per kamar --}}
                                            <div class="collapse" id="detail-{{ $transaction->transaction_id }}">
                                                @foreach ($roomGroups as $noRoom => $details)
                                                    <div class="room-detail-collapse mt-2">
                                                        <div class="room-header">
                                                            <span><i class="fas fa-door-open mr-1"
                                                                    style="opacity:0.75;"></i> Kamar
                                                                {{ $noRoom }}</span>
                                                            <span
                                                                style="background:rgba(255,255,255,0.2); border:1px solid rgba(255,255,255,0.4); border-radius:10px; padding:2px 10px; font-size:0.78rem;">
                                                                {{ $details->sum('qty') }} item
                                                            </span>
                                                        </div>
                                                        <table class="table table-sm table-bordered mb-0">
                                                            <thead style="background:#f2f1fa;">
                                                                <tr>
                                                                    <th style="color:#6861CE; font-size:0.75rem;">Jenis
                                                                        Linen</th>
                                                                    <th class="text-center"
                                                                        style="color:#6861CE; font-size:0.75rem; width:25%;">
                                                                        Qty</th>
                                                                    <th class="text-center"
                                                                        style="color:#6861CE; font-size:0.75rem; width:20%;">
                                                                        Satuan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($details as $detail)
                                                                    <tr>
                                                                        <td style="font-size:0.82rem;">
                                                                            {{ $detail->linen->nama_linen }}</td>
                                                                        <td class="text-center font-weight-bold text-primary"
                                                                            style="font-size:0.88rem;">{{ $detail->qty }}
                                                                        </td>
                                                                        <td class="text-center text-muted"
                                                                            style="font-size:0.82rem;">
                                                                            {{ $detail->linen->satuan }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge badge-light border text-dark font-weight-bold"
                                                style="font-size:0.9rem; padding:6px 10px;">
                                                {{ $transaction->total_qty }} pcs
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
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
                            {{-- Grand Total Footer --}}
                            <tfoot>
                                <tr class="grand-total-row">
                                    <td colspan="4" class="text-right" style="border-radius:0 0 0 10px;">
                                        <i class="fas fa-receipt mr-2"></i> GRAND TOTAL PERIODE
                                    </td>
                                    <td class="text-center">
                                        {{ $transactions->sum(fn($t) => $t->details->pluck('no_room')->unique()->count()) }}
                                        kamar
                                    </td>
                                    <td class="text-center">
                                        {{ $transactions->count() }} transaksi
                                    </td>
                                    <td class="text-center" style="font-size:1.15rem !important;">
                                        {{ $transactions->sum('total_qty') }} pcs
                                    </td>
                                    <td style="border-radius:0 0 10px 0;">
                                        {{ $transactions->whereIn('status', ['Selesai', 'Diantar'])->count() }}/{{ $transactions->count() }}
                                        selesai
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        @endif
    </div>

    @push('scripts')
        <script>
            // Toggle teks tombol expand
            document.querySelectorAll('.expand-btn').forEach(btn => {
                const target = document.querySelector(btn.getAttribute('data-target'));
                target.addEventListener('show.bs.collapse', () => {
                    btn.innerHTML = '<i class="fas fa-chevron-up mr-1"></i> Sembunyikan';
                });
                target.addEventListener('hide.bs.collapse', () => {
                    btn.innerHTML = '<i class="fas fa-chevron-down mr-1"></i> Lihat Detail';
                });
                // Bootstrap 4 events
                $(target).on('show.bs.collapse', () => {
                    btn.innerHTML = '<i class="fas fa-chevron-up mr-1"></i> Sembunyikan';
                });
                $(target).on('hide.bs.collapse', () => {
                    btn.innerHTML = '<i class="fas fa-chevron-down mr-1"></i> Lihat Detail';
                });
            });
        </script>
    @endpush
@endsection
