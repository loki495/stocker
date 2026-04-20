<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'symbol' => $this->faker->unique()->lexify('????'),
            'name' => $this->faker->company(),
            'exchange' => $this->faker->randomElement(['NYSE', 'NASDAQ', 'LSE']),
            'type' => 'equity',
        ];
    }
}
