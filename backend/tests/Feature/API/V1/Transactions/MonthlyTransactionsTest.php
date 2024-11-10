<?php

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create([
        'balance' => 1000,
    ]);
    $this->category = Category::factory()->create();
    $this->actingAs($this->user);
});

it('should list monthly transactions', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.monthly'));

    $response->assertOk();

    $response->assertJsonStructure([
        'incomes',
        'expenses',
    ]);

    $response->assertJsonFragment([
        'incomes' => 0,
        'expenses' => 100,
    ]);
});

it('should calculate monthly transactions correctly', function () {
    $transaction1 = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $transaction2 = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'income',
        'amount' => 200,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.monthly'));

    $response->assertOk();

    $response->assertJsonFragment([
        'incomes' => 200,
        'expenses' => 100,
    ]);
});

it('should not list transactions from previous month', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
        'created_at' => now()->subMonth(2),
    ]);

    $response = $this->getJson(route('api.v1.transactions.monthly'));

    $response->assertOk();

    $response->assertJsonFragment([
        'incomes' => 0,
        'expenses' => 0,
    ]);
});
