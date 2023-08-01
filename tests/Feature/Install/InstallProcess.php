<?php

use App\Helpers\AppHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

it('can submit the installation form', function () {
    post(route('install.store'), [
        'name' => 'Test name',
        'username' => 'username',
        'password' => 'password',
        'password_confirmation' => 'password'
    ])
        ->assertRedirectToRoute('login');

    $this->assertDatabaseHas('users', [
        'name' => 'Test name',
        'username' => 'username',
    ]);

    expect(AppHelper::is_installed())->toBeTrue();

});

it('requires a name, username and matching password', function () {
    post(route('install.store'), [])
        ->assertSessionHasErrors(['name', 'username', 'password']);
});

it('fails when passwords are not matching', function () {
    post(route('install.store'), [
        'name' => 'Test name',
        'username' => 'username',
        'password' => 'password',
        'password_confirmation' => 'drowssap'
    ])
        ->assertSessionHasErrors(['password']);
});
