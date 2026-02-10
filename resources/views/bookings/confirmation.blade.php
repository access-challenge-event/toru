@extends('layouts.app')

@section('title', 'Booking Confirmed')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        {{-- Success graphic --}}
        <div class="text-center mb-10">
            @if($booking->status === 'cancelled')
                <div class="w-20 h-20 rounded-full bg-stone-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <h1 class="font-serif text-3xl text-stone-900 mb-2">Booking Cancelled</h1>
                <p class="text-stone-500">This booking has been cancelled. The spots have been released.</p>
            @else
                <div class="w-20 h-20 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h1 class="font-serif text-3xl text-stone-900 mb-2">Booking Confirmed!</h1>
                <p class="text-stone-500">Your place is reserved. Please save your reference number below.</p>
            @endif
        </div>

        {{-- Reference number --}}
        <div class="bg-gradient-to-r from-amber-50 to-amber-100/50 rounded-2xl border border-amber-200 p-8 text-center mb-8">
            <p class="text-sm text-stone-500 uppercase tracking-wider font-medium mb-2">Booking Reference</p>
            <p class="text-3xl sm:text-4xl font-mono font-bold text-stone-900 tracking-widest">{{ $booking->reference }}</p>
            <p class="text-xs text-stone-400 mt-3">Save this reference to manage your booking</p>
        </div>

        {{-- Booking details card --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden mb-8">
            <div class="px-6 py-4 bg-stone-50 border-b border-stone-200">
                <h2 class="font-semibold text-stone-900">Booking Details</h2>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="flex justify-between items-start">
                    <span class="text-sm text-stone-500">Event</span>
                    <span class="text-sm font-medium text-stone-900 text-right max-w-xs">{{ $booking->event->title }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Date</span>
                    <span class="text-sm font-medium text-stone-900">{{ $booking->event->formatted_date }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Time</span>
                    <span class="text-sm font-medium text-stone-900">{{ $booking->event->formatted_time }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Location</span>
                    <span class="text-sm font-medium text-stone-900">{{ $booking->event->location }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Name</span>
                    <span class="text-sm font-medium text-stone-900">{{ $booking->name }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Email</span>
                    <span class="text-sm font-medium text-stone-900">{{ $booking->email }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Tickets</span>
                    <span class="text-sm font-medium text-stone-900">{{ $booking->tickets }}</span>
                </div>
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between">
                    <span class="text-sm text-stone-500">Status</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                        {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-800' : '' }}
                        {{ $booking->status === 'cancelled' ? 'bg-stone-100 text-stone-600' : '' }}
                        {{ $booking->status === 'attended' ? 'bg-blue-100 text-blue-800' : '' }}
                    ">
                        {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                    </span>
                </div>
                @if($booking->special_requirements)
                <div class="border-t border-stone-100"></div>
                <div class="flex justify-between items-start">
                    <span class="text-sm text-stone-500">Special Requirements</span>
                    <span class="text-sm text-stone-900 text-right max-w-xs">{{ $booking->special_requirements }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('events.index') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-stone-900 hover:bg-stone-800 text-white font-medium rounded-xl transition-colors text-sm">
                Browse More Events
            </a>
            @if($booking->status === 'confirmed')
                <form method="POST" action="{{ route('bookings.cancel', $booking->reference) }}" class="flex-1"
                    onsubmit="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.')">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 border border-red-200 text-red-600 hover:bg-red-50 font-medium rounded-xl transition-colors text-sm">
                        Cancel Booking
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection
