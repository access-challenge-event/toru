@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
    <div class="bg-gradient-to-b from-stone-100 to-stone-50 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <a href="{{ route('admin.dashboard') }}" class="text-stone-400 hover:text-stone-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        </a>
                        <h1 class="font-serif text-3xl text-stone-900">All Events</h1>
                    </div>
                    <p class="text-stone-500 ml-8">Manage and monitor all events</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-stone-200 bg-stone-50">
                            <th class="text-left py-3.5 px-6 text-xs font-semibold text-stone-500 uppercase tracking-wider">Event</th>
                            <th class="text-left py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Date</th>
                            <th class="text-left py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Category</th>
                            <th class="text-center py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Bookings</th>
                            <th class="text-center py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Capacity</th>
                            <th class="text-center py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Status</th>
                            <th class="text-right py-3.5 px-6 text-xs font-semibold text-stone-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($events as $event)
                        <tr class="hover:bg-stone-50 transition-colors">
                            <td class="py-4 px-6">
                                <div>
                                    <p class="font-medium text-stone-900">{{ $event->title }}</p>
                                    <p class="text-xs text-stone-400 mt-0.5">{{ $event->location }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4 whitespace-nowrap">
                                <p class="text-stone-700">{{ $event->start_date->format('j M Y') }}</p>
                                <p class="text-xs text-stone-400">{{ $event->start_date->format('g:ia') }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    @switch($event->category)
                                        @case('heritage') bg-amber-100 text-amber-800 @break
                                        @case('family') bg-emerald-100 text-emerald-800 @break
                                        @case('exhibition') bg-blue-100 text-blue-800 @break
                                        @case('workshop') bg-purple-100 text-purple-800 @break
                                        @case('seasonal') bg-rose-100 text-rose-800 @break
                                        @default bg-stone-100 text-stone-700
                                    @endswitch
                                ">{{ ucfirst($event->category) }}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="font-semibold text-stone-900">{{ $event->bookings_count }}</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-stone-600">{{ $event->spots_remaining }}/{{ $event->capacity }}</span>
                                    <div class="w-16 bg-stone-200 rounded-full h-1.5">
                                        <div class="h-1.5 rounded-full {{ $event->availability_percentage > 50 ? 'bg-emerald-500' : ($event->availability_percentage > 20 ? 'bg-amber-500' : 'bg-red-500') }}"
                                            style="width: {{ $event->availability_percentage }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $event->status === 'published' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $event->status === 'draft' ? 'bg-stone-100 text-stone-600' : '' }}
                                    {{ $event->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $event->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                ">{{ ucfirst($event->status) }}</span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="{{ route('admin.event-bookings', $event) }}" class="inline-flex items-center gap-1 text-amber-700 hover:text-amber-800 font-medium text-xs transition-colors">
                                    Bookings
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400">No events yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    </div>
@endsection
