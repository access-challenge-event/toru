@extends('layouts.app')

@section('title', $event->title)
@section('meta_description', $event->short_description ?? Str::limit($event->description, 160))

@section('content')
    {{-- Breadcrumb --}}
    <div class="bg-stone-100 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex items-center gap-2 text-sm text-stone-500">
                <a href="{{ route('home') }}" class="hover:text-stone-700 transition-colors">Home</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('events.index') }}" class="hover:text-stone-700 transition-colors">Events</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-stone-900 font-medium truncate">{{ $event->title }}</span>
            </nav>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-14">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-14">
            {{-- Main content --}}
            <div class="lg:col-span-2">
                {{-- Image --}}
                <div class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-amber-100 via-stone-100 to-amber-50 h-64 sm:h-80 lg:h-96 mb-8">
                    @if($event->image)
                        <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-24 h-24 text-amber-300/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wide
                            @switch($event->category)
                                @case('heritage') bg-amber-600 text-white @break
                                @case('family') bg-emerald-600 text-white @break
                                @case('exhibition') bg-blue-600 text-white @break
                                @case('workshop') bg-purple-600 text-white @break
                                @case('seasonal') bg-rose-600 text-white @break
                                @default bg-stone-700 text-white
                            @endswitch
                        ">{{ $event->category }}</span>
                    </div>
                </div>

                {{-- Title --}}
                <h1 class="font-serif text-3xl sm:text-4xl text-stone-900 mb-4">{{ $event->title }}</h1>

                {{-- Meta info --}}
                <div class="flex flex-wrap gap-4 mb-8">
                    <div class="flex items-center gap-2 text-stone-600">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span class="text-sm font-medium">{{ $event->formatted_date }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-stone-600">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm font-medium">{{ $event->formatted_time }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-stone-600">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-sm font-medium">{{ $event->location }}</span>
                    </div>
                </div>

                {{-- Description --}}
                <div class="prose prose-stone max-w-none text-stone-600 leading-relaxed">
                    {!! nl2br(e($event->description)) !!}
                </div>
            </div>

            {{-- Booking sidebar --}}
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
                        {{-- Price header --}}
                        <div class="bg-gradient-to-r from-amber-50 to-amber-100/50 px-6 py-5 border-b border-stone-200">
                            <div class="flex items-center justify-between">
                                <span class="text-2xl font-bold text-stone-900">
                                    {{ $event->is_free ? 'Free' : '£' . number_format($event->price, 2) }}
                                </span>
                                @if(!$event->is_full)
                                    <span class="text-sm text-stone-500">{{ $event->spots_remaining }} of {{ $event->capacity }} spots left</span>
                                @endif
                            </div>
                            {{-- Availability bar --}}
                            <div class="mt-3">
                                <div class="w-full bg-stone-200 rounded-full h-2">
                                    <div class="h-2 rounded-full transition-all duration-500
                                        {{ $event->availability_percentage > 50 ? 'bg-emerald-500' : ($event->availability_percentage > 20 ? 'bg-amber-500' : 'bg-red-500') }}"
                                        style="width: {{ $event->availability_percentage }}%"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Booking form or full message --}}
                        <div class="p-6">
                            @if($event->is_full)
                                <div class="text-center py-4">
                                    <div class="w-14 h-14 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </div>
                                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Fully Booked</h3>
                                    <p class="text-stone-500 text-sm">This event is fully booked. Check back later in case spaces open up.</p>
                                </div>
                            @elseif($event->start_date->isPast())
                                <div class="text-center py-4">
                                    <div class="w-14 h-14 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-7 h-7 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <h3 class="font-semibold text-lg text-stone-900 mb-2">Event Has Passed</h3>
                                    <p class="text-stone-500 text-sm">This event has already taken place.</p>
                                </div>
                            @else
                                <form method="POST" action="{{ route('bookings.store', $event->slug) }}">
                                    @csrf

                                    <div class="space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">Full Name *</label>
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                                placeholder="Your full name">
                                            @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">Email Address *</label>
                                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                                placeholder="you@example.com">
                                            @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-stone-700 mb-1.5">Phone <span class="text-stone-400">(optional)</span></label>
                                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                                                placeholder="07xxx xxxxxx">
                                            @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label for="tickets" class="block text-sm font-medium text-stone-700 mb-1.5">Number of Tickets *</label>
                                            <select id="tickets" name="tickets" required
                                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all appearance-none cursor-pointer bg-white">
                                                @for($i = 1; $i <= min(10, $event->spots_remaining); $i++)
                                                    <option value="{{ $i }}" {{ old('tickets') == $i ? 'selected' : '' }}>{{ $i }} {{ $i === 1 ? 'ticket' : 'tickets' }}</option>
                                                @endfor
                                            </select>
                                            @error('tickets') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        <div>
                                            <label for="special_requirements" class="block text-sm font-medium text-stone-700 mb-1.5">Special Requirements <span class="text-stone-400">(optional)</span></label>
                                            <textarea id="special_requirements" name="special_requirements" rows="3"
                                                class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all resize-none"
                                                placeholder="Accessibility needs, dietary requirements, etc.">{{ old('special_requirements') }}</textarea>
                                            @error('special_requirements') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <button type="submit" class="w-full mt-6 px-6 py-3.5 bg-amber-600 hover:bg-amber-500 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                                        Book Now — Free
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    {{-- Event details card --}}
                    <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-6 mt-6">
                        <h3 class="font-semibold text-stone-900 mb-4">Event Details</h3>
                        <dl class="space-y-3">
                            <div class="flex items-start gap-3">
                                <dt class="sr-only">Date</dt>
                                <svg class="w-5 h-5 text-stone-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <dd class="text-sm text-stone-600">{{ $event->formatted_date }}</dd>
                            </div>
                            <div class="flex items-start gap-3">
                                <dt class="sr-only">Time</dt>
                                <svg class="w-5 h-5 text-stone-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <dd class="text-sm text-stone-600">{{ $event->formatted_time }}</dd>
                            </div>
                            <div class="flex items-start gap-3">
                                <dt class="sr-only">Location</dt>
                                <svg class="w-5 h-5 text-stone-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <dd class="text-sm text-stone-600">{{ $event->location }}</dd>
                            </div>
                            <div class="flex items-start gap-3">
                                <dt class="sr-only">Price</dt>
                                <svg class="w-5 h-5 text-stone-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                <dd class="text-sm text-stone-600">{{ $event->is_free ? 'Free Admission' : '£' . number_format($event->price, 2) }}</dd>
                            </div>
                            <div class="flex items-start gap-3">
                                <dt class="sr-only">Capacity</dt>
                                <svg class="w-5 h-5 text-stone-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                <dd class="text-sm text-stone-600">{{ $event->capacity }} total capacity</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Events --}}
        @if($relatedEvents->count())
        <section class="border-t border-stone-200 mt-16 pt-12">
            <h2 class="font-serif text-2xl text-stone-900 mb-8">More {{ ucfirst($event->category) }} Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($relatedEvents as $related)
                    @include('components.event-card', ['event' => $related, 'featured' => false])
                @endforeach
            </div>
        </section>
        @endif
    </div>
@endsection
