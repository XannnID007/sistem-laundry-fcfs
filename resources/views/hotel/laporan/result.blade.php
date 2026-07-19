@extends('layouts.app')

@section('title', 'Laporan Transaksi — ' . $hotelName)

@push('styles')
    <style>
        /* ── Report header card ── */
        .report-info-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-left: 5px solid var(--primary-color);
            border-radius: 10px;
            padding: 20px 24px;
            margin-bottom: 24px;
        }

        .report-info-card .label {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }

        .report-info-card .value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            margin-top: 2px;
        }

        /* ── Stat cards ── */
        .stat-row {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }

        .stat-box {
            flex: 1;
            min-width: 140px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .stat-box .icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 1.1rem;
        }

        .stat-box .stat-num {
            font-size: 1.55rem;
            font-weight: 800;
            color: #1e293b;
            line-height: 1;
        }

        .stat-box .stat-lbl {
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
            color: #94a3b8;
            letter-spacing: 0.4px;
            margin-top: 3px;
        }

        /* ── Main table card ── */
        .report-table-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        .report-table-card .card-top {
            padding: 16px 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .report-tbl th {
            background: #f8fafc;
            color: #475569;
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.4px;
            padding: 13px 14px;
            border-bottom: 2px solid #e2e8f0;
            border-top: none;
            white-space: nowrap;
        }

        .report-tbl td {
            padding: 12px 14px;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.875rem;
        }

        .report-tbl tbody tr:hover {
            background: #fafbff;
        }

        .report-tbl tbody tr:last-child td {
            border-bottom: none;
        }

        /* ── Room chips ── */
        .room-chip {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 3px 9px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #475569;
            margin: 2px 2px 2px 0;
        }

        /* ── Room detail expand ── */
        .room-detail-wrap {
            margin-top: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .room-detail-header {
            background: #f8fafc;
            padding: 8px 14px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .room-detail-header .room-label {
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
        }

        .room-detail-inner table {
            margin-bottom: 0;
        }

        .room-detail-inner table th {
            background: #fff;
            font-size: 0.72rem;
            color: #94a3b8;
            text-transform: uppercase;
            padding: 8px 12px;
            font-weight: 700;
            border-top: none;
            border-bottom: 1px solid #f1f5f9;
        }

        .room-detail-inner table td {
            font-size: 0.82rem;
            padding: 7px 12px;
            border-color: #f1f5f9;
            color: #334155;
        }

        /* ── Toggle btn ── */
        .toggle-btn {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #475569;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 12px;
            cursor: pointer;
            transition: all 0.15s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .toggle-btn:hover {
            background: var(--primary-color);
            color: #fff;
            border-color: var(--primary-color);
        }

        /* ── Grand total footer row ── */
        .tfoot-total td {
            background: #1e293b !important;
            color: #fff !important;
            font-weight: 700 !important;
            font-size: 0.88rem;
            padding: 13px 14px;
        }

        /* ── Status badges ── */
        .s-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }

        .s-dijemput {
            background: #e0f2fe;
            color: #075985;
            border: 1px solid #bae6fd;
        }

        .s-proses {
            background: #ede9fe;
            color: #5b21b6;
            border: 1px solid #ddd6fe;
        }

        .s-selesai {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .s-diantar {
            background: #f1f5f9;
            color: #334155;
            border: 1px solid #e2e8f0;
        }

        .status-pill {
            display: inline-block;
            padding: 4px 11px;
            border-radius: 20px;
            font-size: 0.76rem;
            font-weight: 700;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 3.5rem;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .empty-state h5 {
            font-weight: 700;
            color: #64748b;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #94a3b8;
            font-size: 0.9rem;
        }
    </style>
@endpush

@section('content')
    <div class="page-inner">

        {{-- ── Page Header ── --}}
        <div class="page-header">
            <h4 class="page-title fw-bold">Laporan Transaksi</h4>
            <ul class="breadcrumbs">
                <li class="nav-home"><a href="{{ route('hotel.dashboard') }}"><i class="flaticon-home"></i></a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="{{ route('hotel.laporan.index') }}">Laporan</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Hasil</a></li>
            </ul>
        </div>

        {{-- ── Action bar ── --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap" style="gap:10px;">
            <a href="{{ route('hotel.laporan.index') }}" class="btn btn-light btn-round border shadow-sm px-3">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
            @if (!$transactions->isEmpty())
                <a href="{{ route('hotel.laporan.pdf', ['start_date' => $request->start_date, 'end_date' => $request->end_date]) }}"
                    class="btn btn-dark btn-round shadow-sm px-4" target="_blank">
                    <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
                </a>
            @endif
        </div>

        {{-- ── Report info card ── --}}
        <div class="report-info-card mb-4">
            <div class="row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="label">Hotel</div>
                    <div class="value"><i class="fas fa-building mr-1 text-primary"></i> {{ $hotelName }}</div>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <div class="label">Periode Laporan</div>
                    <div class="value">
                        {{ \Carbon\Carbon::parse($request->start_date)->isoFormat('D MMM YYYY') }}
                        &nbsp;—&nbsp;
                        {{ \Carbon\Carbon::parse($request->end_date)->isoFormat('D MMM YYYY') }}
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="label">Metode Antrean</div>
                    <div class="value"><i class="fas fa-sort-amount-up mr-1 text-primary"></i> First Come First Served
                    </div>
                </div>
            </div>
        </div>

        @if ($transactions->isEmpty())
            <div class="report-table-card">
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <h5>Tidak Ada Transaksi</h5>
                    <p>Tidak ada transaksi pada periode
                        <strong>{{ \Carbon\Carbon::parse($request->start_date)->isoFormat('D MMM YYYY') }}</strong> s/d
                        <strong>{{ \Carbon\Carbon::parse($request->end_date)->isoFormat('D MMM YYYY') }}</strong>.</p>
                    <a href="{{ route('hotel.laporan.index') }}" class="btn btn-primary btn-round mt-3 px-4">Pilih Periode
                        Lain</a>
                </div>
            </div>
        @else
            @php
                $totalKamar = $transactions->sum(fn($t) => $t->details->pluck('no_room')->unique()->count());
                $totalItem = $transactions->sum('total_qty');
                $totalSelesai = $transactions->whereIn('status', ['Selesai', 'Diantar'])->count();
                $totalProses = $transactions->whereIn('status', ['Pending', 'Dijemput', 'Proses'])->count();
            @endphp

            {{-- ── Stat row ── --}}
            <div class="stat-row">
                <div class="stat-box">
                    <div class="icon-wrap" style="background:#ede9fe;"><i class="fas fa-receipt text-primary"></i></div>
                    <div>
                        <div class="stat-num">{{ $transactions->count() }}</div>
                        <div class="stat-lbl">Transaksi</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="icon-wrap" style="background:#e0f2fe;"><i class="fas fa-door-open"
                            style="color:#0284c7;"></i></div>
                    <div>
                        <div class="stat-num">{{ $totalKamar }}</div>
                        <div class="stat-lbl">Total Kamar</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="icon-wrap" style="background:#fef9c3;"><i class="fas fa-layer-group"
                            style="color:#ca8a04;"></i></div>
                    <div>
                        <div class="stat-num">{{ $totalItem }}</div>
                        <div class="stat-lbl">Item Linen</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="icon-wrap" style="background:#dcfce7;"><i class="fas fa-check-circle"
                            style="color:#16a34a;"></i></div>
                    <div>
                        <div class="stat-num">{{ $totalSelesai }}<span
                                style="font-size:1rem;color:#94a3b8;">/{{ $transactions->count() }}</span></div>
                        <div class="stat-lbl">Selesai</div>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="icon-wrap" style="background:#fee2e2;"><i class="fas fa-sync-alt"
                            style="color:#dc2626;"></i></div>
                    <div>
                        <div class="stat-num">{{ $totalProses }}</div>
                        <div class="stat-lbl">Dalam Proses</div>
                    </div>
                </div>
            </div>

            {{-- ── Table ── --}}
            <div class="report-table-card">
                <div class="card-top">
                    <div>
                        <h5 class="mb-0 fw-bold text-dark" style="font-size:0.95rem;">Rincian Transaksi</h5>
                        <small class="text-muted">Diurutkan: waktu masuk (FCFS) · {{ $transactions->count() }} transaksi
                            ditemukan</small>
                    </div>
                    <span class="badge badge-primary px-3 py-2" style="border-radius:20px;">{{ $transactions->count() }}
                        data</span>
                </div>

                <div class="table-responsive">
                    <table class="table report-tbl mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:4%;">#</th>
                                <th style="width:9%;">ID Order</th>
                                <th style="width:14%;">Waktu Masuk</th>
                                <th class="text-center" style="width:7%;">Kamar</th>
                                <th style="width:38%;">Rincian Linen per Kamar</th>
                                <th class="text-center" style="width:10%;">Total Item</th>
                                <th class="text-center" style="width:10%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $i => $trx)
                                @php $roomGroups = $trx->details->groupBy('no_room'); @endphp
                                <tr>
                                    <td class="text-center text-muted">{{ $i + 1 }}</td>
                                    <td>
                                        <span class="font-weight-bold text-dark"
                                            style="font-size:0.9rem;">#{{ $trx->transaction_id }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block font-weight-bold text-dark"
                                            style="font-size:0.85rem;">{{ $trx->tgl_transaksi->format('d/m/Y') }}</span>
                                        <small class="text-muted"><i
                                                class="far fa-clock mr-1"></i>{{ $trx->tgl_transaksi->format('H:i') }}
                                            WIB</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-primary"
                                            style="border-radius:20px; padding:5px 10px;">{{ $roomGroups->count() }}</span>
                                    </td>
                                    <td>
                                        {{-- chips --}}
                                        <div class="mb-2">
                                            @foreach ($roomGroups as $noRoom => $details)
                                                <span class="room-chip"><i class="fas fa-door-open"
                                                        style="font-size:0.65rem;"></i> Km.{{ $noRoom }}:
                                                    <strong>{{ $details->sum('qty') }}</strong> item</span>
                                            @endforeach
                                        </div>
                                        {{-- toggle --}}
                                        <button class="toggle-btn" data-toggle="collapse"
                                            data-target="#rd-{{ $trx->transaction_id }}">
                                            <i class="fas fa-chevron-down"></i> Lihat Detail Kamar
                                        </button>
                                        {{-- collapse detail --}}
                                        <div class="collapse" id="rd-{{ $trx->transaction_id }}">
                                            @foreach ($roomGroups as $noRoom => $details)
                                                <div class="room-detail-wrap mt-2">
                                                    <div class="room-detail-header">
                                                        <span class="room-label"><i
                                                                class="fas fa-door-open mr-1 text-primary"></i> Kamar
                                                            {{ $noRoom }}</span>
                                                        <small class="text-muted font-weight-bold">Subtotal:
                                                            {{ $details->sum('qty') }} pcs</small>
                                                    </div>
                                                    <div class="room-detail-inner">
                                                        <table class="table table-sm mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Jenis Linen</th>
                                                                    <th class="text-center" style="width:25%;">Qty</th>
                                                                    <th class="text-center" style="width:22%;">Satuan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($details as $d)
                                                                    <tr>
                                                                        <td>{{ $d->linen->nama_linen }}</td>
                                                                        <td
                                                                            class="text-center font-weight-bold text-primary">
                                                                            {{ $d->qty }}</td>
                                                                        <td class="text-center text-muted">
                                                                            {{ $d->linen->satuan }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="font-weight-bold text-dark"
                                            style="font-size:1.05rem;">{{ $trx->total_qty }}</span>
                                        <small class="d-block text-muted">pcs</small>
                                    </td>
                                    <td class="text-center">
                                        @if ($trx->status == 'Pending')
                                            <span class="status-pill s-pending">Pending</span>
                                        @elseif($trx->status == 'Dijemput')
                                            <span class="status-pill s-dijemput">Dijemput</span>
                                        @elseif($trx->status == 'Proses')
                                            <span class="status-pill s-proses">Proses Cuci</span>
                                        @elseif($trx->status == 'Selesai')
                                            <span class="status-pill s-selesai">Selesai</span>
                                        @elseif($trx->status == 'Diantar')
                                            <span class="status-pill s-diantar">Diantar</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="tfoot-total">
                                <td colspan="3" class="text-right"><i class="fas fa-sigma mr-2"></i> Grand Total
                                    Periode</td>
                                <td class="text-center">{{ $totalKamar }} kamar</td>
                                <td class="text-center">{{ $transactions->count() }} transaksi</td>
                                <td class="text-center" style="font-size:1.1rem;">{{ $totalItem }} <small
                                        style="font-size:0.75rem;opacity:0.7;">pcs</small></td>
                                <td class="text-center">{{ $totalSelesai }}/{{ $transactions->count() }} selesai</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endif

    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.toggle-btn').forEach(btn => {
                const target = document.querySelector(btn.getAttribute('data-target'));
                if (!target) return;
                $(target).on('show.bs.collapse', () => {
                    btn.innerHTML = '<i class="fas fa-chevron-up"></i> Sembunyikan Detail';
                });
                $(target).on('hide.bs.collapse', () => {
                    btn.innerHTML = '<i class="fas fa-chevron-down"></i> Lihat Detail Kamar';
                });
            });
        </script>
    @endpush
@endsection
