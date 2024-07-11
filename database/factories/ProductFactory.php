<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(640, 480, 'technics'),
            'category_id' => 4,
            'price' => $this->faker->numberBetween(2000000, 20000000),
        ];
    }
}
