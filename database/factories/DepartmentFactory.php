<?php

namespace Database\Factories;

use App\Models\Filial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $filial = Filial::query()->inRandomOrder()->first();

        return [
            'name_uz' => $this->faker->word,
            'printer' => $this->faker->word,
            'filial_id' => $filial->id,
            'name_ru' => $this->faker->word,
            'name_en' => $this->faker->word,
        ];
    }
}
