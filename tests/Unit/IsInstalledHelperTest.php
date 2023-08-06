<?php

use App\Helpers\AppHelper;

uses(
    Illuminate\Foundation\Testing\RefreshDatabase::class,
);

it('detects app not be installed yet')
    ->expect(fn() => AppHelper::is_installed())->toBeFalse();

it('detects app be installed')
    ->defer(fn() => createUser())
    ->expect(fn() => AppHelper::is_installed())->toBeTrue();

