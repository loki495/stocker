<?php

declare(strict_types=1);

namespace App\DTOs\Api\V1\Transactions;

use App\Http\Requests\Api\V1\Transactions\UpdateTransactionRequest;

readonly class UpdateTransactionDTO
{
    public function __construct(
        public ?string $type = null,
        public ?float $quantity = null,
        public ?float $price = null,
        public ?float $fee = null,
        public ?string $currency = null,
        public ?string $executed_at = null,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(UpdateTransactionRequest $request): self
    {
        return new self(
            type: $request->validated('type'),
            quantity: $request->has('quantity') ? (float) $request->validated('quantity') : null,
            price: $request->has('price') ? (float) $request->validated('price') : null,
            fee: $request->has('fee') ? (float) $request->validated('fee') : null,
            currency: $request->validated('currency'),
            executed_at: $request->validated('executed_at'),
            notes: $request->validated('notes'),
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'type' => $this->type,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'fee' => $this->fee,
            'currency' => $this->currency,
            'executed_at' => $this->executed_at,
            'notes' => $this->notes,
        ], fn ($value) => ! is_null($value));
    }
}
