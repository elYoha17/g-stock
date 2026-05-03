<?php

namespace Database\Factories;

use App\Models\PurchasedProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PurchasedProduct>
 */
class PurchasedProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);

        return [
            'quantity' => $quantity,
            'total_cost' => fake()->numberBetween(1, 400) * 50 * $quantity,
        ];
    }
}
