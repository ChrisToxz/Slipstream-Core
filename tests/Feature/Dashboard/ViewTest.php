<?php

use App\Models\Slip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;

uses(RefreshDatabase::class);

redirectsGuestFor('/');
redirectsGuestFor('/dashboard');


describe('Authorized', function () {
    beforeEach(function () {
        $this->user = createUser();
        actingAs($this->user);
    });

    it('can render the page')
        ->get('/dashboard')
        ->assertOk();

    it('renders the users name', function () {
        $this->get('/dashboard')
            ->assertInertia(function (AssertableInertia $page) {
                $page->component('Dashboard')
                    ->where('auth.user.name', $this->user->name);
            });
    });

    it('has slip as prop', function () {
        $slip = Slip::factory()->create();

        $this->get('/dashboard')
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Dashboard')
                ->has('slips.data.0')
                ->where('slips.data.0.title', $slip->title)
            );
    });
});

