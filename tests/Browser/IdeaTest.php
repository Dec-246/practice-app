<?php

use App\Models\User;

it('shows all ideas', function () {
    // given i am signed in
    $this->actingAs($user = User::factory()->create());

    // and i have one idea in db
    $user->ideas()->create([
        'description' => 'Build a thing',
    ]);

    // when i visit /ideas
    visit('/ideas')
        ->assertSee('Build a thing');

    // i should see my one idea
});

it('shows a single idea', function () {

});

it('shows an edit form to update an idea', function () {

});
