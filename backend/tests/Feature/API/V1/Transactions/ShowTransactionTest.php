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

it('should show a transaction', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.show', $transaction));

    $response->assertOk();

    $response->assertJsonStructure([
        'id',
        'name',
        'amount',
        'type',
        'note',
        'category_id',
        'created_at',
    ]);

    $response->assertJsonFragment([
        'id' => $transaction->id,
        'name' => $transaction->name,
        'amount' => $transaction->amount,
        'type' => $transaction->type,
        'note' => $transaction->note,
        'category_id' => $transaction->category_id,
        'created_at' => $transaction->created_at->toISOString(),
    ]);
});

it('should return 403 when trying to show a transaction that does not belong to the user', function () {
    $anotherUser = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'user_id' => $anotherUser->id,
        'type' => 'expense',
        'amount' => 100,
        'category_id' => $this->category->id,
    ]);

    $response = $this->getJson(route('api.v1.transactions.show', $transaction));

    $response->assertForbidden();
});
