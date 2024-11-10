<?php

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create(['balance' => 1000]);
    $this->category = Category::factory()->create();
    $this->actingAs($this->user);
});

it('should update an expense transaction successfully', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 200,
        'category_id' => $this->category->id,
        'name' => 'Old transaction',
    ]);

    $response = $this->putJson(route('api.v1.transactions.update', $transaction->id), [
        'amount' => 100,
        'type' => 'expense',
        'category_id' => $this->category->id,
        'name' => 'Updated transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(200);
    $this->assertEquals(1100, $this->user->fresh()->balance);
});

it('should update an income transaction successfully', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'income',
        'amount' => 200,
        'category_id' => $this->category->id,
        'name' => 'Old transaction',
    ]);

    $response = $this->putJson(route('api.v1.transactions.update', $transaction->id), [
        'amount' => 300,
        'type' => 'income',
        'category_id' => $this->category->id,
        'name' => 'Updated transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(200);
    $this->assertEquals(1100, $this->user->fresh()->balance);
});

it('should not update a transaction that does not belong to the user', function () {
    $anotherUser = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'user_id' => $anotherUser->id,
        'type' => 'expense',
        'amount' => 200,
        'category_id' => $this->category->id,
        'name' => 'Old transaction',
    ]);

    $response = $this->putJson(route('api.v1.transactions.update', $transaction->id), [
        'amount' => 100,
        'type' => 'expense',
        'category_id' => $this->category->id,
        'name' => 'Updated transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(403);
});

it('should return validation error when amount is not a number', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 200,
        'category_id' => $this->category->id,
        'name' => 'Old transaction',
    ]);

    $response = $this->putJson(route('api.v1.transactions.update', $transaction->id), [
        'amount' => 'invalid',
        'type' => 'expense',
        'category_id' => $this->category->id,
        'name' => 'Updated transaction',
        'user_id' => $this->user->id,
    ]);

    $response->assertStatus(422);
    $response->assertJsonValidationErrors('amount');
});
