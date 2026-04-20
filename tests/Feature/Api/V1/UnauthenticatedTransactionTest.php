<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated users cannot list transactions', function () {
    $this->getJson('/api/v1/transactions')->assertStatus(401);
});

test('unauthenticated users cannot show a transaction', function () {
    $this->getJson('/api/v1/transactions/some-ulid')->assertStatus(401);
});

test('unauthenticated users cannot create a transaction', function () {
    $this->postJson('/api/v1/transactions', [])->assertStatus(401);
});

test('unauthenticated users cannot update a transaction', function () {
    $this->putJson('/api/v1/transactions/some-ulid', [])->assertStatus(401);
});

test('unauthenticated users cannot delete a transaction', function () {
    $this->deleteJson('/api/v1/transactions/some-ulid')->assertStatus(401);
});
