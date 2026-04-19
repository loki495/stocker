<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('allows authenticated api access via token', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->getJson('/api/user');

    $response->assertOk();
});
