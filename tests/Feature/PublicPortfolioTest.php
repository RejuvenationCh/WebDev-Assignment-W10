<?php

use App\Models\About;
use App\Models\AboutItem;
use App\Models\ContactLink;
use App\Models\Works;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('home and about read the profile and details from the database', function () {
    About::factory()
        ->has(AboutItem::factory()->state([
            'title' => 'Photography portfolio',
            'description' => 'A collection of event photos.',
        ]), 'items')
        ->create([
            'name' => 'Example Portfolio Owner',
            'personal_description' => 'I document campus events.',
        ]);

    get('/')->assertOk()->assertSee('Example Portfolio Owner')->assertSee('I document campus events.');
    get('/home')->assertOk()->assertSee('Example Portfolio Owner');
    get('/about')->assertOk()->assertSee('Example Portfolio Owner')->assertSee('I document campus events.')
        ->assertSee('Photography portfolio')->assertSee('A collection of event photos.');
});

test('home and about require a profile', function () {
    get('/home')->assertNotFound();
    get('/about')->assertNotFound();
});

test('contact reads the current links from the database', function () {
    get('/contact')->assertOk()->assertDontSee('mailto:');

    ContactLink::create([
        'type' => 'email',
        'label' => 'Email me',
        'destination' => 'portfolio@example.com',
    ]);

    $social = ContactLink::create([
        'type' => 'social',
        'label' => '@portfolio',
        'destination' => 'https://example.com/old-profile',
        'icon' => 'fa-github',
    ]);

    get('/contact')->assertOk()
        ->assertSee('mailto:portfolio@example.com')
        ->assertSee('Email me')
        ->assertSee('@portfolio')
        ->assertSee('fa-github')
        ->assertSee('https://example.com/old-profile');

    $social->update(['destination' => 'https://example.com/new-profile']);

    get('/contact')->assertOk()->assertSee('https://example.com/new-profile')
        ->assertDontSee('https://example.com/old-profile');
});

test('home selects exactly the latest three published featured works', function () {
    About::factory()->create();

    foreach (range(1, 5) as $number) {
        Works::factory()->create([
            'title' => 'Eligible work '.$number,
            'subtitle' => 'Work subtitle',
            'is_published' => true,
            'is_featured' => true,
        ]);
    }
    Works::factory()->create(['title' => 'Newest draft', 'is_published' => false, 'is_featured' => true]);
    Works::factory()->create(['title' => 'Newest regular', 'is_published' => true, 'is_featured' => false]);

    get('/home')->assertOk()->assertSeeInOrder(['Eligible work 5', 'Eligible work 4', 'Eligible work 3'])
        ->assertSee('Work subtitle')->assertDontSee('Eligible work 2')->assertDontSee('Eligible work 1')
        ->assertDontSee('Newest draft')->assertDontSee('Newest regular');
});

test('featured work links to its own details and draft work stays private', function () {
    About::factory()->create();

    $storage = Storage::fake('local');
    $storage->put('work-cover.png', 'public cover');
    $storage->put('draft-work-cover.png', 'private cover');
    $work = Works::factory()->create([
        'content' => 'Project details.',
        'image_path' => 'work-cover.png',
        'project_url' => 'https://example.com/project',
        'is_published' => true,
        'is_featured' => true,
    ]);
    $draft = Works::factory()->create(['image_path' => 'draft-work-cover.png', 'is_published' => false]);
    $unlinked = Works::factory()->create(['project_url' => null, 'is_published' => true, 'is_featured' => false]);

    get('/')->assertOk()->assertSee('/work/'.$work->id)->assertSee('/work/'.$work->id.'/cover');
    get('/work/'.$work->id)->assertOk()->assertSee('Project details.')->assertSee('https://example.com/project');
    get('/work/'.$work->id.'/cover')->assertOk()->assertStreamedContent('public cover');
    get('/work/'.$draft->id)->assertNotFound();
    get('/work/'.$draft->id.'/cover')->assertNotFound();
    get('/work/'.$unlinked->id)->assertOk()->assertDontSee('Visit project');
});
