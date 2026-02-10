@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-stone-900 via-stone-800 to-amber-950">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23d4a574&quot; fill-opacity=&quot;0.3&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-36">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-900/40 text-amber-300 text-xs font-medium tracking-wide uppercase mb-6 border border-amber-800/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Now Accepting Bookings
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl text-white leading-tight mb-6">
                    Discover Events at<br>
                    <span class="text-amber-400">Delapre Abbey</span>
                </h1>
                <p class="text-lg sm:text-xl text-stone-300 leading-relaxed mb-10 max-w-2xl">
                    Explore our programme of free public events — from heritage open days and guided tours to family workshops and seasonal celebrations in this stunning 900-year-old abbey.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center justify-center px-7 py-3.5 bg-amber-600 hover:bg-amber-500 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg shadow-amber-900/30 hover:shadow-xl hover:shadow-amber-900/40 hover:-translate-y-0.5">
                        Browse Events
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    <a href="{{ route('bookings.lookup') }}" class="inline-flex items-center justify-center px-7 py-3.5 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-all duration-200 backdrop-blur-sm border border-white/20">
                        Find My Booking
                    </a>
                </div>
            </div>
        </div>
        {{-- Decorative bottom wave --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full"><path d="M0 80V40C240 0 480 0 720 40C960 80 1200 80 1440 40V80H0Z" fill="#fafaf9"/></svg>
        </div>
    </section>

    {{-- Featured Events --}}
    @if($featuredEvents->count())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="font-serif text-3xl lg:text-4xl text-stone-900 mb-2">Featured Events</h2>
                <p class="text-stone-500">Don't miss these highlights from our programme</p>
            </div>
            <a href="{{ route('events.index') }}" class="hidden sm:inline-flex items-center gap-1 text-amber-700 hover:text-amber-800 font-medium text-sm transition-colors">
                View all
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @foreach($featuredEvents as $event)
                @include('components.event-card', ['event' => $event, 'featured' => true])
            @endforeach
        </div>
    </section>
    @endif

    {{-- Upcoming Events --}}
    @if($upcomingEvents->count())
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <h2 class="font-serif text-3xl lg:text-4xl text-stone-900 mb-2">Upcoming Events</h2>
                    <p class="text-stone-500">Plan your next visit to Delapre Abbey</p>
                </div>
                <a href="{{ route('events.index') }}" class="hidden sm:inline-flex items-center gap-1 text-amber-700 hover:text-amber-800 font-medium text-sm transition-colors">
                    View all
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($upcomingEvents as $event)
                    @include('components.event-card', ['event' => $event, 'featured' => false])
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-stone-900 hover:bg-stone-800 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    See All Events
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Info Sections --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-2xl bg-white border border-stone-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-semibold text-lg text-stone-900 mb-2">Quick & Easy</h3>
                <p class="text-stone-500 text-sm leading-relaxed">Book your spot in under a minute. No account needed — just your name and email.</p>
            </div>
            <div class="text-center p-8 rounded-2xl bg-white border border-stone-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                </div>
                <h3 class="font-semibold text-lg text-stone-900 mb-2">Completely Free</h3>
                <p class="text-stone-500 text-sm leading-relaxed">All our public events are free to attend. Booking ensures your place is reserved.</p>
            </div>
            <div class="text-center p-8 rounded-2xl bg-white border border-stone-200 shadow-sm hover:shadow-md transition-shadow">
                <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                </div>
                <h3 class="font-semibold text-lg text-stone-900 mb-2">Instant Confirmation</h3>
                <p class="text-stone-500 text-sm leading-relaxed">Receive your booking reference immediately. Look it up any time before the event.</p>
            </div>
        </div>
    </section>
@endsection
