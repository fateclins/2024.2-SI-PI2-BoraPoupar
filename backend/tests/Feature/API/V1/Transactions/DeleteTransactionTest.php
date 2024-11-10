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

it('should delete a transaction', function () {
    $transaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'expense',
        'amount' => 100,
    ]);

    $response = $this->deleteJson(route('api.v1.transactions.delete', ['transaction' => $transaction->id]));

    $response->assertOk();

    $this->assertDatabaseMissing('transactions', [
        'id' => $transaction->id,
    ]);

    $this->assertDatabaseHas('users', [
        'balance' => 1100,
    ]);

    $secondTransaction = Transaction::factory()->create([
        'user_id' => $this->user->id,
        'type' => 'income',
        'amount' => 100,
    ]);

    $response = $this->deleteJson(route('api.v1.transactions.delete', ['transaction' => $secondTransaction->id]));

    $response->assertOk();

    $this->assertDatabaseMissing('transactions', [
        'id' => $secondTransaction->id,
    ]);

    $this->assertDatabaseHas('users', [
        'balance' => 1000,
    ]);
});

it('should not delete a transaction that does not exist', function () {
    $response = $this->deleteJson(route('api.v1.transactions.delete', ['transaction' => 1]));

    $response->assertNotFound();
});

it('should not delete a transaction that belongs to another user', function () {

    $anotherUser = User::factory()->create();

    $transaction = Transaction::factory()->create([
        'user_id' => $anotherUser->id,
    ]);

    $response = $this->deleteJson(route('api.v1.transactions.delete', ['transaction' => $transaction->id]));

    $response->assertForbidden();
});
