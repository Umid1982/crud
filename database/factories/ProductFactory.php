<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Measurement;
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
    public function definition()
    {
        $measurement = Measurement::query()->inRandomOrder()->first();
        $department = Department::query()->inRandomOrder()->first();
        return [
            'name_uz' => $this->faker->word,
            'name_ru' => $this->faker->word,
            'name_en' => $this->faker->word,
            'image' => $this->faker->word,
            'measurement_id' => $measurement->id,
            'price' => $this->faker->randomFloat(2,1000,1000000),
            'department_id' => $department->id,
            'barcode' => $this->faker->word,
        ];
    }
}
