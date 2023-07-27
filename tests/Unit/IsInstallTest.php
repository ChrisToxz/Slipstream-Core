<?php

use App\Helpers\AppHelper;

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
);

test('if app detects uninstalled', function () {
    $result = AppHelper::is_installed();

    expect($result)->toBeFalse();
});


