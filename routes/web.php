<?php

use App\Models\About;
use App\Models\ContactLink;
use App\Models\Works;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

$home = function () {
    $profile = About::orderBy('id')->firstOrFail();

    $selectedWorks = Works::where([
        'is_published' => true,
        'is_featured' => true,
    ])->orderByDesc('id')->limit(3)->get();

    return view('home', ['profile' => $profile, 'selectedWorks' => $selectedWorks]);
};

Route::get('/', $home);
Route::get('/home', $home)->name('home');

Route::get('/about', function () {
    $profile = About::with('items')->orderBy('id')->firstOrFail();

    return view('about', ['profile' => $profile]);
})->name('about');

Route::get('/contact', function () {
    $links = ContactLink::orderBy('id')->get();
    $emailLinks = [];
    $socialLinks = [];

    foreach ($links as $link) {
        if ($link->type === 'email') {
            $emailLinks[] = $link;
        } elseif ($link->type === 'social' && Str::startsWith($link->destination, ['https://', 'http://'])) {
            $socialLinks[] = $link;
        }
    }

    return view('contact', ['emailLinks' => $emailLinks, 'socialLinks' => $socialLinks]);
})->name('contact');

Route::get('/work/{work}', function ($id) {
    $work = Works::where('is_published', true)->findOrFail($id);

    return view('works.show', ['work' => $work]);
})->name('work.show');

Route::get('/work/{work}/cover', function ($id) {
    $work = Works::where('is_published', true)->findOrFail($id);

    /** @var FilesystemAdapter $disk */
    $disk = Storage::disk('local');

    if (! $work->image_path || ! $disk->exists($work->image_path)) {
        abort(404);
    }

    return $disk->response($work->image_path);
})->name('work.cover');
