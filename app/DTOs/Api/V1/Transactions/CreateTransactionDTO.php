<?php

declare(strict_types=1);

namespace App\DTOs\Api\V1\Transactions;

use App\Http\Requests\Api\V1\Transactions\StoreTransactionRequest;

readonly class CreateTransactionDTO
{
    public function __construct(
        public string $stock_symbol,
        public string $type,
        public float $quantity,
        public float $price,
        public float $fee = 0,
        public string $currency = 'USD',
        public ?string $executed_at = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(StoreTransactionRequest $request): self
    {
        return new self(
            stock_symbol: $request->validated('stock_symbol'),
            type: $request->validated('type'),
            quantity: (float) $request->validated('quantity'),
            price: (float) $request->validated('price'),
            fee: (float) ($request->validated('fee') ?? 0),
            currency: $request->validated('currency') ?? 'USD',
            executed_at: $request->validated('executed_at'),
            notes: $request->validated('notes'),
        );
    }

    public function toArray(): array
    {
        return [
            'stock_symbol' => $this->stock_symbol,
            'type' => $this->type,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'fee' => $this->fee,
            'currency' => $this->currency,
            'executed_at' => $this->executed_at,
            'notes' => $this->notes,
        ];
    }
}
