<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Storage>
 */
class StorageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::query()->inRandomOrder()->first();
        return [
            'product_id' => $product->id,
            'amount' => $this->faker->randomFloat(2, 1000, 1000000),
            'default_amount' => $this->faker->randomFloat(2, 1000, 1000000),
        ];
    }
}
