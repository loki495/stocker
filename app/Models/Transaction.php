<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Transaction extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'ulid',
        'user_id',
        'stock_id',
        'type',
        'quantity',
        'price',
        'fee',
        'currency',
        'executed_at',
        'notes',
    ];

    #[\Override]
    public function uniqueIds(): array
    {
        return ['ulid'];
    }

    #[\Override]
    public function getRouteKeyName(): string
    {
        return 'ulid';
    }

    protected $casts = [
        'quantity' => 'decimal:6',
        'price' => 'decimal:6',
        'fee' => 'decimal:6',
        'executed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Stock, $this>
     */
    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class);
    }
}
