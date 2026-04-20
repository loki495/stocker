<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\Transactions;

use App\Models\Transaction;

final class DeleteTransactionAction
{
    public function execute(Transaction $transaction): bool
    {
        return $transaction->delete();
    }
}
