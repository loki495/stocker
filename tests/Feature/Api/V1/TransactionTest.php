<?php

/**
 * @property User $user
 */
use App\Models\Stock;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);
});

test('can list transactions', function () {
    Transaction::factory()->count(3)->create(['user_id' => auth()->id()]);
    Transaction::factory()->count(2)->create(); // Other user's transactions

    $response = $this->getJson('/api/v1/transactions');

    $response->assertSuccessful()
        ->assertJsonCount(3, 'data');
});

test('can create a transaction', function () {
    $stock = Stock::factory()->create();
    $data = [
        'stock_symbol' => $stock->symbol,
        'type' => 'buy',
        'quantity' => 10.5,
        'price' => 150.75,
    ];

    $response = $this->postJson('/api/v1/transactions', $data);

    $response->assertStatus(201);

    $this->assertDatabaseHas('transactions', [
        'user_id' => auth()->id(),
        'stock_id' => $stock->id,
    ]);
});

test('can show a transaction', function () {
    $transaction = Transaction::factory()->create(['user_id' => auth()->id()]);

    $response = $this->getJson("/api/v1/transactions/{$transaction->ulid}");

    $response->assertSuccessful()
        ->assertJsonPath('data.ulid', $transaction->ulid);
});

test('cannot show another user transaction', function () {
    $otherUser = User::factory()->create();
    $transaction = Transaction::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->getJson("/api/v1/transactions/{$transaction->ulid}");

    $response->assertForbidden();
});

test('can update a transaction', function () {
    $transaction = Transaction::factory()->create(['user_id' => auth()->id(), 'quantity' => 10]);
    $data = ['quantity' => 20];

    $response = $this->putJson("/api/v1/transactions/{$transaction->ulid}", $data);

    $response->assertSuccessful()
        ->assertJsonPath('data.quantity', 20);
});

test('cannot update another user transaction', function () {
    $otherUser = User::factory()->create();
    $transaction = Transaction::factory()->create(['user_id' => $otherUser->id]);
    $data = ['quantity' => 20];

    $response = $this->putJson("/api/v1/transactions/{$transaction->ulid}", $data);

    $response->assertForbidden();
});

test('can delete a transaction', function () {
    $transaction = Transaction::factory()->create(['user_id' => auth()->id()]);

    $response = $this->deleteJson("/api/v1/transactions/{$transaction->ulid}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
});

test('cannot delete another user transaction', function () {
    $otherUser = User::factory()->create();
    $transaction = Transaction::factory()->create(['user_id' => $otherUser->id]);

    $response = $this->deleteJson("/api/v1/transactions/{$transaction->ulid}");

    $response->assertForbidden();
});

test('delete is idempotent (returns 204 for non-existent)', function () {
    $response = $this->deleteJson('/api/v1/transactions/01JKZ6S0M3M3M3M3M3M3M3M3M3');

    $response->assertStatus(204);
});

test('wrong path returns 404', function () {
    $this->getJson('/api/v1/wrong-endpoint')->assertStatus(404);
});
