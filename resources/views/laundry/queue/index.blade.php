@extends('layouts.app')

@section('title', 'Antrean FCFS')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title text-primary fw-bold">Antrean Cucian (FCFS)</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('laundry.dashboard') }}">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Operasional</a></li>
                <li class="separator"><i class="flaticon-right-arrow"></i></li>
                <li class="nav-item"><a href="#">Antrean FCFS</a></li>
            </ul>
        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm" style="border-radius: 10px;">
                <b><i class="fas fa-check-circle mr-2"></i>Berhasil!</b> {{ session('success') }}
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card card-status-gradient shadow-sm mb-0">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="stamp stamp-md bg-white text-primary mr-4 shadow-sm" style="border-radius: 12px;">
                                <i class="fas fa-info-circle fa-2x"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 text-white fw-bold">Algoritma First Come First Served (FCFS)</h4>
                                <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                                    Transaksi yang masuk lebih dulu (timestamp lebih awal) berada di urutan teratas.
                                    Harap proses transaksi dari atas ke bawah untuk menjaga efisiensi dan keadilan antrean.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @if ($transactions->isEmpty())
                    <div class="card shadow-sm" style="border-radius: 15px;">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-clipboard-check fa-5x text-muted opacity-50"></i>
                            </div>
                            <h3 class="fw-bold text-primary">Tidak Ada Antrean Aktif</h3>
                            <p class="text-muted mb-0">Semua pesanan laundry sudah selesai diproses atau belum ada pesanan
                                baru yang masuk dari pihak Hotel.</p>
                        </div>
                    </div>
                @else
                    @foreach ($transactions as $index => $transaction)
                        <div class="card shadow-sm mb-3"
                            style="border-radius: 15px; border-left: 6px solid {{ $index === 0 ? '#f3545d' : ($index === 1 ? '#ffad46' : '#6861CE') }}; transition: transform 0.2s;">
                            <div class="card-body p-4">
                                <div class="row align-items-center">

                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center mb-2">
                                            @if ($index === 0)
                                                <span class="badge badge-danger px-3 py-1 mr-2 shadow-sm"
                                                    style="animation: pulse-red 2s infinite;"><i
                                                        class="fas fa-fire mr-1"></i> PRIORITAS UTAMA</span>
                                            @elseif($index === 1)
                                                <span
                                                    class="badge badge-warning px-3 py-1 mr-2 text-white shadow-sm">ANTREAN
                                                    SELANJUTNYA</span>
                                            @else
                                                <span class="badge badge-primary px-3 py-1 mr-2 shadow-sm">ANTREAN
                                                    #{{ $index + 1 }}</span>
                                            @endif

                                            <h4 class="card-title fw-bold text-dark mb-0 ml-2">
                                                #{{ $transaction->transaction_id }} -
                                                {{ $transaction->user->hotel->nama_hotel }}
                                            </h4>
                                        </div>

                                        <div class="text-muted small mb-3 mt-2">
                                            <span class="bg-light px-2 py-1 rounded border"><i
                                                    class="fas fa-clock mr-1 text-primary"></i> Masuk: <strong
                                                    class="text-dark">{{ $transaction->tgl_transaksi->format('d M Y, H:i') }}</strong></span>
                                            <span class="mx-2 text-muted">|</span>
                                            <span class="bg-light px-2 py-1 rounded border"><i
                                                    class="fas fa-layer-group mr-1 text-primary"></i> Total: <strong
                                                    class="text-dark">{{ $transaction->total_qty }} Item</strong></span>
                                            <span class="mx-2 text-muted">|</span>

                                            @if ($transaction->status == 'Pending')
                                                <span class="badge badge-warning text-white">Pending</span>
                                            @elseif($transaction->status == 'Dijemput')
                                                <span class="badge badge-info">Sedang Dijemput</span>
                                            @elseif($transaction->status == 'Proses')
                                                <span class="badge badge-primary">Proses Cuci</span>
                                            @endif
                                        </div>

                                        <div class="p-3 bg-light" style="border-radius: 10px; border: 1px dashed #ccc;">
                                            <h6 class="font-weight-bold mb-2 text-primary"><i
                                                    class="fas fa-tshirt mr-1"></i> Rincian Linen:</h6>
                                            <div class="row">
                                                @foreach ($transaction->details as $detail)
                                                    <div class="col-md-4 col-6 mb-1">
                                                        <i class="fas fa-caret-right text-muted mr-1"
                                                            style="font-size: 10px;"></i>
                                                        <span class="text-muted">{{ $detail->linen->nama_linen }}:</span>
                                                        <strong class="text-dark">{{ $detail->qty }}
                                                            {{ $detail->linen->satuan }}</strong>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="col-md-4 mt-4 mt-md-0 d-flex flex-column align-items-md-end justify-content-center border-md-left pl-md-4">
                                        <p class="text-muted font-weight-bold mb-2 small text-uppercase">Tindakan Operator
                                        </p>

                                        <form
                                            action="{{ route('laundry.transactions.updateStatus', $transaction->transaction_id) }}"
                                            method="POST" class="w-100 mb-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group shadow-sm">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-primary text-white border-primary"><i
                                                            class="fas fa-sync-alt"></i></span>
                                                </div>
                                                <select name="status"
                                                    class="form-control border-primary fw-bold text-primary"
                                                    onchange="this.form.submit()" style="cursor: pointer;">
                                                    <option value="" disabled selected>Pilih Status Baru...</option>
                                                    <option value="Dijemput"
                                                        {{ $transaction->status == 'Dijemput' ? 'selected' : '' }}>Dijemput
                                                        (Pick Up)</option>
                                                    <option value="Proses"
                                                        {{ $transaction->status == 'Proses' ? 'selected' : '' }}>Proses
                                                        Cuci (Washing)</option>
                                                    <option value="Selesai"
                                                        {{ $transaction->status == 'Selesai' ? 'selected' : '' }}>Selesai
                                                        Cuci (Ready)</option>
                                                    <option value="Diantar"
                                                        {{ $transaction->status == 'Diantar' ? 'selected' : '' }}>Diantar
                                                        (Delivery)</option>
                                                </select>
                                            </div>
                                        </form>

                                        <a href="{{ route('laundry.transactions.show', $transaction->transaction_id) }}"
                                            class="btn btn-outline-primary btn-block btn-round mt-1">
                                            <i class="fas fa-eye mr-1"></i> Lihat Detail Lengkap
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <style>
        /* Efek denyut untuk prioritas utama agar lebih eye-catching bagi operator */
        @keyframes pulse-red {
            0% {
                box-shadow: 0 0 0 0 rgba(243, 84, 93, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(243, 84, 93, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(243, 84, 93, 0);
            }
        }

        .border-md-left {
            border-left: 1px solid #eee;
        }

        @media (max-width: 768px) {
            .border-md-left {
                border-left: none;
            }
        }
    </style>
@endsection
