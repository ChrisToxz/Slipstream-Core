<?php

use App\Helpers\AppHelper;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('if app redirects to install page when not installed', function () {
    $installed = AppHelper::is_installed();
    expect($installed)->toBeFalse();


    $response = $this->get('/login');
    expect($response->assertRedirectToRoute('install'));
});

test('if app detects installed instance when user exists', function () {
    User::factory()->create();
    $result = AppHelper::is_installed();

    expect($result)->toBeTrue();
});

test('user can finish installation', function () {
    $this->post(route('install.store'), [
        'name' => 'Test User',
        'username' => 'testuser',
        'password' => 'testpassword',
        'password_confirmation' => 'testpassword'
    ])
        ->assertRedirectToRoute('login');

    $this->assertDatabaseCount('users', 1);
    $this->assertDataBaseHas('users', ['name' => 'Test User']);
});

test('validation on install page works as expected', function () {
    $result = $this->post(route('install.store'))
        ->assertSessionHasErrors([
            'username', 'name', 'password'
        ]);
});

test('password validation will fail with invalid password', function () {
    $this->post(route('install.store'), [
        'name' => 'Test User',
        'username' => 'testuser',
        'password' => 'testpassword',
        'password_confirmation' => 'wrongpassword'
    ])
        ->assertSessionHasErrors(['password']);
});



