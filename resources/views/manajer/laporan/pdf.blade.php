<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Transaksi Laundry RedDoorz</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        /* Header Laporan */
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #5C55BF;
        }

        .header h1 {
            font-size: 22px;
            margin: 0 0 5px 0;
            color: #1E293B;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 3px 0;
            color: #64748B;
            font-size: 11px;
        }

        /* Tabel Utama */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #6861CE;
            color: #ffffff;
            border: 1px solid #5C55BF;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        td {
            border: 1px solid #e2e8f0;
            padding: 10px 8px;
            text-align: left;
            font-size: 11px;
            vertical-align: middle;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center;
        }

        .font-bold {
            font-weight: bold;
        }

        /* Ringkasan */
        .summary-box {
            margin-top: 30px;
            padding: 15px;
            background-color: #f1f5f9;
            border-left: 5px solid #6861CE;
            border-radius: 4px;
        }

        .summary-title {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 14px;
            color: #1E293B;
        }

        .summary-table {
            width: 100%;
            border: none;
            margin-top: 0;
        }

        .summary-table td {
            border: none;
            padding: 5px 0;
            font-size: 12px;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 10px;
            border-top: 1px dashed #cbd5e1;
            text-align: left;
        }

        .footer p {
            margin: 2px 0;
            font-size: 9px;
            color: #94a3b8;
            font-style: italic;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>LAPORAN TRANSAKSI LAUNDRY REDDOORZ</h1>
        <p><strong>Periode:</strong> {{ date('d F Y', strtotime($request->start_date)) }} s/d
            {{ date('d F Y', strtotime($request->end_date)) }}</p>
        <p><strong>Waktu Cetak:</strong> {{ date('d F Y H:i:s') }}</p>
    </div>

    @if ($transactions->isEmpty())
        <div
            style="text-align: center; margin-top: 50px; color: #94a3b8; font-size: 14px; padding: 40px; border: 1px dashed #cbd5e1;">
            <p><strong>TIDAK ADA DATA TRANSAKSI</strong></p>
            <p>Belum ada aktivitas transaksi pada rentang periode yang Anda pilih.</p>
        </div>
    @else
        <table>
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="12%">ID Order</th>
                    <th width="28%">Nama Hotel</th>
                    <th width="20%">Waktu Input (FCFS)</th>
                    <th width="15%" class="text-center">Total Item</th>
                    <th width="20%" class="text-center">Status Akhir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $index => $transaction)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="font-bold">#{{ $transaction->transaction_id }}</td>
                        <td>{{ $transaction->user->hotel->nama_hotel }}</td>
                        <td>{{ $transaction->tgl_transaksi->format('d/m/Y, H:i') }}</td>
                        <td class="text-center font-bold">{{ $transaction->total_qty }} pcs</td>
                        <td class="text-center">
                            {{ strtoupper($transaction->status) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary-box" style="page-break-inside: avoid;">
            <h4 class="summary-title">Ringkasan Eksekutif</h4>
            <table class="summary-table">
                <tr>
                    <td width="30%">Total Transaksi Selama Periode</td>
                    <td width="2%">:</td>
                    <td width="18%" class="font-bold">{{ $transactions->count() }} Order</td>

                    <td width="30%">Transaksi Dalam Proses/Pending</td>
                    <td width="2%">:</td>
                    <td width="18%" class="font-bold">
                        {{ $transactions->whereIn('status', ['Pending', 'Dijemput', 'Proses'])->count() }} Order</td>
                </tr>
                <tr>
                    <td>Total Beban Cucian (Linen)</td>
                    <td>:</td>
                    <td class="font-bold">{{ $transactions->sum('total_qty') }} Item (Pcs)</td>

                    <td>Transaksi Telah Selesai/Diantar</td>
                    <td>:</td>
                    <td class="font-bold">{{ $transactions->whereIn('status', ['Selesai', 'Diantar'])->count() }} Order
                    </td>
                </tr>
            </table>
        </div>
    @endif

    <div class="footer">
        <p>* Laporan ini menggunakan algoritma antrean <strong>First Come First Served (FCFS)</strong>.</p>
        <p>* Dokumen ini digenerate secara otomatis oleh Sistem Manajemen Laundry RedDoorz secara Real-time.</p>
    </div>

</body>

</html>
