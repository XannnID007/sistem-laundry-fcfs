<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Linen;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class ManajerController extends Controller
{
    public function dashboard()
    {
        $totalHotels = Hotel::count();
        $totalUsers = User::count();
        $totalLinens = Linen::count();
        $totalTransactions = Transaction::count();

        return view('manajer.dashboard', compact('totalHotels', 'totalUsers', 'totalLinens', 'totalTransactions'));
    }

    // User Management
    public function userIndex()
    {
        $users = User::with('hotel')->get();
        return view('manajer.users.index', compact('users'));
    }

    public function userCreate()
    {
        $hotels = Hotel::all();
        return view('manajer.users.create', compact('hotels'));
    }

    public function userStore(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|max:50',
            'password' => 'required|min:6',
            'role' => 'required|in:Manajer,Hotel,Laundry',
            'hotel_id' => 'required_if:role,Hotel',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'hotel_id' => $request->role === 'Hotel' ? $request->hotel_id : null,
        ]);

        return redirect()->route('manajer.users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function userEdit($id)
    {
        $user = User::findOrFail($id);
        $hotels = Hotel::all();
        return view('manajer.users.edit', compact('user', 'hotels'));
    }

    public function userUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|max:50|unique:users,username,' . $id . ',user_id',
            'role' => 'required|in:Manajer,Hotel,Laundry',
            'hotel_id' => 'required_if:role,Hotel',
        ]);

        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->hotel_id = $request->role === 'Hotel' ? $request->hotel_id : null;
        $user->save();

        return redirect()->route('manajer.users.index')->with('success', 'User berhasil diupdate');
    }

    public function userDestroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('manajer.users.index')->with('success', 'User berhasil dihapus');
    }

    // Hotel Management
    public function hotelIndex()
    {
        $hotels = Hotel::all();
        return view('manajer.hotels.index', compact('hotels'));
    }

    public function hotelCreate()
    {
        return view('manajer.hotels.create');
    }

    public function hotelStore(Request $request)
    {
        $request->validate([
            'nama_hotel' => 'required|max:100',
            'alamat' => 'required',
        ]);

        Hotel::create($request->all());
        return redirect()->route('manajer.hotels.index')->with('success', 'Hotel berhasil ditambahkan');
    }

    public function hotelEdit($id)
    {
        $hotel = Hotel::findOrFail($id);
        return view('manajer.hotels.edit', compact('hotel'));
    }

    public function hotelUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_hotel' => 'required|max:100',
            'alamat' => 'required',
        ]);

        $hotel = Hotel::findOrFail($id);
        $hotel->update($request->all());
        return redirect()->route('manajer.hotels.index')->with('success', 'Hotel berhasil diupdate');
    }

    public function hotelDestroy($id)
    {
        Hotel::findOrFail($id)->delete();
        return redirect()->route('manajer.hotels.index')->with('success', 'Hotel berhasil dihapus');
    }

    // Linen Management
    public function linenIndex()
    {
        $linens = Linen::all();
        return view('manajer.linens.index', compact('linens'));
    }

    public function linenCreate()
    {
        return view('manajer.linens.create');
    }

    public function linenStore(Request $request)
    {
        $request->validate([
            'nama_linen' => 'required|max:50',
            'satuan' => 'required|max:20',
        ]);

        Linen::create($request->all());
        return redirect()->route('manajer.linens.index')->with('success', 'Jenis linen berhasil ditambahkan');
    }

    public function linenEdit($id)
    {
        $linen = Linen::findOrFail($id);
        return view('manajer.linens.edit', compact('linen'));
    }

    public function linenUpdate(Request $request, $id)
    {
        $request->validate([
            'nama_linen' => 'required|max:50',
            'satuan' => 'required|max:20',
        ]);

        $linen = Linen::findOrFail($id);
        $linen->update($request->all());
        return redirect()->route('manajer.linens.index')->with('success', 'Jenis linen berhasil diupdate');
    }

    public function linenDestroy($id)
    {
        Linen::findOrFail($id)->delete();
        return redirect()->route('manajer.linens.index')->with('success', 'Jenis linen berhasil dihapus');
    }

    // Laporan
    // Laporan
    public function laporanIndex()
    {
        return view('manajer.laporan.index');
    }

    public function laporanGenerate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // PERBAIKAN: Gunakan whereDate agar membandingkan bagian tanggalnya saja, mengabaikan jamnya.
        $transactions = Transaction::with(['user.hotel', 'details.linen'])
            ->whereDate('tgl_transaksi', '>=', $request->start_date)
            ->whereDate('tgl_transaksi', '<=', $request->end_date)
            ->fcfsOrder()
            ->get();

        return view('manajer.laporan.result', compact('transactions', 'request'));
    }

    public function laporanPdf(Request $request)
    {
        // PERBAIKAN SAMA SEPERTI DI ATAS
        $transactions = Transaction::with(['user.hotel', 'details.linen'])
            ->whereDate('tgl_transaksi', '>=', $request->start_date)
            ->whereDate('tgl_transaksi', '<=', $request->end_date)
            ->fcfsOrder()
            ->get();

        $pdf = Pdf::loadView('manajer.laporan.pdf', compact('transactions', 'request'));
        // Opsional: Bikin tampilannya lanskap kalau tabelnya panjang
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-laundry-' . date('Y-m-d') . '.pdf');
    }
}
