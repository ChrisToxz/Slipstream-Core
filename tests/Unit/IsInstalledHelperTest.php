<?php

use App\Helpers\AppHelper;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
);

it('detects app not be installed yet')
    ->expect(fn() => AppHelper::is_installed())->toBeFalse();

it('detects app be installed', function () {
    createUser();
    expect(AppHelper::is_installed())->toBeTrue();
});


