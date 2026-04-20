<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Transactions;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class DeleteTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        $ulid = $this->route('transaction');

        // If it's already a Model instance (Route Model Binding still active for other methods)
        if ($ulid instanceof Transaction) {
            return $this->user()->can('delete', $ulid);
        }

        $transaction = Transaction::where('ulid', $ulid)->first();

        if (! $transaction) {
            return true; // Non-existent resource deletion is allowed (idempotent)
        }

        return $this->user()->can('delete', $transaction);
    }

    public function rules(): array
    {
        return [];
    }
}
