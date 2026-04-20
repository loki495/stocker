<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\Api\V1\Transactions\DeleteTransactionAction;
use App\Actions\Api\V1\Transactions\StoreTransactionAction;
use App\Actions\Api\V1\Transactions\UpdateTransactionAction;
use App\DTOs\Api\V1\Transactions\CreateTransactionDTO;
use App\DTOs\Api\V1\Transactions\UpdateTransactionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Transactions\DeleteTransactionRequest;
use App\Http\Requests\Api\V1\Transactions\StoreTransactionRequest;
use App\Http\Requests\Api\V1\Transactions\UpdateTransactionRequest;
use App\Http\Resources\Api\V1\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Gate;

final class TransactionController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $transactions = $request->user()->transactions()->with('stock')->get();

        return TransactionResource::collection($transactions);
    }

    public function store(StoreTransactionRequest $request, StoreTransactionAction $action): TransactionResource
    {
        $transaction = $action->execute(
            $request->user(),
            CreateTransactionDTO::fromRequest($request)
        );

        return new TransactionResource($transaction);
    }

    public function show(Transaction $transaction): TransactionResource
    {
        Gate::authorize('view', $transaction);

        return new TransactionResource($transaction->load('stock'));
    }

    public function update(
        UpdateTransactionRequest $request,
        Transaction $transaction,
        UpdateTransactionAction $action
    ): TransactionResource {
        $transaction = $action->execute(
            $transaction,
            UpdateTransactionDTO::fromRequest($request)
        );

        return new TransactionResource($transaction);
    }

    public function destroy(
        DeleteTransactionRequest $request,
        mixed $transaction,
        DeleteTransactionAction $action
    ): JsonResponse {
        // If not a model instance, try to find it
        if (! $transaction instanceof Transaction) {
            $transaction = Transaction::where('ulid', $transaction)->first();
        }

        // If found, delete it. If not found, it's already "gone" (204)
        if ($transaction) {
            $action->execute($transaction);
        }

        return response()->json(null, 204);
    }
}
