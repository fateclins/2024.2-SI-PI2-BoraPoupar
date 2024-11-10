<?php

use App\Models\User;

it('can login', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'message',
            'token',
            'user' => ['id', 'name', 'email', 'balance'],
        ]);

    $this->assertAuthenticated();

    $this->assertAuthenticatedAs($user);

    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_id' => $user->id,
        'tokenable_type' => User::class,
        'name' => 'auth_token',
    ]);
});

it('cannot login with invalid credentials', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/v1/auth/login', [
        'email' => $user->email,
        'password' => 'invalid-password',
    ]);

    $response->assertStatus(401)
        ->assertJsonStructure(['message']);

    $this->assertGuest();
});

it('cannot login with non-existent email', function () {
    $response = $this->postJson(route('api.v1.auth.login'), [
        'email' => 'nonexistent@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(401)
        ->assertJsonStructure(['message']);

    $this->assertGuest();
});

it('cannot login with missing email', function () {
    $response = $this->postJson(route('api.v1.auth.login'), [
        'password' => 'password',
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure(['message', 'errors' => ['email']]);

    $this->assertGuest();
});
