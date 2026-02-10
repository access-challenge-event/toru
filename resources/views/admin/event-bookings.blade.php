@extends('layouts.app')

@section('title', $event->title . ' — Bookings')

@section('content')
    <div class="bg-gradient-to-b from-stone-100 to-stone-50 border-b border-stone-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <div class="flex items-center gap-3 mb-1">
                <a href="{{ route('admin.events') }}" class="text-stone-400 hover:text-stone-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h1 class="font-serif text-3xl text-stone-900">{{ $event->title }}</h1>
            </div>
            <div class="ml-8 flex flex-wrap items-center gap-4 text-sm text-stone-500">
                <span>{{ $event->formatted_date }}</span>
                <span class="text-stone-300">·</span>
                <span>{{ $event->formatted_time }}</span>
                <span class="text-stone-300">·</span>
                <span>{{ $event->spots_remaining }} of {{ $event->capacity }} spots remaining</span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
        {{-- Quick stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <p class="text-xs text-stone-500 mb-1">Total Bookings</p>
                <p class="text-xl font-bold text-stone-900">{{ $bookings->total() }}</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <p class="text-xs text-stone-500 mb-1">Confirmed</p>
                <p class="text-xl font-bold text-emerald-600">{{ $event->bookings()->where('status', 'confirmed')->count() }}</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <p class="text-xs text-stone-500 mb-1">Cancelled</p>
                <p class="text-xl font-bold text-stone-400">{{ $event->bookings()->where('status', 'cancelled')->count() }}</p>
            </div>
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <p class="text-xs text-stone-500 mb-1">Total Tickets</p>
                <p class="text-xl font-bold text-stone-900">{{ $event->bookings()->where('status', 'confirmed')->sum('tickets') }}</p>
            </div>
        </div>

        {{-- Bookings table --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-stone-200 bg-stone-50">
                            <th class="text-left py-3.5 px-6 text-xs font-semibold text-stone-500 uppercase tracking-wider">Reference</th>
                            <th class="text-left py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Name</th>
                            <th class="text-left py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Email</th>
                            <th class="text-left py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Phone</th>
                            <th class="text-center py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Tickets</th>
                            <th class="text-center py-3.5 px-4 text-xs font-semibold text-stone-500 uppercase tracking-wider">Status</th>
                            <th class="text-left py-3.5 px-6 text-xs font-semibold text-stone-500 uppercase tracking-wider">Booked</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @forelse($bookings as $booking)
                        <tr class="hover:bg-stone-50 transition-colors">
                            <td class="py-3.5 px-6 font-mono text-xs text-stone-600">{{ $booking->reference }}</td>
                            <td class="py-3.5 px-4 font-medium text-stone-900">{{ $booking->name }}</td>
                            <td class="py-3.5 px-4 text-stone-600">{{ $booking->email }}</td>
                            <td class="py-3.5 px-4 text-stone-600">{{ $booking->phone ?? '—' }}</td>
                            <td class="py-3.5 px-4 text-center font-semibold text-stone-900">{{ $booking->tickets }}</td>
                            <td class="py-3.5 px-4 text-center">
                                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold
                                    {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-stone-100 text-stone-500' : '' }}
                                    {{ $booking->status === 'attended' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $booking->status === 'no_show' ? 'bg-red-100 text-red-700' : '' }}
                                ">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                            </td>
                            <td class="py-3.5 px-6 text-xs text-stone-500">{{ $booking->created_at->format('j M Y, g:ia') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-stone-400">No bookings for this event yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
