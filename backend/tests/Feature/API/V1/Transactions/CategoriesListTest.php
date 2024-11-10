<?php

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $this->actingAs(User::factory()->create());
});

it('returns a list of categories', function () {
    Category::factory()->count(3)->create();

    $response = $this->getJson(route('api.v1.transactions.categories'));

    $response->assertOk();

    $response->assertJsonStructure([
        '*' => [
            'id',
            'name',
            'type',
        ],
    ]);
});

it('returns a list of categories filtered by type', function () {
    Category::factory()->count(3)->create([
        'type' => 'expense',
    ]);

    Category::factory()->count(2)->create([
        'type' => 'income',
    ]);

    $response = $this->getJson(route('api.v1.transactions.categories', ['type' => 'income']));

    $response->assertOk();

    $response->assertJsonStructure([
        '*' => [
            'id',
            'name',
            'type',
        ],
    ]);
});

it('returns an empty list of categories when no categories are found', function () {
    $response = $this->getJson(route('api.v1.transactions.categories'));

    $response->assertOk();
});

it('returns an empty list of categories when no categories are found for the given type', function () {
    Category::factory()->count(3)->create();

    $response = $this->getJson(route('api.v1.transactions.categories', ['type' => 'income']));

    $response->assertOk();
});
