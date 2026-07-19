<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Operasional Laundry</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #000;
            padding: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #000;
        }

        .header h1 {
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .header h2 {
            font-size: 11px;
            font-weight: normal;
            margin-bottom: 8px;
        }

        .header p {
            font-size: 10px;
            margin: 2px 0;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            font-size: 10.5px;
        }

        .info-table td {
            padding: 3px 0;
        }

        .info-table .k {
            width: 30%;
        }

        .info-table .s {
            width: 2%;
        }

        .info-table .v {
            font-weight: bold;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            font-size: 10.5px;
        }

        table.data th {
            border: 1px solid #000;
            padding: 6px 7px;
            background: #e8e8e8;
            font-weight: bold;
            text-align: center;
        }

        table.data td {
            border: 1px solid #aaa;
            padding: 0;
            vertical-align: top;
        }

        table.data tr:nth-child(even) td .c {
            background: #f5f5f5;
        }

        .c {
            padding: 6px 7px;
        }

        .room {
            border-bottom: 1px dashed #ccc;
        }

        .room:last-child {
            border-bottom: none;
        }

        .room-head {
            background: #e0e0e0;
            padding: 3px 7px;
            font-weight: bold;
            font-size: 10px;
            display: table;
            width: 100%;
        }

        .rh-l {
            display: table-cell;
        }

        .rh-r {
            display: table-cell;
            text-align: right;
            font-weight: normal;
            color: #555;
        }

        .linen {
            display: table;
            width: 100%;
            padding: 2px 7px;
        }

        .li-n {
            display: table-cell;
            font-size: 10px;
        }

        .li-q {
            display: table-cell;
            width: 30px;
            text-align: right;
            font-weight: bold;
            font-size: 10px;
        }

        .li-s {
            display: table-cell;
            width: 30px;
            text-align: right;
            font-size: 9px;
            color: #666;
        }

        .room-sub {
            padding: 2px 7px;
            text-align: right;
            font-size: 9px;
            color: #555;
            border-top: 1px solid #ddd;
            background: #fafafa;
        }

        .col-total {
            background: #e8e8e8;
            text-align: center;
            font-weight: bold;
            padding: 6px 7px;
            font-size: 12px;
        }

        .row-total td {
            background: #ccc !important;
            font-weight: bold !important;
            border: 1px solid #aaa !important;
            padding: 7px !important;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #000;
            display: table;
            width: 100%;
            font-size: 9.5px;
            color: #555;
        }

        .footer-l {
            display: table-cell;
        }

        .footer-r {
            display: table-cell;
            text-align: right;
        }

        .tc {
            text-align: center;
        }

        .tr {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Laporan Operasional Laundry</h1>
        <h2>RedDoorz Laundry Management System</h2>
        <p>Periode: {{ date('d F Y', strtotime($request->start_date)) }} s/d
            {{ date('d F Y', strtotime($request->end_date)) }}</p>
        @if ($request->filled('status') && $request->status !== 'all')
            <p>Filter Status: {{ $request->status }}</p>
        @endif
        <p>Dicetak: {{ date('d F Y, H:i') }} &nbsp;|&nbsp; Sistem Antrean: FCFS</p>
    </div>

    @if ($transactions->isEmpty())
        <p style="text-align:center; padding:40px; color:#999;">Tidak ada data transaksi pada periode ini.</p>
    @else
        @php
            $tKamar = $transactions->sum(fn($t) => $t->details->pluck('no_room')->unique()->count());
            $tItem = $transactions->sum('total_qty');
            $tSelesai = $transactions->whereIn('status', ['Selesai', 'Diantar'])->count();
            $tHotel = $transactions->pluck('user.hotel.nama_hotel')->unique()->count();
        @endphp

        <table class="info-table">
            <tr>
                <td class="k">Total Transaksi</td>
                <td class="s">:</td>
                <td class="v">{{ $transactions->count() }} transaksi</td>
                <td class="k" style="padding-left:20px;">Hotel Aktif</td>
                <td class="s">:</td>
                <td class="v">{{ $tHotel }} hotel</td>
            </tr>
            <tr>
                <td class="k">Total Item Linen</td>
                <td class="s">:</td>
                <td class="v">{{ $tItem }} pcs</td>
                <td class="k" style="padding-left:20px;">Selesai / Diantar</td>
                <td class="s">:</td>
                <td class="v">{{ $tSelesai }} dari {{ $transactions->count() }} transaksi</td>
            </tr>
        </table>

        <table class="data">
            <thead>
                <tr>
                    <th style="width:4%;">No</th>
                    <th style="width:8%;">ID</th>
                    <th style="width:16%;">Hotel</th>
                    <th style="width:13%;">Waktu Masuk</th>
                    <th style="width:5%;">Kamar</th>
                    <th style="width:36%;">Rincian Linen per Kamar</th>
                    <th style="width:9%;">Total</th>
                    <th style="width:9%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $i => $trx)
                    @php $roomGroups = $trx->details->groupBy('no_room'); @endphp
                    <tr>
                        <td class="tc">
                            <div class="c">{{ $i + 1 }}</div>
                        </td>
                        <td>
                            <div class="c">#{{ $trx->transaction_id }}</div>
                        </td>
                        <td>
                            <div class="c">{{ $trx->user->hotel->nama_hotel }}</div>
                        </td>
                        <td>
                            <div class="c">
                                {{ $trx->tgl_transaksi->format('d/m/Y') }}<br>{{ $trx->tgl_transaksi->format('H:i') }}
                                WIB</div>
                        </td>
                        <td class="tc">
                            <div class="c">{{ $roomGroups->count() }}</div>
                        </td>
                        <td style="padding: 4px;">
                            @foreach ($roomGroups as $noRoom => $details)
                                <div class="room">
                                    <div class="room-head"><span class="rh-l">Kamar {{ $noRoom }}</span><span
                                            class="rh-r">{{ $details->sum('qty') }} item</span></div>
                                    @foreach ($details as $d)
                                        <div class="linen"><span
                                                class="li-n">{{ $d->linen->nama_linen }}</span><span
                                                class="li-q">{{ $d->qty }}</span><span
                                                class="li-s">{{ $d->linen->satuan }}</span></div>
                                    @endforeach
                                    <div class="room-sub">Subtotal: {{ $details->sum('qty') }} pcs</div>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <div class="col-total">{{ $trx->total_qty }}<br><span
                                    style="font-size:9px;font-weight:normal;">pcs</span></div>
                        </td>
                        <td class="tc">
                            <div class="c">{{ $trx->status }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="row-total">
                    <td colspan="4" class="tr">Total Keseluruhan</td>
                    <td class="tc">{{ $tKamar }} kamar</td>
                    <td class="tc">{{ $transactions->count() }} transaksi</td>
                    <td class="tc">{{ $tItem }} pcs</td>
                    <td class="tc">{{ $tSelesai }}/{{ $transactions->count() }}</td>
                </tr>
            </tfoot>
        </table>
    @endif

    <div class="footer">
        <div class="footer-l">* Laporan seluruh hotel mitra — sistem FCFS RedDoorz Laundry.</div>
        <div class="footer-r">Dicetak: {{ date('d/m/Y H:i') }}</div>
    </div>

</body>

</html>
