<?php

namespace Database\Factories;

use App\Models\InventoriedProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InventoriedProduct>
 */
class InventoriedProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->numberBetween(1, 10);
        $marge = fake()->randomFloat(2, 0.80, 1.40);
        $total_cost = fake()->numberBetween(1, 400) * 50 * $quantity;
        $total_price = round($total_cost * $marge / 50) * 50;

        return [
            'quantity' => $quantity,
            'total_cost' => $total_cost,
            'total_price' => $total_price,
        ];
    }
}
