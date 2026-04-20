<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Transactions;

use App\Models\Transaction;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Transaction::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'stock_symbol' => ['required', 'string', 'exists:stocks,symbol'],
            'type' => ['required', 'string', 'in:buy,sell'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'fee' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:10'],
            'executed_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
