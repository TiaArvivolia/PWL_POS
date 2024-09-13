<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // Supplier 1 - PT. Sumber Makmur (Kategori Makanan dan Minuman)
            [
                'barang_id' => 1,
                'kategori_id' => 1, // Makanan
                'barang_kode' => 'FOOD001',
                'barang_nama' => 'Beras Premium',
                'harga_beli' => 50000,
                'harga_jual' => 55000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1, // Makanan
                'barang_kode' => 'FOOD002',
                'barang_nama' => 'Mie Instan',
                'harga_beli' => 2000,
                'harga_jual' => 2500,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1, // Makanan
                'barang_kode' => 'FOOD003',
                'barang_nama' => 'Gula Pasir',
                'harga_beli' => 13000,
                'harga_jual' => 15000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2, // Minuman
                'barang_kode' => 'DRINK001',
                'barang_nama' => 'Air Mineral 600ml',
                'harga_beli' => 3000,
                'harga_jual' => 3500,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 2, // Minuman
                'barang_kode' => 'DRINK002',
                'barang_nama' => 'Teh Botol 500ml',
                'harga_beli' => 4000,
                'harga_jual' => 5000,
            ],

            // Supplier 2 - CV. Maju Jaya (Kategori Camilan)
            [
                'barang_id' => 6,
                'kategori_id' => 3, // Camilan
                'barang_kode' => 'SNACK001',
                'barang_nama' => 'Keripik Singkong',
                'harga_beli' => 8000,
                'harga_jual' => 10000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 3, // Camilan
                'barang_kode' => 'SNACK002',
                'barang_nama' => 'Kacang Garuda',
                'harga_beli' => 6000,
                'harga_jual' => 7500,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 3, // Camilan
                'barang_kode' => 'SNACK003',
                'barang_nama' => 'Cokelat Batang',
                'harga_beli' => 5000,
                'harga_jual' => 6500,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 3, // Camilan
                'barang_kode' => 'SNACK004',
                'barang_nama' => 'Wafer',
                'harga_beli' => 7000,
                'harga_jual' => 8500,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 3, // Camilan
                'barang_kode' => 'SNACK005',
                'barang_nama' => 'Keripik Kentang',
                'harga_beli' => 9000,
                'harga_jual' => 11000,
            ],

            // Supplier 3 - UD. Toko Bersama (Kategori Elektronik dan Pakaian)
            [
                'barang_id' => 11,
                'kategori_id' => 4, // Elektronik
                'barang_kode' => 'ELEC001',
                'barang_nama' => 'Lampu LED 12W',
                'harga_beli' => 25000,
                'harga_jual' => 30000,
            ],
            [
                'barang_id' => 12,
                'kategori_id' => 4, // Elektronik
                'barang_kode' => 'ELEC002',
                'barang_nama' => 'Kipas Angin Meja',
                'harga_beli' => 100000,
                'harga_jual' => 120000,
            ],
            [
                'barang_id' => 13,
                'kategori_id' => 4, // Elektronik
                'barang_kode' => 'ELEC003',
                'barang_nama' => 'Setrika Listrik',
                'harga_beli' => 80000,
                'harga_jual' => 95000,
            ],
            [
                'barang_id' => 14,
                'kategori_id' => 5, // Pakaian
                'barang_kode' => 'APPAREL001',
                'barang_nama' => 'Kaos Polos',
                'harga_beli' => 50000,
                'harga_jual' => 60000,
            ],
            [
                'barang_id' => 15,
                'kategori_id' => 5, // Pakaian
                'barang_kode' => 'APPAREL002',
                'barang_nama' => 'Sepatu Sneakers',
                'harga_beli' => 250000,
                'harga_jual' => 300000,
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
