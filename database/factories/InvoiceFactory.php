<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provider = Provider::query()->inRandomOrder()->first();
        return [
            'provider_id' => $provider->id,
            'total_sum' => $this->faker->randomFloat(2, 1000, 1000000),
            'accept' => $this->faker->boolean,
            'is_paid' => $this->faker->boolean,
        ];
    }
}
