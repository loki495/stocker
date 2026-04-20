<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'stock_id' => Stock::factory(),
            'type' => $this->faker->randomElement(['buy', 'sell']),
            'quantity' => $this->faker->randomFloat(6, 1, 100),
            'price' => $this->faker->randomFloat(6, 10, 1000),
            'fee' => $this->faker->randomFloat(6, 0, 10),
            'currency' => 'USD',
            'executed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
