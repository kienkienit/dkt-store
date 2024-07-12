<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variants')->insert([
            [
                'product_id' => 31,
                'storage' => '64GB',
                'color' => 'Silver',
                'price' => 20000000,
                'sold_quantity' => 100,
                'stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 31,
                'storage' => '64GB',
                'color' => 'White',
                'price' => 22000000,
                'sold_quantity' => 80,
                'stock_quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 31,
                'storage' => '64GB',
                'color' => 'Gold',
                'price' => 25000000,
                'sold_quantity' => 60,
                'stock_quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 31,
                'storage' => '64GB',
                'color' => 'Black',
                'price' => 27000000,
                'sold_quantity' => 40,
                'stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
