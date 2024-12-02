<?php

use App\Console\Commands\ImportConferences;
use App\Models\Conference;

test('it imports a conference', function () {
    $command = new ImportConferences;

    $data = [
        'name' => 'This is the name from the API',
        '_rel' => ['cfp_uri' => 'v1/cfp/r654er6r4g64gqre64gerq'],
    ];

    $command->importOrUpdateConference($data);

    $first = Conference::first();
    $this->assertEquals($first->title, $data['name']);
})->only();

test('it updates a conference', function () {
    $command = new ImportConferences;

    Conference::create(['title' => 'original DB title', 'callingallpapers_id' => 'v1/cfp/r654er6r4g64gqre64gerq']);

    $data = [
        'name' => 'This is the name from the API',
        '_rel' => ['cfp_uri' => 'v1/cfp/r654er6r4g64gqre64gerq'],
    ];

    $command->importOrUpdateConference($data);

    $first = Conference::first();
    $this->assertEquals($first->title, $data['name']);
    $this->assertEquals(1, Conference::count());
})->only();
