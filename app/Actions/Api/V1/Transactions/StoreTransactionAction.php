<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\Transactions;

use App\DTOs\Api\V1\Transactions\CreateTransactionDTO;
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;

final class StoreTransactionAction
{
    public function execute(User $user, CreateTransactionDTO $dto): Transaction
    {
        $stock = Stock::where('symbol', $dto->stock_symbol)->firstOrFail();

        return Transaction::create([
            'user_id' => $user->id,
            'stock_id' => $stock->id,
            'type' => $dto->type,
            'quantity' => $dto->quantity,
            'price' => $dto->price,
            'fee' => $dto->fee,
            'currency' => $dto->currency,
            'executed_at' => $dto->executed_at ?? now(),
            'notes' => $dto->notes,
        ]);
    }
}
