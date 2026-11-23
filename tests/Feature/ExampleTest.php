<?php

use App\Models\About;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    About::factory()->create();

    $this->get('/')->assertStatus(200);
});
