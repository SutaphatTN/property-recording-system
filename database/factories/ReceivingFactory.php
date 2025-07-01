<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receiving>
 */
class ReceivingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cost = fake()->numberBetween(900000, 10000000);
        $colors = ['red', 'black', 'white', 'gold', 'silver'];

        return [
            'model_name' => 'Mitsubishi ' . fake()->randomNumber(5),
            'tank_number' => 'Tank-' . fake()->randomNumber(5),
            'machine_number' => fake()->bothify('?#####?###?###?##'),
            // 'color' => fake()->safeColorName(),
            'color' => fake()->randomElement($colors),
            'receiving_company' => fake()->company(),
            'sending_company' => fake()->company(),
            'cost_price' => $cost,
            'sell_price' => $cost + fake()->numberBetween(500000, 1000000),
        ];
    }
}
