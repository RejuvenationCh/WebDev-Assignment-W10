@extends('layouts.public')
@section('title', 'Contact')
@section('content')
 <section class="px-4 md:px-6 py-6">
   <div class="mx-auto max-w-5xl">
      <div>
         <div class="mb-12">
            <h2 class="text-3xl font-bold text-slate-900 mb-6 md:text-4xl dark:text-slate-50">
               Say hello.
            </h2>
            <p class="text-base leading-relaxed text-slate-600 dark:text-slate-400">
               The easiest ways to reach me. I read everything, and I answer.
            </p>
         </div>

         <div class="mt-12">
            <h3 class="text-slate-900 text-base font-semibold dark:text-slate-50">Email</h3>
            <ul class="mt-4">
               @foreach ($emailLinks as $link)
                  <li class="flex items-center">
                     <div class="flex items-center bg-slate-200 dark:bg-neutral-800 w-8 h-8 p-2 rounded-full">
                        <i class="fa-solid fa-envelope text-slate-600 dark:text-slate-50" aria-hidden="true"></i>
                     </div>
                     <a href="mailto:{{ $link->destination }}" class="text-sm ml-4">
                        <small class="block text-slate-900 dark:text-slate-50">{{ $link->label }}</small>
                        <span class="font-semibold text-blue-600 dark:text-slate-400">{{ $link->destination }}</span>
                     </a>
                  </li>
               @endforeach
            </ul>
         </div>

         <div class="mt-8">
            <h3 class="text-slate-900 text-base font-semibold dark:text-slate-50">Socials</h3>
            <ul class="flex flex-wrap gap-4 mt-4">
               @foreach ($socialLinks as $link)
                  <li>
                     <a href="{{ $link->destination }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-3 text-sm text-slate-900 hover:text-blue-600 dark:text-slate-50 dark:hover:text-blue-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 rounded">
                        @if ($link->icon)
                           <i class="fa-brands {{ $link->icon }} text-xl" aria-hidden="true"></i>
                        @endif
                        {{ $link->label }}
                     </a>
                  </li>
               @endforeach
            </ul>
         </div>
      </div>
   </div>
 </section>
@endsection
