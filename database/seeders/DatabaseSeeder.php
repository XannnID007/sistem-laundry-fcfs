<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Hotels
        DB::table('hotels')->insert([
            [
                'nama_hotel' => 'RedDoorz @ Dago',
                'alamat' => 'Jl. Ir. H. Djuanda No. 15, Dago, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hotel' => 'RedDoorz @ Riau',
                'alamat' => 'Jl. Riau No. 88, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_hotel' => 'RedDoorz @ Pasir Kaliki',
                'alamat' => 'Jl. Pasir Kaliki No. 142, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Users
        DB::table('users')->insert([
            [
                'username' => 'manajer',
                'password' => Hash::make('manajer123'),
                'role' => 'Manajer',
                'hotel_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'hotel_dago',
                'password' => Hash::make('hotel123'),
                'role' => 'Hotel',
                'hotel_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'hotel_riau',
                'password' => Hash::make('hotel123'),
                'role' => 'Hotel',
                'hotel_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'laundry',
                'password' => Hash::make('laundry123'),
                'role' => 'Laundry',
                'hotel_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Seed Linens
        DB::table('linens')->insert([
            [
                'nama_linen' => 'Sprei Single',
                'satuan' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_linen' => 'Sprei Double',
                'satuan' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_linen' => 'Handuk Kecil',
                'satuan' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_linen' => 'Handuk Besar',
                'satuan' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_linen' => 'Selimut',
                'satuan' => 'Pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
