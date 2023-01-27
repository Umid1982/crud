<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $invoice = Invoice::query()->inRandomOrder()->first();
        $product = Product::query()->inRandomOrder()->first();
        return [
            'invoice_id' => $invoice->id,
            'product_id' => $product->id,
            'price' => $this->faker->randomFloat(2, 1000, 1000000),
            'amount' => $this->faker->randomFloat(2, 1000, 1000000),
        ];
    }
}
