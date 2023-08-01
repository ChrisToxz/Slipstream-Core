<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('redirects to install page when not installed yet')
    ->get('/login')
    ->assertRedirectToRoute('install');

it('redirects to login/dashboard if installation already have been done')
    ->defer(fn() => createUser())
    ->get('/install')
    ->assertRedirectToRoute('login');



