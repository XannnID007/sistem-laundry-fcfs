<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Linen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $totalTransactions = Transaction::where('user_id', $user->user_id)->count();
        $pendingTransactions = Transaction::where('user_id', $user->user_id)->where('status', 'Pending')->count();
        $prosesTransactions = Transaction::where('user_id', $user->user_id)->where('status', 'Proses')->count();
        $selesaiTransactions = Transaction::where('user_id', $user->user_id)->where('status', 'Selesai')->count();

        return view('hotel.dashboard', compact('totalTransactions', 'pendingTransactions', 'prosesTransactions', 'selesaiTransactions'));
    }

    public function transactionIndex()
    {
        $user = Auth::user();
        $transactions = Transaction::with(['details.linen'])
            ->where('user_id', $user->user_id)
            ->orderBy('tgl_transaksi', 'desc')
            ->get();

        return view('hotel.transactions.index', compact('transactions'));
    }

    public function transactionCreate()
    {
        $linens = Linen::all();
        return view('hotel.transactions.create', compact('linens'));
    }

    public function transactionStore(Request $request)
    {
        $request->validate([
            'linens' => 'required|array',
            'linens.*.linen_id' => 'required|exists:linens,linen_id',
            'linens.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Hitung total qty
            $totalQty = array_sum(array_column($request->linens, 'qty'));

            // Buat transaksi dengan timestamp saat ini (KUNCI ALGORITMA FCFS)
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'tgl_transaksi' => now(), // Timestamp penting untuk FCFS
                'status' => 'Pending',
                'total_qty' => $totalQty,
            ]);

            // Simpan detail transaksi
            foreach ($request->linens as $linen) {
                if ($linen['qty'] > 0) {
                    TransactionDetail::create([
                        'transaction_id' => $transaction->transaction_id,
                        'linen_id' => $linen['linen_id'],
                        'qty' => $linen['qty'],
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('hotel.transactions.index')->with('success', 'Transaksi berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function transactionShow($id)
    {
        $transaction = Transaction::with(['details.linen', 'user.hotel'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('hotel.transactions.show', compact('transaction'));
    }
}
