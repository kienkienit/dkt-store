<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Điện thoại di động', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laptop', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tivi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tai nghe', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Âm thanh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Máy văn phòng', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
