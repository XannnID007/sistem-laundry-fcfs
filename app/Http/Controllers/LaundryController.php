<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class LaundryController extends Controller
{
    public function dashboard()
    {
        $totalTransactions = Transaction::count();
        $pendingTransactions = Transaction::where('status', 'Pending')->count();
        $prosesTransactions = Transaction::whereIn('status', ['Dijemput', 'Proses'])->count();
        $selesaiTransactions = Transaction::where('status', 'Selesai')->count();

        return view('laundry.dashboard', compact('totalTransactions', 'pendingTransactions', 'prosesTransactions', 'selesaiTransactions'));
    }

    // IMPLEMENTASI ALGORITMA FCFS
    public function queueIndex()
    {
        $transactions = Transaction::with(['user.hotel', 'details.linen'])
            ->whereIn('status', ['Pending', 'Dijemput', 'Proses'])
            ->fcfsOrder()
            ->get();

        return view('laundry.queue.index', compact('transactions'));
    }

    public function transactionShow($id)
    {
        $transaction = Transaction::with(['user.hotel', 'details.linen'])
            ->findOrFail($id);

        return view('laundry.transactions.show', compact('transaction'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Dijemput,Proses,Selesai,Diantar',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->status = $request->status;
        $transaction->save();

        return redirect()->back()->with('success', 'Status berhasil diupdate');
    }

    public function allTransactions()
    {
        $transactions = Transaction::with(['user.hotel', 'details.linen'])
            ->orderBy('tgl_transaksi', 'desc')
            ->get();

        return view('laundry.transactions.index', compact('transactions'));
    }

    // ─── Laporan Laundry (semua transaksi) ────────────────────────────────────

    public function laporanIndex()
    {
        return view('laundry.laporan.index');
    }

    public function laporanGenerate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        $query = Transaction::with(['user.hotel', 'details.linen'])
            ->whereDate('tgl_transaksi', '>=', $request->start_date)
            ->whereDate('tgl_transaksi', '<=', $request->end_date)
            ->fcfsOrder();

        // Filter opsional berdasarkan status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $transactions = $query->get();

        return view('laundry.laporan.result', compact('transactions', 'request'));
    }

    public function laporanPdf(Request $request)
    {
        $query = Transaction::with(['user.hotel', 'details.linen'])
            ->whereDate('tgl_transaksi', '>=', $request->start_date)
            ->whereDate('tgl_transaksi', '<=', $request->end_date)
            ->fcfsOrder();

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $transactions = $query->get();

        $pdf = Pdf::loadView('laundry.laporan.pdf', compact('transactions', 'request'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-laundry-operasional-' . date('Y-m-d') . '.pdf');
    }
}
