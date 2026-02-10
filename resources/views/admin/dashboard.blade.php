@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')
    <div class="bg-gradient-to-b from-stone-100 to-stone-50 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="font-serif text-3xl text-stone-900 mb-1">Staff Dashboard</h1>
                    <p class="text-stone-500">Operational overview for Delapre Abbey events</p>
                </div>
                <a href="{{ route('admin.events') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-stone-900 hover:bg-stone-800 text-white text-sm font-medium rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    All Events
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 lg:gap-6 mb-10">
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ $stats['total_events'] }}</p>
                <p class="text-xs text-stone-500 mt-1">Total Events</p>
            </div>
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ $stats['published_events'] }}</p>
                <p class="text-xs text-stone-500 mt-1">Published</p>
            </div>
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ $stats['upcoming_events'] }}</p>
                <p class="text-xs text-stone-500 mt-1">Upcoming</p>
            </div>
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ $stats['total_bookings'] }}</p>
                <p class="text-xs text-stone-500 mt-1">Active Bookings</p>
            </div>
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-5 col-span-2 lg:col-span-1">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                </div>
                <p class="text-2xl font-bold text-stone-900">{{ $stats['total_attendees'] }}</p>
                <p class="text-xs text-stone-500 mt-1">Total Attendees</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            {{-- Upcoming Events --}}
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-stone-200 flex items-center justify-between">
                    <h2 class="font-semibold text-stone-900">Upcoming Events</h2>
                    <a href="{{ route('admin.events') }}" class="text-xs text-amber-700 hover:text-amber-800 font-medium">View all →</a>
                </div>
                <div class="divide-y divide-stone-100">
                    @forelse($upcomingEvents as $event)
                    <div class="px-6 py-4 flex items-center justify-between hover:bg-stone-50 transition-colors">
                        <div class="flex-1 min-w-0 mr-4">
                            <h3 class="text-sm font-medium text-stone-900 truncate">{{ $event->title }}</h3>
                            <div class="flex items-center gap-3 mt-1">
                                <span class="text-xs text-stone-500">{{ $event->start_date->format('D, j M') }}</span>
                                <span class="text-xs text-stone-300">·</span>
                                <span class="text-xs text-stone-500">{{ $event->start_date->format('g:ia') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-stone-900">{{ $event->bookings_count }}</p>
                                <p class="text-xs text-stone-400">bookings</p>
                            </div>
                            <a href="{{ route('admin.event-bookings', $event) }}" class="p-2 rounded-lg hover:bg-stone-100 text-stone-400 hover:text-stone-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-10 text-center text-sm text-stone-400">No upcoming events</div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Bookings --}}
            <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-stone-200">
                    <h2 class="font-semibold text-stone-900">Recent Bookings</h2>
                </div>
                <div class="divide-y divide-stone-100">
                    @forelse($recentBookings as $booking)
                    <div class="px-6 py-4 hover:bg-stone-50 transition-colors">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-medium text-stone-900">{{ $booking->name }}</span>
                            <span class="text-xs font-mono text-stone-400">{{ $booking->reference }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-stone-500 truncate mr-4">{{ $booking->event->title }}</span>
                            <span class="text-xs font-medium px-2 py-0.5 rounded-full
                                {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-stone-100 text-stone-500' }}
                            ">{{ $booking->tickets }} {{ $booking->tickets === 1 ? 'ticket' : 'tickets' }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-10 text-center text-sm text-stone-400">No bookings yet</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
