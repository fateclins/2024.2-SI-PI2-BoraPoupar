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

it('should list recent transactions', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.recent'));

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

it('should list only 5 recent transactions', function () {
    $transactions = Transaction::factory()->count(10)->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.recent'));

    $response->assertOk();

    $response->assertJsonCount(5);

    $recentTransactions = $transactions->sortByDesc('created_at')->take(5);

    foreach ($recentTransactions as $transaction) {
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
    }
});
