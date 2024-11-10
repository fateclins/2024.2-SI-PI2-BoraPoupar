<?php

use App\Models\Saving;
use App\Models\User;

beforeEach(function () {
    $this->authUser = User::factory()->create();
});

it('should update a saving', function () {
    $saving = Saving::factory()->create([
        'user_id' => $this->authUser->id,
    ]);

    $data = [
        'amount' => 2000,
    ];

    $response = $this->actingAs($this->authUser)
        ->putJson(route('api.v1.savings.update', $saving), $data);

    $response->assertOk();

    $this->assertDatabaseHas('savings', [
        'id' => $saving->id,
        'amount' => $data['amount'],
    ]);
});

it('should not update a saving with invalid data', function () {
    $saving = Saving::factory()->create([
        'user_id' => $this->authUser->id,
    ]);

    $data = [
        'amount' => 'invalid',
    ];

    $response = $this->actingAs($this->authUser)
        ->putJson(route('api.v1.savings.update', $saving), $data);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors('amount');
});

it('should not update a saving that does not exist', function () {
    $response = $this->actingAs($this->authUser)
        ->putJson(route('api.v1.savings.update', 1), []);

    $response->assertNotFound();
});

it('should not update a saving that belongs to another user', function () {
    $saving = Saving::factory()->create([
        'user_id' => User::factory()->create()->id,
    ]);

    $response = $this->actingAs($this->authUser)
        ->putJson(route('api.v1.savings.update', $saving), []);

    $response->assertForbidden();
});
