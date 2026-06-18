<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Hotels ──────────────────────────────────────────────
        DB::table('hotels')->insert([
            [
                'nama_hotel' => 'RedDoorz Dipatiukur',
                'alamat'     => 'Jl. Dipatiukur No. 1, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hotel' => 'RedDoorz Dago Home 1',
                'alamat'     => 'Jl. Ir. H. Djuanda No. 10, Dago, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hotel' => 'RedDoorz Dago Home 2',
                'alamat'     => 'Jl. Ir. H. Djuanda No. 20, Dago, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hotel' => 'RedDoorz Istana Surapati Core',
                'alamat'     => 'Jl. Surapati No. 45, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hotel' => 'Hotel Sans Surapati Konforta',
                'alamat'     => 'Jl. Surapati No. 88, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ── Users ────────────────────────────────────────────────
        DB::table('users')->insert([
            [
                'username'   => 'manajer',
                'password'   => Hash::make('manajer123'),
                'role'       => 'Manajer',
                'hotel_id'   => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'laundry',
                'password'   => Hash::make('laundry123'),
                'role'       => 'Laundry',
                'hotel_id'   => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'hotel_dipatiukur',
                'password'   => Hash::make('hotel123'),
                'role'       => 'Hotel',
                'hotel_id'   => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'hotel_dago1',
                'password'   => Hash::make('hotel123'),
                'role'       => 'Hotel',
                'hotel_id'   => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'hotel_dago2',
                'password'   => Hash::make('hotel123'),
                'role'       => 'Hotel',
                'hotel_id'   => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'hotel_surapati',
                'password'   => Hash::make('hotel123'),
                'role'       => 'Hotel',
                'hotel_id'   => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'hotel_sans',
                'password'   => Hash::make('hotel123'),
                'role'       => 'Hotel',
                'hotel_id'   => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // ── Linens ───────────────────────────────────────────────
        // ID: 1=Sprei, 2=Sarban, 3=Duve, 4=Handuk, 5=Keset
        DB::table('linens')->insert([
            ['nama_linen' => 'Sprei',  'satuan' => 'Pcs', 'created_at' => now(), 'updated_at' => now()],
            ['nama_linen' => 'Sarban', 'satuan' => 'Pcs', 'created_at' => now(), 'updated_at' => now()],
            ['nama_linen' => 'Duve',   'satuan' => 'Pcs', 'created_at' => now(), 'updated_at' => now()],
            ['nama_linen' => 'Handuk', 'satuan' => 'Pcs', 'created_at' => now(), 'updated_at' => now()],
            ['nama_linen' => 'Keset',  'satuan' => 'Pcs', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // ── Transaksi ────────────────────────────────────────────
        // Struktur rooms.items: [linen_id, qty]
        // User IDs: 3=dipatiukur, 4=dago1, 5=dago2, 6=surapati, 7=sans
        $transactions = [

            // ===================================================
            // 6 HARI LALU — Status: Diantar
            // ===================================================
            [
                'user_id'       => 3,
                'tgl_transaksi' => Carbon::now()->subDays(6)->setTime(7, 15, 0),
                'status'        => 'Diantar',
                'total_qty'     => 14,
                'rooms'         => [
                    ['no_room' => '101', 'items' => [[1, 2], [2, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '102', 'items' => [[1, 1], [3, 1], [4, 2], [5, 1]]],  // 5
                    ['no_room' => '105', 'items' => [[1, 1], [2, 1], [5, 1]]],        // 3
                ],
            ],
            [
                'user_id'       => 4,
                'tgl_transaksi' => Carbon::now()->subDays(6)->setTime(8, 40, 0),
                'status'        => 'Diantar',
                'total_qty'     => 13,
                'rooms'         => [
                    ['no_room' => '201', 'items' => [[1, 2], [2, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '204', 'items' => [[1, 2], [3, 1], [4, 2], [5, 2]]],  // 7
                ],
            ],

            // ===================================================
            // 5 HARI LALU — Status: Diantar & Selesai
            // ===================================================
            [
                'user_id'       => 5,
                'tgl_transaksi' => Carbon::now()->subDays(5)->setTime(7, 0, 0),
                'status'        => 'Diantar',
                'total_qty'     => 16,
                'rooms'         => [
                    ['no_room' => '301', 'items' => [[1, 2], [2, 2], [3, 1], [4, 2]]],  // 7
                    ['no_room' => '305', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '308', 'items' => [[2, 1], [4, 2], [5, 1]]],        // 4
                ],
            ],
            [
                'user_id'       => 6,
                'tgl_transaksi' => Carbon::now()->subDays(5)->setTime(8, 30, 0),
                'status'        => 'Selesai',
                'total_qty'     => 18,
                'rooms'         => [
                    ['no_room' => '401', 'items' => [[1, 2], [2, 2], [3, 1], [4, 2], [5, 1]]],  // 8
                    ['no_room' => '403', 'items' => [[1, 2], [3, 1], [4, 2]]],              // 5
                    ['no_room' => '410', 'items' => [[1, 1], [2, 1], [4, 2], [5, 1]]],        // 5
                ],
            ],
            [
                'user_id'       => 7,
                'tgl_transaksi' => Carbon::now()->subDays(5)->setTime(10, 20, 0),
                'status'        => 'Selesai',
                'total_qty'     => 10,
                'rooms'         => [
                    ['no_room' => '501', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '503', 'items' => [[1, 1], [3, 1], [4, 2], [5, 1]]],  // 5
                ],
            ],

            // ===================================================
            // 4 HARI LALU — Status: Diantar & Selesai
            // ===================================================
            [
                'user_id'       => 3,
                'tgl_transaksi' => Carbon::now()->subDays(4)->setTime(7, 50, 0),
                'status'        => 'Selesai',
                'total_qty'     => 15,
                'rooms'         => [
                    ['no_room' => '103', 'items' => [[1, 2], [2, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '106', 'items' => [[1, 2], [3, 2], [4, 2]]],        // 6
                    ['no_room' => '108', 'items' => [[2, 1], [4, 1], [5, 1]]],        // 3
                ],
            ],
            [
                'user_id'       => 4,
                'tgl_transaksi' => Carbon::now()->subDays(4)->setTime(9, 10, 0),
                'status'        => 'Diantar',
                'total_qty'     => 11,
                'rooms'         => [
                    ['no_room' => '202', 'items' => [[1, 2], [3, 1], [4, 2]]],        // 5
                    ['no_room' => '206', 'items' => [[1, 1], [2, 2], [4, 2], [5, 1]]],  // 6
                ],
            ],
            [
                'user_id'       => 5,
                'tgl_transaksi' => Carbon::now()->subDays(4)->setTime(11, 0, 0),
                'status'        => 'Diantar',
                'total_qty'     => 12,
                'rooms'         => [
                    ['no_room' => '302', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '306', 'items' => [[1, 2], [2, 1], [3, 1], [4, 2]]],  // 6
                    ['no_room' => '309', 'items' => [[4, 1], [5, 0]]],              // 1
                ],
            ],

            // ===================================================
            // 3 HARI LALU — Status: Selesai & Proses
            // ===================================================
            [
                'user_id'       => 6,
                'tgl_transaksi' => Carbon::now()->subDays(3)->setTime(7, 5, 0),
                'status'        => 'Selesai',
                'total_qty'     => 14,
                'rooms'         => [
                    ['no_room' => '402', 'items' => [[1, 2], [2, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '405', 'items' => [[1, 1], [3, 2], [4, 2]]],        // 5
                    ['no_room' => '411', 'items' => [[4, 2], [5, 1]]],              // 3
                ],
            ],
            [
                'user_id'       => 7,
                'tgl_transaksi' => Carbon::now()->subDays(3)->setTime(8, 30, 0),
                'status'        => 'Selesai',
                'total_qty'     => 9,
                'rooms'         => [
                    ['no_room' => '502', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '506', 'items' => [[2, 1], [3, 1], [5, 2]]],        // 4
                ],
            ],

            // ===================================================
            // 2 HARI LALU — Status: Proses
            // ===================================================
            [
                'user_id'       => 3,
                'tgl_transaksi' => Carbon::now()->subDays(2)->setTime(7, 20, 0),
                'status'        => 'Proses',
                'total_qty'     => 17,
                'rooms'         => [
                    ['no_room' => '104', 'items' => [[1, 2], [2, 2], [3, 1], [4, 2]]],       // 7
                    ['no_room' => '107', 'items' => [[1, 2], [4, 2], [5, 1]]],             // 5
                    ['no_room' => '109', 'items' => [[1, 1], [3, 1], [4, 2], [5, 1]]],       // 5
                ],
            ],
            [
                'user_id'       => 4,
                'tgl_transaksi' => Carbon::now()->subDays(2)->setTime(9, 0, 0),
                'status'        => 'Proses',
                'total_qty'     => 13,
                'rooms'         => [
                    ['no_room' => '203', 'items' => [[1, 2], [2, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '207', 'items' => [[1, 1], [3, 2], [4, 2], [5, 2]]],  // 7
                ],
            ],
            [
                'user_id'       => 5,
                'tgl_transaksi' => Carbon::now()->subDays(2)->setTime(10, 45, 0),
                'status'        => 'Proses',
                'total_qty'     => 14,
                'rooms'         => [
                    ['no_room' => '303', 'items' => [[1, 2], [2, 1], [3, 1], [4, 2]]],  // 6
                    ['no_room' => '307', 'items' => [[1, 2], [4, 2], [5, 2]]],        // 6
                    ['no_room' => '310', 'items' => [[4, 1], [5, 1]]],              // 2
                ],
            ],

            // ===================================================
            // 1 HARI LALU — Status: Dijemput
            // ===================================================
            [
                'user_id'       => 6,
                'tgl_transaksi' => Carbon::now()->subDays(1)->setTime(7, 0, 0),
                'status'        => 'Dijemput',
                'total_qty'     => 16,
                'rooms'         => [
                    ['no_room' => '403', 'items' => [[1, 2], [2, 2], [3, 1], [4, 2]]],  // 7
                    ['no_room' => '406', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '412', 'items' => [[2, 1], [4, 2], [5, 1]]],        // 4
                ],
            ],
            [
                'user_id'       => 7,
                'tgl_transaksi' => Carbon::now()->subDays(1)->setTime(8, 15, 0),
                'status'        => 'Dijemput',
                'total_qty'     => 14,
                'rooms'         => [
                    ['no_room' => '503', 'items' => [[1, 2], [3, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '507', 'items' => [[1, 2], [2, 2], [4, 2]]],        // 6
                    ['no_room' => '509', 'items' => [[4, 1], [5, 1]]],              // 2
                ],
            ],
            [
                'user_id'       => 3,
                'tgl_transaksi' => Carbon::now()->subDays(1)->setTime(9, 30, 0),
                'status'        => 'Dijemput',
                'total_qty'     => 12,
                'rooms'         => [
                    ['no_room' => '110', 'items' => [[1, 2], [2, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '112', 'items' => [[1, 2], [3, 1], [4, 2], [5, 1]]],  // 6
                ],
            ],

            // ===================================================
            // HARI INI — Status: Pending (urutan FCFS)
            // ===================================================
            [
                'user_id'       => 4, // masuk paling pagi → PRIORITAS UTAMA
                'tgl_transaksi' => Carbon::now()->setTime(7, 5, 0),
                'status'        => 'Pending',
                'total_qty'     => 12,
                'rooms'         => [
                    ['no_room' => '205', 'items' => [[1, 2], [3, 1], [4, 2], [5, 1]]],  // 6
                    ['no_room' => '208', 'items' => [[1, 2], [2, 2], [4, 2]]],        // 6
                ],
            ],
            [
                'user_id'       => 5,
                'tgl_transaksi' => Carbon::now()->setTime(7, 45, 0),
                'status'        => 'Pending',
                'total_qty'     => 15,
                'rooms'         => [
                    ['no_room' => '304', 'items' => [[1, 2], [2, 1], [3, 1], [4, 2]]],  // 6
                    ['no_room' => '308', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '311', 'items' => [[2, 1], [4, 2], [5, 1]]],        // 4
                ],
            ],
            [
                'user_id'       => 6,
                'tgl_transaksi' => Carbon::now()->setTime(8, 20, 0),
                'status'        => 'Pending',
                'total_qty'     => 11,
                'rooms'         => [
                    ['no_room' => '407', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '408', 'items' => [[1, 1], [2, 2], [4, 2]]],        // 5
                    ['no_room' => '413', 'items' => [[3, 1], [5, 0]]],              // 1
                ],
            ],
            [
                'user_id'       => 7, // masuk paling terakhir → antri paling belakang
                'tgl_transaksi' => Carbon::now()->setTime(9, 10, 0),
                'status'        => 'Pending',
                'total_qty'     => 9,
                'rooms'         => [
                    ['no_room' => '504', 'items' => [[1, 2], [4, 2], [5, 1]]],        // 5
                    ['no_room' => '508', 'items' => [[2, 1], [3, 1], [4, 2]]],        // 4
                ],
            ],
        ];

        // Insert transactions & details
        foreach ($transactions as $trx) {
            $transactionId = DB::table('transactions')->insertGetId([
                'user_id'       => $trx['user_id'],
                'tgl_transaksi' => $trx['tgl_transaksi'],
                'status'        => $trx['status'],
                'total_qty'     => $trx['total_qty'],
                'created_at'    => $trx['tgl_transaksi'],
                'updated_at'    => $trx['tgl_transaksi'],
            ]);

            foreach ($trx['rooms'] as $room) {
                foreach ($room['items'] as [$linenId, $qty]) {
                    if ($qty > 0) {
                        DB::table('transaction_details')->insert([
                            'transaction_id' => $transactionId,
                            'linen_id'       => $linenId,
                            'no_room'        => $room['no_room'],
                            'qty'            => $qty,
                            'created_at'     => $trx['tgl_transaksi'],
                            'updated_at'     => $trx['tgl_transaksi'],
                        ]);
                    }
                }
            }
        }
    }
}
