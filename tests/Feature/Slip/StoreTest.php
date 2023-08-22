<?php

use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->user = createUser();
    actingAs($this->user);

    $this->file = new UploadedFile(
        base_path('./tests/Assets/video.mp4'), // Path to the file
        'video.mp4', // Original file name
        mime_content_type(base_path('./tests/Assets/video.mp4')), // Mime type
        null, // Error code
        true
    );
});

it('it can upload a valid file to the tmp folder', function () {
    $request = $this->post(route('slips.tempupload'),
        [
            'file' => UploadedFile::fake()->image(base_path('./tests/Assets/video.mp4'))
        ])->assertSessionHas('tmpPath');;

    $this->assertFileExists(storage_path('app/'.session('tmpPath')));
});

it('dispatches jobs after successfully uploaded file', function () {
    Bus::fake();

    $this->post(route('slips.tempupload'),
        [
            'file' => UploadedFile::fake()->image(base_path('./tests/Assets/video.mp4'))
        ])->assertSessionHas('tmpPath');;

    $this->post(route('slips.store'), [
        'title' => 'Title!',
        'description' => 'Description',
        'type' => 'Original',
        'file' => session('tmpPath')
    ])->assertSessionHasNoErrors();

    Bus::assertDispatched(\App\Jobs\GenerateThumb::class);
    Bus::assertDispatched(App\Jobs\CreateSlip::class);
});

it('processes the slip', function () {

    $this->post(route('slips.tempupload'),
        [
            'file' => $this->file// Test mode, this ensures the file isn't actually moved
        ])->assertSessionHas('tmpPath');;

    $slip = \App\Models\Slip::create([
        'title' => 'This is the title',
    ]);

    \App\Jobs\CreateSlip::dispatch($slip, session('tmpPath'), \App\Enums\VideoType::Original());

    $slip = $slip->fresh();

    expect($slip->mediable->localPath)->toBe("{$slip->token}/{$slip->mediable->file}");

    $this->assertFileExists(storage_path("./app/public/slips/{$slip->mediable->localPath}"));

    // Delete test file
    Artisan::call('ss:cleanall');
});

