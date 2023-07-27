<?php

use App\Models\Video;

uses(\Illuminate\Foundation\Testing\DatabaseTransactions::class);

test('video duration formatted', function () {
    $video = new Video([
        'duration' => 67
    ]);

    expect($video->formattedDuration)->toEqual('01:07');
});

test('video duration formatted with only seconds', function () {
    $video = new Video([
        'duration' => 5
    ]);

    expect($video->formattedDuration)->toEqual('00:05');
});

test('video duration formatted with one minute zero seconds', function () {
    $video = new Video([
        'duration' => 60
    ]);

    expect($video->formattedDuration)->toEqual('01:00');
});
