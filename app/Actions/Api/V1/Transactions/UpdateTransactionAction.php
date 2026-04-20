<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\Transactions;

use App\DTOs\Api\V1\Transactions\UpdateTransactionDTO;
use App\Models\Transaction;

final class UpdateTransactionAction
{
    public function execute(Transaction $transaction, UpdateTransactionDTO $dto): Transaction
    {
        $transaction->update($dto->toArray());

        return $transaction->fresh();
    }
}
