@extends('layouts.public')
@section('title', $work->title)
@section('content')
    <main class="mx-auto max-w-3xl px-4 py-12 md:px-8">
        <a href="{{ route('home') }}#selected-work-heading" class="text-sm text-blue-600 dark:text-blue-400">&larr; Back to Selected Work</a>
        <article class="mt-8">
            <h1 class="break-words text-3xl font-bold md:text-4xl">{{ $work->title }}</h1>
            <p class="mt-6 text-lg leading-relaxed text-slate-600 dark:text-slate-300">{{ $work->subtitle }}</p>
            @if ($work->image_path)
                <img src="{{ route('work.cover', $work) }}" alt="{{ $work->title }}" class="mt-8 h-auto w-full rounded-lg" />
            @endif
            <p class="mt-8 whitespace-pre-line break-words text-base leading-relaxed">{{ $work->content }}</p>
            @if (\Illuminate\Support\Str::isUrl($work->project_url, ['http', 'https']))
                <a href="{{ $work->project_url }}" class="mt-6 inline-block text-blue-600 underline dark:text-blue-400">Visit project</a>
            @endif
        </article>
    </main>
@endsection
