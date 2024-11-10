<?php

use App\Models\User;

beforeEach(function () {
    $this->authUser = User::factory()->create();
});

it('should create a saving', function () {
    $data = [
        'amount' => 1000,
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ];

    $response = $this->actingAs($this->authUser)
        ->postJson(route('api.v1.savings.create'), $data);

    $response->assertCreated();

    $this->assertDatabaseHas('savings', [
        'amount' => $data['amount'],
        'description' => $data['description'],
        'name' => $data['name'],
        'goal' => $data['goal'],
        'user_id' => $this->authUser->id,
    ]);

    $this->assertDatabaseCount('savings', 1);
});

it('should not create a saving with invalid data', function () {
    $data = [
        'amount' => 'invalid',
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ];

    $response = $this->actingAs($this->authUser)
        ->postJson(route('api.v1.savings.create'), $data);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('amount');
});

it('should not create a saving with missing data', function () {
    $data = [
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ];

    $response = $this->actingAs($this->authUser)
        ->postJson(route('api.v1.savings.create'), $data);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('amount');
});

it('should not create a saving with negative amount', function () {
    $data = [
        'amount' => -1000,
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ];

    $response = $this->actingAs($this->authUser)
        ->postJson(route('api.v1.savings.create'), $data);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('amount');
});

it('should not create a saving with negative goal', function () {
    $data = [
        'amount' => 1000,
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => -2000,
    ];

    $response = $this->actingAs($this->authUser)
        ->postJson(route('api.v1.savings.create'), $data);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('goal');
});

it('should not create a saving with invalid user', function () {
    $data = [
        'amount' => 1000,
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ];

    $response = $this->postJson(route('api.v1.savings.create'), $data);

    $response->assertUnauthorized();
});
