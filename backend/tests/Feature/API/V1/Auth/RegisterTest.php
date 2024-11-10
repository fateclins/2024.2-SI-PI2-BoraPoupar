<?php

use App\Models\User;

beforeEach(function () {
    $this->user = [
        'name' => 'Test User',
        'email' => 'email@email.com',
        'password' => 'password',
    ];
});

it('can register', function () {
    $response = $this->postJson(route('api.v1.auth.register'), [
        'name' => 'Test User',
        'email' => 'email@email.com',
        'password' => 'password',
    ]);

    $response->assertStatus(201)
        ->assertJsonStructure([
            'message',
            'token',
            'user' => ['id', 'name', 'email', 'balance'],
        ]);

    $this->assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'email@email.com',
    ]);

    $this->assertDatabaseCount('users', 1);

    $this->assertDatabaseCount('personal_access_tokens', 1);

    $this->assertDatabaseHas('personal_access_tokens', [
        'tokenable_id' => User::whereEmail('email@email.com')->first()->id,
        'tokenable_type' => User::class,
        'name' => 'auth_token',
    ]);
});

it('cannot register with existing email', function () {
    User::factory()->create([
        'email' => 'email@email.com',
    ]);

    $response = $this->postJson(route('api.v1.auth.register'), [
        'name' => 'Test User',
        'email' => 'email@email.com',
        'password' => 'password',
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['email'],
        ]);

    $this->assertGuest();
});

it('cannot register with missing name', function () {
    $response = $this->postJson(route('api.v1.auth.register'), [
        'email' => $this->user['email'],
        'password' => $this->user['password'],
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['name'],
        ]);

    $this->assertGuest();

    $this->assertDatabaseCount('users', 0);
});

it('cannot register with missing email', function () {
    $response = $this->postJson(route('api.v1.auth.register'), [
        'name' => $this->user['name'],
        'password' => $this->user['password'],
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['email'],
        ]);

    $this->assertGuest();

    $this->assertDatabaseCount('users', 0);
});

it('cannot register with missing password', function () {
    $response = $this->postJson(route('api.v1.auth.register'), [
        'name' => $this->user['name'],
        'email' => $this->user['email'],
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['password'],
        ]);

    $this->assertGuest();

    $this->assertDatabaseCount('users', 0);
});

it('cannot register with invalid email', function () {
    $response = $this->postJson(route('api.v1.auth.register'), [
        'name' => $this->user['name'],
        'email' => 'invalid-email',
        'password' => $this->user['password'],
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['email'],
        ]);

    $this->assertGuest();

    $this->assertDatabaseCount('users', 0);
});

it('cannot register with invalid password', function () {
    $response = $this->postJson(route('api.v1.auth.register'), [
        'name' => $this->user['name'],
        'email' => $this->user['email'],
        'password' => 'short',
    ]);

    $response->assertStatus(422)
        ->assertJsonStructure([
            'message',
            'errors' => ['password'],
        ]);

    $this->assertGuest();

    $this->assertDatabaseCount('users', 0);
});
