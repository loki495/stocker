<?php

namespace App\Http\Resources\Api\V1;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Transaction
 */
class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'ulid' => $this->ulid,
            'type' => $this->type,
            'quantity' => (float) $this->quantity,
            'price' => (float) $this->price,
            'fee' => (float) $this->fee,
            'currency' => $this->currency,
            'executed_at' => $this->executed_at?->toDateTimeString(),
            'notes' => $this->notes,
            'stock' => [
                'symbol' => $this->stock->symbol,
                'name' => $this->stock->name,
                'exchange' => $this->stock->exchange,
            ],
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
