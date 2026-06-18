<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Transaksi Laundry RedDoorz</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 14px;
            border-bottom: 3px solid #6861CE;
        }

        .header h1 {
            font-size: 18px;
            color: #1E293B;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .header p {
            color: #64748B;
            font-size: 10px;
            margin: 2px 0;
        }

        /* ── Summary Bar ── */
        .summary-bar {
            display: table;
            width: 100%;
            margin-bottom: 16px;
            border-collapse: separate;
            border-spacing: 6px;
        }

        .summary-cell {
            display: table-cell;
            width: 25%;
            background: #f2f1fa;
            border: 1.5px solid #e0ddf5;
            border-radius: 8px;
            padding: 10px 12px;
            text-align: center;
            vertical-align: middle;
        }

        .summary-cell .val {
            font-size: 20px;
            font-weight: 900;
            color: #6861CE;
            display: block;
        }

        .summary-cell .lbl {
            font-size: 9px;
            color: #888;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.4px;
        }

        /* ── Tabel Utama ── */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .main-table th {
            background: #6861CE;
            color: #fff;
            border: 1px solid #5C55BF;
            padding: 9px 7px;
            font-size: 9.5px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .main-table td {
            border: 1px solid #e2e8f0;
            padding: 0;
            vertical-align: top;
            font-size: 10px;
        }

        .main-table tr:nth-child(even) .cell-pad {
            background-color: #fafafa;
        }

        /* Padding wrapper di dalam td */
        .cell-pad {
            padding: 8px 7px;
        }

        /* ── Room Block (per kamar di dalam 1 baris transaksi) ── */
        .room-block {
            border: 1px solid #e0ddf5;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .room-block:last-child {
            margin-bottom: 0;
        }

        .room-block-header {
            background: #6861CE;
            color: #fff;
            padding: 4px 8px;
            font-weight: 700;
            font-size: 9px;
            display: table;
            width: 100%;
        }

        .room-block-header .rh-left {
            display: table-cell;
        }

        .room-block-header .rh-right {
            display: table-cell;
            text-align: right;
            font-weight: 400;
            opacity: 0.85;
        }

        .room-block-body {
            padding: 4px 0;
            background: #fff;
        }

        /* Baris linen di dalam room block */
        .linen-line {
            display: table;
            width: 100%;
            padding: 2px 8px;
        }

        .linen-line .ll-name {
            display: table-cell;
            color: #444;
        }

        .linen-line .ll-qty {
            display: table-cell;
            width: 30px;
            text-align: right;
            font-weight: 700;
            color: #6861CE;
        }

        .linen-line .ll-sat {
            display: table-cell;
            width: 30px;
            text-align: right;
            color: #888;
        }

        /* Subtotal mini per kamar */
        .room-subtotal {
            display: table;
            width: 100%;
            background: #f2f1fa;
            padding: 3px 8px;
            border-top: 1px dashed #d5d0f0;
        }

        .room-subtotal .rs-label {
            display: table-cell;
            color: #6861CE;
            font-weight: 700;
            font-size: 9px;
        }

        .room-subtotal .rs-val {
            display: table-cell;
            text-align: right;
            font-weight: 900;
            color: #6861CE;
            font-size: 10px;
        }

        /* ── Grand Total baris per transaksi ── */
        .grand-total-cell {
            background: #6861CE;
            color: #fff;
            text-align: center;
            font-weight: 900;
            font-size: 13px;
            padding: 8px 7px;
        }

        /* ── Footer Tabel (total periode) ── */
        .tfoot-row td {
            background: #1E293B !important;
            color: #fff !important;
            font-weight: 800 !important;
            font-size: 10.5px;
            padding: 10px 7px;
            border: 1px solid #1E293B;
        }

        /* ── Ringkasan Eksekutif ── */
        .exec-summary {
            margin-top: 20px;
            padding: 14px 16px;
            background: #f8fafc;
            border-left: 5px solid #6861CE;
            border-radius: 4px;
            page-break-inside: avoid;
        }

        .exec-summary h4 {
            font-size: 12px;
            color: #1E293B;
            margin-bottom: 8px;
        }

        .exec-table {
            width: 100%;
            border: none;
        }

        .exec-table td {
            border: none;
            padding: 3px 0;
            font-size: 10.5px;
        }

        /* ── Footer Dokumen ── */
        .doc-footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px dashed #cbd5e1;
        }

        .doc-footer p {
            margin: 2px 0;
            font-size: 8.5px;
            color: #94a3b8;
            font-style: italic;
        }

        .badge-status {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .badge-pending {
            background: #ffc107;
            color: #fff;
        }

        .badge-dijemput {
            background: #17a2b8;
            color: #fff;
        }

        .badge-proses {
            background: #6861CE;
            color: #fff;
        }

        .badge-selesai {
            background: #28a745;
            color: #fff;
        }

        .badge-diantar {
            background: #343a40;
            color: #fff;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>

    {{-- ── Header ── --}}
    <div class="header">
        <h1>Laporan Transaksi Laundry RedDoorz</h1>
        <p><strong>Periode:</strong> {{ date('d F Y', strtotime($request->start_date)) }} s/d
            {{ date('d F Y', strtotime($request->end_date)) }}</p>
        <p><strong>Dicetak:</strong> {{ date('d F Y, H:i:s') }} &nbsp;|&nbsp; <strong>Sistem:</strong> First Come First
            Served (FCFS)</p>
    </div>

    @if ($transactions->isEmpty())
        <div style="text-align:center; margin-top:50px; color:#94a3b8; padding:40px; border:1px dashed #cbd5e1;">
            <p><strong>TIDAK ADA DATA TRANSAKSI</strong></p>
            <p>Belum ada aktivitas transaksi pada rentang periode yang dipilih.</p>
        </div>
    @else
        {{-- ── Summary Bar ── --}}
        @php
            $totalKamar = $transactions->sum(fn($t) => $t->details->pluck('no_room')->unique()->count());
            $totalItem = $transactions->sum('total_qty');
            $totalSelesai = $transactions->whereIn('status', ['Selesai', 'Diantar'])->count();
        @endphp
        <div class="summary-bar">
            <div class="summary-cell">
                <span class="val">{{ $transactions->count() }}</span>
                <span class="lbl">Total Transaksi</span>
            </div>
            <div class="summary-cell">
                <span class="val">{{ $totalKamar }}</span>
                <span class="lbl">Total Kamar</span>
            </div>
            <div class="summary-cell">
                <span class="val">{{ $totalItem }}</span>
                <span class="lbl">Total Item (pcs)</span>
            </div>
            <div class="summary-cell">
                <span class="val">{{ $totalSelesai }}/{{ $transactions->count() }}</span>
                <span class="lbl">Selesai / Total</span>
            </div>
        </div>

        {{-- ── Tabel Utama ── --}}
        <table class="main-table">
            <thead>
                <tr>
                    <th class="text-center" style="width:4%;">No</th>
                    <th style="width:9%;">ID Order</th>
                    <th style="width:18%;">Nama Hotel</th>
                    <th style="width:13%;">Waktu Input</th>
                    <th class="text-center" style="width:6%;">Kamar</th>
                    <th style="width:33%;">Rincian Linen per Kamar</th>
                    <th class="text-center" style="width:9%;">Grand Total</th>
                    <th class="text-center" style="width:8%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $index => $transaction)
                    @php
                        $roomGroups = $transaction->details->groupBy('no_room');
                    @endphp
                    <tr>
                        <td class="text-center">
                            <div class="cell-pad">{{ $index + 1 }}</div>
                        </td>
                        <td>
                            <div class="cell-pad font-bold">#{{ $transaction->transaction_id }}</div>
                        </td>
                        <td>
                            <div class="cell-pad font-bold">{{ $transaction->user->hotel->nama_hotel }}</div>
                        </td>
                        <td>
                            <div class="cell-pad">
                                {{ $transaction->tgl_transaksi->format('d/m/Y') }}<br>
                                <span
                                    style="color:#6861CE; font-weight:700;">{{ $transaction->tgl_transaksi->format('H:i') }}
                                    WIB</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="cell-pad font-bold">{{ $roomGroups->count() }}</div>
                        </td>

                        {{-- Kolom Rincian per Kamar --}}
                        <td style="padding: 6px;">
                            @foreach ($roomGroups as $noRoom => $details)
                                <div class="room-block">
                                    <div class="room-block-header">
                                        <span class="rh-left">&#128682; Kamar {{ $noRoom }}</span>
                                        <span class="rh-right">{{ $details->sum('qty') }} item</span>
                                    </div>
                                    <div class="room-block-body">
                                        @foreach ($details as $detail)
                                            <div class="linen-line">
                                                <span class="ll-name">{{ $detail->linen->nama_linen }}</span>
                                                <span class="ll-qty">{{ $detail->qty }}</span>
                                                <span class="ll-sat">{{ $detail->linen->satuan }}</span>
                                            </div>
                                        @endforeach
                                        <div class="room-subtotal">
                                            <span class="rs-label">Subtotal Kamar {{ $noRoom }}</span>
                                            <span class="rs-val">{{ $details->sum('qty') }} pcs</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </td>

                        {{-- Grand Total per transaksi --}}
                        <td>
                            <div class="grand-total-cell">
                                {{ $transaction->total_qty }}<br>
                                <span style="font-size:8px; font-weight:400; opacity:0.8;">pcs</span>
                            </div>
                        </td>

                        {{-- Status --}}
                        <td class="text-center">
                            <div class="cell-pad">
                                @if ($transaction->status == 'Pending')
                                    <span class="badge-status badge-pending">Pending</span>
                                @elseif($transaction->status == 'Dijemput')
                                    <span class="badge-status badge-dijemput">Dijemput</span>
                                @elseif($transaction->status == 'Proses')
                                    <span class="badge-status badge-proses">Proses</span>
                                @elseif($transaction->status == 'Selesai')
                                    <span class="badge-status badge-selesai">Selesai</span>
                                @elseif($transaction->status == 'Diantar')
                                    <span class="badge-status badge-diantar">Diantar</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="tfoot-row">
                    <td colspan="4" class="text-right">&#128197; GRAND TOTAL KESELURUHAN PERIODE</td>
                    <td class="text-center">{{ $totalKamar }} kamar</td>
                    <td class="text-center">{{ $transactions->count() }} transaksi</td>
                    <td class="text-center" style="font-size:13px !important;">{{ $totalItem }} pcs</td>
                    <td class="text-center">{{ $totalSelesai }}/{{ $transactions->count() }}</td>
                </tr>
            </tfoot>
        </table>

        {{-- ── Ringkasan Eksekutif ── --}}
        <div class="exec-summary">
            <h4>Ringkasan Eksekutif</h4>
            <table class="exec-table">
                <tr>
                    <td style="width:30%;">Total Transaksi Periode Ini</td>
                    <td style="width:2%;">:</td>
                    <td style="width:18%;" class="font-bold">{{ $transactions->count() }} Order</td>
                    <td style="width:30%;">Total Kamar yang Dilayani</td>
                    <td style="width:2%;">:</td>
                    <td class="font-bold">{{ $totalKamar }} Kamar</td>
                </tr>
                <tr>
                    <td>Total Beban Cucian (Linen)</td>
                    <td>:</td>
                    <td class="font-bold">{{ $totalItem }} Item (Pcs)</td>
                    <td>Transaksi Selesai / Diantar</td>
                    <td>:</td>
                    <td class="font-bold">{{ $totalSelesai }} Order</td>
                </tr>
                <tr>
                    <td>Transaksi Masih Diproses</td>
                    <td>:</td>
                    <td class="font-bold">
                        {{ $transactions->whereIn('status', ['Pending', 'Dijemput', 'Proses'])->count() }} Order</td>
                    <td>Rata-rata Item per Transaksi</td>
                    <td>:</td>
                    <td class="font-bold">
                        {{ $transactions->count() > 0 ? round($totalItem / $transactions->count(), 1) : 0 }} pcs
                    </td>
                </tr>
            </table>
        </div>

    @endif

    {{-- ── Footer Dokumen ── --}}
    <div class="doc-footer">
        <p>* Laporan ini menggunakan algoritma antrean <strong>First Come First Served (FCFS)</strong> — transaksi
            diurutkan berdasarkan waktu masuk.</p>
        <p>* Dokumen digenerate secara otomatis oleh Sistem Manajemen Laundry RedDoorz.</p>
    </div>

</body>

</html>
