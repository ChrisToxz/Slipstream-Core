<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;

uses(RefreshDatabase::class);

redirectsGuestFor('/');
redirectsGuestFor('/dashboard');

beforeEach(function () {
    $this->user = createUser();
    actingAs($this->user);
});

it('can render the page')
    ->get('/dashboard')
    ->assertOk();

it('renders the users name')
    ->get('/dashboard')
    ->assertInertia(function (AssertableInertia $page) {

        $page->component('Dashboard')
            ->where('auth.user.name', $this->user->name);
    });

