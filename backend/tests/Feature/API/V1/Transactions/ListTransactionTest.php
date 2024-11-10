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

it('should list transactions', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.list'));

    $response->assertOk();

    $response->assertJsonStructure([
        '*' => [
            'id',
            'name',
            'amount',
            'type',
            'note',
            'category_id',
            'created_at',
            'category' => [
                'id',
                'name',
                'type',
            ],
            'created_at_human',
        ],
    ]);

    $response->assertJsonFragment([
        'id' => $transaction->id,
        'name' => $transaction->name,
        'amount' => $transaction->amount,
        'type' => $transaction->type,
        'note' => $transaction->note,
        'category_id' => $transaction->category_id,
        'created_at' => $transaction->created_at->toISOString(),
        'category' => [
            'id' => $transaction->category->id,
            'name' => $transaction->category->name,
            'type' => $transaction->category->type,
        ],
    ]);
});

it('should list transactions in descending order', function () {
    $transaction1 = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
        'created_at' => now()->subDays(1),
    ]);

    $transaction2 = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 200,
        'category_id' => $this->category->id,
        'created_at' => now(),
    ]);

    $response = $this->getJson(route('api.v1.transactions.list'));

    $response->assertOk();

    $response->assertJsonFragment([
        'id' => $transaction2->id,
    ]);

    $response->assertJsonFragment([
        'id' => $transaction1->id,
    ]);
});

it('should list transactions with human readable date', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
        'created_at' => now()->subDays(1),
    ]);

    $response = $this->getJson(route('api.v1.transactions.list'));

    $response->assertOk();

    $response->assertJsonFragment([
        'created_at_human' => $transaction->created_at->diffForHumans(),
    ]);
});

it('should list transactions for the authenticated user', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $anotherUser = User::factory()->create();

    Transaction::factory()->create([
        'user_id' => $anotherUser->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.list'));

    $response->assertOk();

    $response->assertJsonFragment([
        'id' => $transaction->id,
    ]);

    $response->assertJsonMissing([
        'user_id' => $anotherUser->id,
    ]);
});
