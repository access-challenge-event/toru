@extends('layouts.app')

@section('title', 'Find My Booking')

@section('content')
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
        <div class="text-center mb-10">
            <div class="w-16 h-16 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <h1 class="font-serif text-3xl text-stone-900 mb-3">Find My Booking</h1>
            <p class="text-stone-500">Enter your booking reference number to view or manage your booking.</p>
        </div>

        <form method="POST" action="{{ route('bookings.find') }}" class="bg-white rounded-2xl border border-stone-200 shadow-sm p-8">
            @csrf
            <div class="mb-6">
                <label for="reference" class="block text-sm font-medium text-stone-700 mb-2">Booking Reference</label>
                <input type="text" id="reference" name="reference" value="{{ old('reference') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-stone-300 text-sm font-mono text-center tracking-widest uppercase focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-lg"
                    placeholder="DA-XXXXXXXX">
                @error('reference') <p class="text-red-600 text-xs mt-2 text-center">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="w-full px-6 py-3.5 bg-amber-600 hover:bg-amber-500 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                Look Up Booking
            </button>
        </form>

        <p class="text-center mt-6 text-xs text-stone-400">
            Your booking reference was provided when you made your booking.<br>
            It starts with <span class="font-mono font-medium">DA-</span> followed by 8 characters.
        </p>
    </div>
@endsection
