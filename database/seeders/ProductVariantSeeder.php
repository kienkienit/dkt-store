<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variants = [
            [
                'product_id' => 32,
                'storage' => '64GB',
                'color' => 'Black',
                'price' => 20000000,
                'sold_quantity' => 100,
                'stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 32,
                'storage' => '64GB',
                'color' => 'White',
                'price' => 22000000,
                'sold_quantity' => 80,
                'stock_quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 32,
                'storage' => '128GB',
                'color' => 'Black',
                'price' => 25000000,
                'sold_quantity' => 60,
                'stock_quantity' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 32,
                'storage' => '128GB',
                'color' => 'White',
                'price' => 27000000,
                'sold_quantity' => 40,
                'stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('product_variants')->insert($variants);

        // Cập nhật giá sản phẩm
        $productId = 32;
        $this->updateProductPrice($productId);
    }
    protected function updateProductPrice($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $firstVariant = $product->variants()->orderBy('price')->first();
            if ($firstVariant && $product->price == 0) {
                $product->price = $firstVariant->price;
                $product->save();
            }
        }
    }
}
