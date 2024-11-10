<?php

/**
 * class ListSavingController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $user = Auth::user();

        $savings = $user->savings()
            ->select('id', 'name', 'amount', 'goal', 'description', 'created_at')
            ->get();

        return response()->json($savings, 200);
    }
}
 */

use App\Models\User;
use App\Models\Saving;

beforeEach(function () {
    $this->authUser = User::factory()->create();
});

it('should list all savings', function () {
    $savings = Saving::factory(3)->create([
        'user_id' => $this->authUser->id,
    ]);

    $response = $this->actingAs($this->authUser)
        ->getJson(route('api.v1.savings.list'));

    $response->assertOk();

    $response->assertJsonCount(3);

    $response->assertJsonStructure([
        '*' => [
            'id',
            'name',
            'amount',
            'goal',
            'description',
            'created_at',
        ],
    ]);
});

it('should not list savings if user has none', function () {
    $response = $this->actingAs($this->authUser)
        ->getJson(route('api.v1.savings.list'));

    $response->assertOk();

    $response->assertJsonCount(0);
});

it('should not list savings if user is not authenticated', function () {
    $response = $this->getJson(route('api.v1.savings.list'));

    $response->assertUnauthorized();
});