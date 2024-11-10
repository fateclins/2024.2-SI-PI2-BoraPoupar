<?php

use App\Models\User;

beforeEach(function () {
    $this->authUser = User::factory()->create();
});

it('should delete a saving', function () {
    $saving = $this->authUser->savings()->create([
        'amount' => 1000,
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ]);

    $response = $this->actingAs($this->authUser)
        ->deleteJson(route('api.v1.savings.delete', ['saving' => $saving->id]));

    $response->assertOk();

    $this->assertDatabaseMissing('savings', [
        'id' => $saving->id,
    ]);

    $this->assertDatabaseCount('savings', 0);
});

it('should not delete a saving that does not exist', function () {
    $response = $this->actingAs($this->authUser)
        ->deleteJson(route('api.v1.savings.delete', ['saving' => 1]));

    $response->assertNotFound();
});

it('should not delete a saving that belongs to another user', function () {
    $saving = User::factory()->create()->savings()->create([
        'amount' => 1000,
        'description' => 'New saving',
        'name' => 'New saving',
        'goal' => 2000,
    ]);

    $response = $this->actingAs($this->authUser)
        ->deleteJson(route('api.v1.savings.delete', ['saving' => $saving->id]));

    $response->assertForbidden();
});
