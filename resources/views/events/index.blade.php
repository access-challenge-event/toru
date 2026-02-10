@extends('layouts.app')

@section('title', 'Events')

@section('content')
    {{-- Page Header --}}
    <section class="bg-gradient-to-b from-stone-100 to-stone-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <h1 class="font-serif text-3xl lg:text-4xl text-stone-900 mb-3">Upcoming Events</h1>
            <p class="text-stone-500 text-lg max-w-2xl">Explore everything happening at Delapre Abbey. All events are free — book your place to guarantee entry.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        {{-- Filters --}}
        <form method="GET" action="{{ route('events.index') }}" class="flex flex-col sm:flex-row gap-4 mb-10">
            <div class="flex-1 relative">
                <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search events..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-stone-300 bg-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
            </div>
            <select name="category" onchange="this.form.submit()" class="px-4 py-3 rounded-xl border border-stone-300 bg-white text-sm text-stone-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent cursor-pointer appearance-none bg-no-repeat bg-right pr-10" style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2216%22 height=%2216%22 fill=%22%23a8a29e%22 viewBox=%220 0 16 16%22%3E%3Cpath d=%22M4.646 5.646a.5.5 0 0 1 .708 0L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z%22/%3E%3C/svg%3E'); background-position: right 0.75rem center;">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                        {{ ucfirst($category) }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="px-6 py-3 bg-stone-900 hover:bg-stone-800 text-white text-sm font-medium rounded-xl transition-colors">
                Search
            </button>
            @if(request()->hasAny(['search', 'category']))
                <a href="{{ route('events.index') }}" class="px-4 py-3 text-stone-500 hover:text-stone-700 text-sm font-medium rounded-xl border border-stone-200 hover:border-stone-300 transition-colors text-center">
                    Clear
                </a>
            @endif
        </form>

        {{-- Event Grid --}}
        @if($events->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($events as $event)
                    @include('components.event-card', ['event' => $event, 'featured' => false])
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $events->withQueryString()->links() }}
            </div>
        @else
            <div class="text-center py-20">
                <div class="w-20 h-20 rounded-2xl bg-stone-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="font-semibold text-xl text-stone-900 mb-2">No events found</h3>
                <p class="text-stone-500 mb-6">We couldn't find any events matching your criteria.</p>
                <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-stone-900 text-white rounded-xl text-sm font-medium hover:bg-stone-800 transition-colors">
                    View All Events
                </a>
            </div>
        @endif
    </section>
@endsection
