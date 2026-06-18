@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Rincian Transaksi</h4>
            <ul class="breadcrumbs">
                <li class="nav-home"><a href="{{ route('laundry.dashboard') }}"><i class="flaticon-home"></i></a></li>
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

        @php
            $roomGroups = $transaction->details->groupBy('no_room');
        @endphp

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

                        {{-- Info Hotel & Waktu --}}
                        <div class="row mb-4 bg-light p-3 rounded border">
                            <div class="col-md-4 mb-3 mb-md-0 border-right">
                                <label class="text-muted mb-1 small text-uppercase fw-bold"><i
                                        class="fas fa-hotel text-primary mr-1"></i> Asal Hotel</label>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $transaction->user->hotel->nama_hotel }}</h5>
                                <p class="mb-0 text-muted mt-1 small"><i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                    {{ $transaction->user->hotel->alamat }}</p>
                            </div>
                            <div class="col-md-4 mb-3 mb-md-0 border-right pl-md-4">
                                <label class="text-muted mb-1 small text-uppercase fw-bold"><i
                                        class="fas fa-clock text-primary mr-1"></i> Waktu Input (FCFS)</label>
                                <h5 class="font-weight-bold text-dark mb-0">
                                    {{ $transaction->tgl_transaksi->format('d F Y') }}</h5>
                                <span class="badge badge-primary mt-1">{{ $transaction->tgl_transaksi->format('H:i') }}
                                    WIB</span>
                            </div>
                            <div class="col-md-4 pl-md-4">
                                <label class="text-muted mb-1 small text-uppercase fw-bold"><i
                                        class="fas fa-door-open text-primary mr-1"></i> Jumlah Kamar</label>
                                <h5 class="font-weight-bold text-dark mb-0">{{ $roomGroups->count() }} Kamar</h5>
                                <span class="text-muted small">Total: {{ $transaction->total_qty }} Item</span>
                            </div>
                        </div>

                        {{-- Detail Per Kamar --}}
                        <h5 class="fw-bold mb-3 text-primary border-bottom pb-2">
                            <i class="fas fa-list mr-2"></i>Rincian Item per Kamar
                        </h5>

                        @foreach ($roomGroups as $noRoom => $details)
                            <div class="mb-3" style="border: 2px solid #e8e6f8; border-radius: 12px; overflow: hidden;">
                                <div
                                    style="background: linear-gradient(90deg, #6861CE, #9B59B6); padding: 10px 18px; display:flex; align-items:center; justify-content:space-between;">
                                    <span style="color:#fff; font-weight:800; font-size:0.95rem;">
                                        <i class="fas fa-door-open mr-2" style="opacity:0.75;"></i>Kamar
                                        {{ $noRoom }}
                                    </span>
                                    <span
                                        style="background:rgba(255,255,255,0.2); border:1.5px solid rgba(255,255,255,0.4); border-radius:20px; padding:3px 14px; color:#fff; font-weight:700; font-size:0.82rem;">
                                        Subtotal: {{ $details->sum('qty') }} item
                                    </span>
                                </div>
                                <table class="table table-bordered mb-0">
                                    <thead style="background:#f2f1fa;">
                                        <tr>
                                            <th style="width:8%; color:#6861CE; font-size:0.8rem;" class="text-center">No
                                            </th>
                                            <th style="color:#6861CE; font-size:0.8rem;">Jenis Linen</th>
                                            <th style="width:20%; color:#6861CE; font-size:0.8rem;" class="text-center">Qty
                                            </th>
                                            <th style="width:20%; color:#6861CE; font-size:0.8rem;" class="text-center">
                                                Satuan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $i => $detail)
                                            <tr>
                                                <td class="text-center text-muted">{{ $i + 1 }}</td>
                                                <td class="font-weight-bold">{{ $detail->linen->nama_linen }}</td>
                                                <td class="text-center font-weight-bold text-primary"
                                                    style="font-size: 1.05em;">{{ $detail->qty }}</td>
                                                <td class="text-center text-muted">{{ $detail->linen->satuan }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr style="background:#f8f7ff;">
                                            <td colspan="2" class="text-right font-weight-bold"
                                                style="font-size:0.85rem;">Subtotal Kamar {{ $noRoom }}:</td>
                                            <td class="text-center font-weight-bold text-primary" style="font-size:1.1em;">
                                                {{ $details->sum('qty') }}</td>
                                            <td class="text-center text-muted">Item</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endforeach

                        {{-- Grand Total --}}
                        <div
                            style="background: linear-gradient(135deg, #6861CE 0%, #9B59B6 100%); border-radius: 12px; padding: 16px 24px; display:flex; align-items:center; justify-content:space-between; color:#fff; margin-top: 0.5rem;">
                            <div>
                                <div style="font-size:0.78rem; font-weight:600; opacity:0.75; text-transform:uppercase;">
                                    Grand Total Checkout — {{ $roomGroups->count() }} Kamar</div>
                                <div style="font-size:2rem; font-weight:900; line-height:1.2;">
                                    {{ $transaction->total_qty }} <span
                                        style="font-size:1rem; font-weight:500;">item</span>
                                </div>
                                <div style="font-size:0.82rem; opacity:0.7; margin-top:2px;">
                                    @foreach ($roomGroups as $noRoom => $details)
                                        <span
                                            style="background:rgba(255,255,255,0.15); border-radius:10px; padding:2px 10px; margin-right:5px; display:inline-block; margin-top:4px;">
                                            Km {{ $noRoom }}: {{ $details->sum('qty') }} item
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div style="font-size:3rem; opacity:0.2;"><i class="fas fa-receipt"></i></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
