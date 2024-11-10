<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->category = Category::factory()->create();
    $this->actingAs($this->user);
});

it('should create a transaction', function () {
    $response = $this->postJson(route('api.v1.transactions.create'), [
        'category_id' => $this->category->id,
        'amount' => 1000,
        'note' => 'Test transaction',
        'type' => 'income',
        'name' => 'Test transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertCreated();

    $response->assertJsonStructure([
        'id',
        'category_id',
        'amount',
        'note',
        'created_at',
    ]);

    $this->assertDatabaseHas('transactions', [
        'category_id' => $this->category->id,
        'amount' => 1000,
        'note' => 'Test transaction',
        'type' => 'income',
        'name' => 'Test transaction',
        'user_id' => $this->user->id,
    ]);

    $this->assertDatabaseHas('categories', [
        'id' => 1,
    ]);

    $this->assertDatabaseHas('users', [
        'balance' => 1000,
    ]);
});

it('should not create a transaction when the category does not exist', function () {
    $response = $this->postJson(route('api.v1.transactions.create'), [
        'category_id' => 2,
        'amount' => 1000,
        'note' => 'Test transaction',
        'type' => 'income',
        'name' => 'Test transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('category_id');

    $this->assertDatabaseCount('transactions', 0);
});

it('should not create a transaction when the amount is not a number', function () {
    $response = $this->postJson(route('api.v1.transactions.create'), [
        'category_id' => $this->category->id,
        'amount' => 'invalid',
        'note' => 'Test transaction',
        'type' => 'income',
        'name' => 'Test transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('amount');

    $this->assertDatabaseCount('transactions', 0);
});

it('should not create a transaction when the amount is less than 0', function () {
    $response = $this->postJson(route('api.v1.transactions.create'), [
        'category_id' => $this->category->id,
        'amount' => -1000,
        'note' => 'Test transaction',
        'type' => 'income',
        'name' => 'Test transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('amount');

    $this->assertDatabaseCount('transactions', 0);
});

it('should not create a transaction when the type is not valid', function () {
    $response = $this->postJson(route('api.v1.transactions.create'), [
        'category_id' => $this->category->id,
        'amount' => 1000,
        'note' => 'Test transaction',
        'type' => 'invalid',
        'name' => 'Test transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('type');

    $this->assertDatabaseCount('transactions', 0);
});

it('should not create a transaction when the user does not exist', function () {
    $response = $this->postJson(route('api.v1.transactions.create'), [
        'category_id' => $this->category->id,
        'amount' => 1000,
        'note' => 'Test transaction',
        'type' => 'income',
        'name' => 'Test transaction',
        'user_id' => 2,
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('user_id');

    $this->assertDatabaseCount('transactions', 0);
});
