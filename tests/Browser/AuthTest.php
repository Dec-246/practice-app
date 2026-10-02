<?php

namespace Tests\Browser;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;


    /**
     * A basic test example.
     */
    it('registers a user', function ()
    {
        // when i visit the reg page
        visit('/register')
            ->fill('name', 'te')
            ->fill('email', 'test@gmail.com')
            ->fill('password', 'Testing123!')
            ->fill('password_confirmation', 'Testing123!')
            ->press('@register-button')
            ->assertPathIs('/ideas');

        // and i fill out submit form
        // then i should have account
        expect(User::where('email', 'test@gmail.com')->exists())->toBe(true);

        // and i should be signed in
        $this->assertAuthenticated();
        // and i should be on /ideas page
    });
