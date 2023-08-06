<?php

use App\Enums\VideoType;

it('can get the supported processing types')
    ->expect(VideoType::getKeys())->toBe([
        0 => 'Original',
        1 => 'X264',
        2 => 'HLS'
    ]);


