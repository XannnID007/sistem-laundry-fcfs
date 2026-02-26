<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

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
        // Query dengan FCFS: ORDER BY tgl_transaksi ASC
        // Transaksi yang masuk lebih dulu akan ditampilkan di urutan teratas
        $transactions = Transaction::with(['user.hotel', 'details.linen'])
            ->whereIn('status', ['Pending', 'Dijemput', 'Proses'])
            ->fcfsOrder() // Menggunakan scope FCFS dari model
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
}
