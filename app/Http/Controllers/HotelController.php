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
            'rooms'                     => 'required|array|min:1',
            'rooms.*.no_room'           => 'required|string|max:20',
            'rooms.*.linens'            => 'required|array',
            'rooms.*.linens.*.linen_id' => 'required|exists:linens,linen_id',
            'rooms.*.linens.*.qty'      => 'required|integer|min:0',
        ]);

        // Pastikan minimal ada 1 item qty > 0 di seluruh room
        $totalQtyAll = 0;
        foreach ($request->rooms as $room) {
            foreach ($room['linens'] as $linen) {
                $totalQtyAll += (int) $linen['qty'];
            }
        }

        if ($totalQtyAll === 0) {
            return back()->with('error', 'Harap isi minimal satu item linen dengan jumlah lebih dari 0.');
        }

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id'       => Auth::id(),
                'tgl_transaksi' => now(),
                'status'        => 'Pending',
                'total_qty'     => $totalQtyAll,
            ]);

            foreach ($request->rooms as $room) {
                $noRoom = trim($room['no_room']);
                foreach ($room['linens'] as $linen) {
                    $qty = (int) $linen['qty'];
                    if ($qty > 0) {
                        TransactionDetail::create([
                            'transaction_id' => $transaction->transaction_id,
                            'linen_id'       => $linen['linen_id'],
                            'no_room'        => $noRoom,
                            'qty'            => $qty,
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('hotel.transactions.index')->with('success', 'Transaksi berhasil disimpan.');
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

        // Kelompokkan detail berdasarkan no_room & hitung total per room
        $roomGroups = $transaction->details->groupBy('no_room')->map(function ($items) {
            return [
                'details'   => $items,
                'total_qty' => $items->sum('qty'),
            ];
        });

        return view('hotel.transactions.show', compact('transaction', 'roomGroups'));
    }
}
