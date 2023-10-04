@extends('layouts.app')
@include('dsvheader')
@include('navbar.newnavbar')


@foreach ($s = \Statamic\Statamic::tag('search:results')->sort('order')->fetch() as $results)
    @if($loop->first)
        <header class="my-12 md:my-16 lg:my24 text-center">
            <p class="text-green font-bold text-lg antialiased mb-4">Search Results</p>
        </header>
    @endif

<section class="max-w-4xl mx-auto flex-col space-y-4 divide-y">
    <div class="py-4">
        <div class="flex items-center justify-between">
            <h2><a class="inline-block text-yellow hover:underline text-3xl font-bold" href="{!! $results->url  !!}">{!! $results->title  !!}</a></h2>
            <div class="px-3 py-1 text-gray-900 font-bold bg-blue rounded-full text-sm">
                <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                {{ $results->collection }}
                </span>
            </div>

        </div>
        <div class="mt-2">{!! $results->text_field ?? $results->content !!} </div>
    </div>
</section>
@endforeach

@if(!count($s) > 0)
    <header class="my-12 md:my-16 lg:my24 text-center">
        <p class="text-green font-bold text-lg antialiased mb-4">No Search Results</p>
    </header>
@endif

@include('layouts.darktoggler')
