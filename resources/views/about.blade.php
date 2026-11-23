@extends('layouts.public')

@section('title', 'About')

@section('content')
    <section class="my-10 px-4 md:my-16 md:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="mb-12 grid items-center gap-8 md:mb-16 md:grid-cols-[minmax(0,320px)_minmax(0,1fr)] md:gap-12">
                <div class="mx-auto flex w-full max-w-xs items-end justify-center overflow-hidden rounded-2xl bg-slate-100 px-6 pt-6 dark:bg-neutral-800 md:mx-0">
                    <img src="{{ asset('img/portfolio/portrait-cutout.webp') }}" alt="{{ $profile->name }}" width="800" height="1295" class="h-[360px] w-auto max-w-full object-contain object-bottom sm:h-[420px]">
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold mb-6 text-slate-900 md:text-4xl dark:text-slate-50">{{ $profile->name }}</h1>
                    <p class="text-base text-slate-600 leading-relaxed dark:text-slate-400">{{ $profile->personal_description }}</p>
                </div>
            </div>
            <div class="grid gap-y-8 gap-x-8 lg:gap-x-0 md:grid-cols-2 lg:grid-cols-3 lg:divide-x lg:divide-slate-300 dark:lg:divide-neutral-700">
                @foreach ($profile->items as $item)
                    <div class="lg:px-8">
                        <h3 class="text-slate-900 text-lg font-semibold mb-3 dark:text-slate-50">{{ $item->title }}</h3>
                        <p class="text-base text-slate-600 leading-relaxed dark:text-slate-400">{{ $item->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
