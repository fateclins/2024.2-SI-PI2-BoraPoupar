<?php

use App\Models\User;

beforeEach(function () {
    $this->authUser = User::factory()->create();
});

it('should return user data if user is verified', function () {
    $response = $this->actingAs($this->authUser)->getJson(route('api.v1.auth.verify'));

    $response->assertJson([
        'message' => 'User is verified',
        'user' => $this->authUser->only('id', 'name', 'email', 'balance'),
    ]);
});

it('should return 401 if user is not verified', function () {
    $response = $this->getJson(route('api.v1.auth.verify'));

    $response->assertUnauthorized();
});

