<?php

use App\Enums\TalkType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a user can create a talk ', function () {
    $user = User::factory()->create();
    $response = $this
        ->actingAs($user)
        ->post(route('talks.store'), [
            'title' => $title = fake()->sentence(),
            'type' => TalkType::KEYNOTE->value,
        ]);

    $response
        ->assertRedirect(route('talks.index'));

    $this->assertDatabaseHas('talks', [
        'title' => $title,
    ]);
});
