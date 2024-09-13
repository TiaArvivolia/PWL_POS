<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Stok untuk Supplier 1
            [
                'stok_id' => 1,
                'supplier_id' => 1,
                'barang_id' => 1, // Beras Premium
                'user_id' => 1, // Administrator
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 100,
            ],
            [
                'stok_id' => 2,
                'supplier_id' => 1,
                'barang_id' => 2, // Mie Instan
                'user_id' => 2, // Manager
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 200,
            ],
            [
                'stok_id' => 3,
                'supplier_id' => 1,
                'barang_id' => 3, // Gula Pasir
                'user_id' => 3, // Staff/Kasir
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 150,
            ],
            [
                'stok_id' => 4,
                'supplier_id' => 1,
                'barang_id' => 4, // Air Mineral 600ml
                'user_id' => 1, // Administrator
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 300,
            ],
            [
                'stok_id' => 5,
                'supplier_id' => 1,
                'barang_id' => 5, // Teh Botol 500ml
                'user_id' => 2, // Manager
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 250,
            ],

            // Stok untuk Supplier 2
            [
                'stok_id' => 6,
                'supplier_id' => 2,
                'barang_id' => 6, // Keripik Singkong
                'user_id' => 3, // Staff/Kasir
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 80,
            ],
            [
                'stok_id' => 7,
                'supplier_id' => 2,
                'barang_id' => 7, // Kacang Garuda
                'user_id' => 1, // Administrator
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 70,
            ],
            [
                'stok_id' => 8,
                'supplier_id' => 2,
                'barang_id' => 8, // Cokelat Batang
                'user_id' => 2, // Manager
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 90,
            ],
            [
                'stok_id' => 9,
                'supplier_id' => 2,
                'barang_id' => 9, // Wafer
                'user_id' => 3, // Staff/Kasir
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 60,
            ],
            [
                'stok_id' => 10,
                'supplier_id' => 2,
                'barang_id' => 10, // Keripik Kentang
                'user_id' => 1, // Administrator
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 110,
            ],

            // Stok untuk Supplier 3
            [
                'stok_id' => 11,
                'supplier_id' => 3,
                'barang_id' => 11, // Lampu LED 12W
                'user_id' => 2, // Manager
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 50,
            ],
            [
                'stok_id' => 12,
                'supplier_id' => 3,
                'barang_id' => 12, // Kipas Angin Meja
                'user_id' => 3, // Staff/Kasir
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 30,
            ],
            [
                'stok_id' => 13,
                'supplier_id' => 3,
                'barang_id' => 13, // Setrika Listrik
                'user_id' => 1, // Administrator
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 20,
            ],
            [
                'stok_id' => 14,
                'supplier_id' => 3,
                'barang_id' => 14, // Kaos Polos
                'user_id' => 2, // Manager
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 100,
            ],
            [
                'stok_id' => 15,
                'supplier_id' => 3,
                'barang_id' => 15, // Sepatu Sneakers
                'user_id' => 3, // Staff/Kasir
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => 40,
            ],
        ];

        DB::table('t_stok')->insert($data);
    }
}
