<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Pelanggan Dummy
        \App\Models\Customer::create(['name' => 'Budi Sudarsono', 'phone' => '0812345678']);
        \App\Models\Customer::create(['name' => 'Siti Aminah', 'phone' => '0857778889']);
    
        // Buat Barang Dummy (Sesuai Toko ABC)
        \App\Models\Product::create(['name' => 'Beras 5kg', 'stock' => 20, 'price' => 75000]);
        \App\Models\Product::create(['name' => 'Minyak Goreng 1L', 'stock' => 50, 'price' => 18000]);
        \App\Models\Product::create(['name' => 'Gula Pasir 1kg', 'stock' => 30, 'price' => 15000]);
    }
}
