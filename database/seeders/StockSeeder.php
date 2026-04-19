<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Stock;
use Illuminate\Database\Seeder;

final class StockSeeder extends Seeder
{
    public function run(): void
    {
        $stocks = [
            ['symbol' => 'AAPL', 'name' => 'Apple Inc.', 'exchange' => 'NASDAQ', 'type' => 'equity'],
            ['symbol' => 'MSFT', 'name' => 'Microsoft Corp.', 'exchange' => 'NASDAQ', 'type' => 'equity'],
            ['symbol' => 'TSLA', 'name' => 'Tesla Inc.', 'exchange' => 'NASDAQ', 'type' => 'equity'],
            ['symbol' => 'BTC-USD', 'name' => 'Bitcoin', 'exchange' => null, 'type' => 'crypto'],
        ];

        foreach ($stocks as $stock) {
            Stock::updateOrCreate(
                [
                    'symbol' => $stock['symbol'],
                    'exchange' => $stock['exchange'],
                ],
                $stock
            );
        }
    }
}
