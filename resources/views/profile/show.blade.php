@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="bg-gradient-to-b from-stone-100 to-stone-50 border-b border-stone-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">
            <h1 class="font-serif text-3xl text-stone-900 mb-1">My Profile</h1>
            <p class="text-stone-500">Manage your account details and view your bookings</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12 space-y-8">
        {{-- Profile Info Card --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-stone-50 border-b border-stone-200 flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-stone-900">Personal Information</h2>
                    <p class="text-xs text-stone-500 mt-0.5">Update your name, email and contact details</p>
                </div>
                <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $user->isStaff() ? 'bg-amber-100 text-amber-800' : 'bg-stone-100 text-stone-600' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all">
                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-stone-700 mb-1.5">Phone Number <span class="text-stone-400 font-normal">(optional)</span></label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="07xxx xxxxxx">
                        @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-end">
                        <div class="text-sm text-stone-500">
                            <p>Member since <span class="font-medium text-stone-700">{{ $user->created_at->format('j F Y') }}</span></p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-amber-600 hover:bg-amber-500 text-white font-medium text-sm rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Change Password Card --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-stone-50 border-b border-stone-200">
                <h2 class="font-semibold text-stone-900">Change Password</h2>
                <p class="text-xs text-stone-500 mt-0.5">Update your password to keep your account secure</p>
            </div>
            <form method="POST" action="{{ route('profile.password') }}" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-stone-700 mb-1.5">Current Password</label>
                        <input type="password" id="current_password" name="current_password" required
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="••••••••">
                        @error('current_password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-stone-700 mb-1.5">New Password</label>
                        <input type="password" id="new_password" name="password" required
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="At least 8 characters">
                        @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-stone-700 mb-1.5">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-stone-900 hover:bg-stone-800 text-white font-medium text-sm rounded-xl transition-all duration-200 shadow-sm hover:shadow-md">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        {{-- Booking History --}}
        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-stone-50 border-b border-stone-200">
                <h2 class="font-semibold text-stone-900">My Bookings</h2>
                <p class="text-xs text-stone-500 mt-0.5">Your event booking history</p>
            </div>

            @if($bookings->count())
                <div class="divide-y divide-stone-100">
                    @foreach($bookings as $booking)
                    <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6 hover:bg-stone-50 transition-colors">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="text-sm font-medium text-stone-900 truncate">{{ $booking->event->title }}</h3>
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-semibold shrink-0
                                    {{ $booking->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                    {{ $booking->status === 'cancelled' ? 'bg-stone-100 text-stone-500' : '' }}
                                    {{ $booking->status === 'attended' ? 'bg-blue-100 text-blue-700' : '' }}
                                    {{ $booking->status === 'no_show' ? 'bg-red-100 text-red-700' : '' }}
                                ">{{ ucfirst(str_replace('_', ' ', $booking->status)) }}</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-stone-500">
                                <span>{{ $booking->event->start_date->format('D, j M Y') }}</span>
                                <span>{{ $booking->tickets }} {{ $booking->tickets === 1 ? 'ticket' : 'tickets' }}</span>
                                <span class="font-mono text-stone-400">{{ $booking->reference }}</span>
                            </div>
                        </div>
                        <a href="{{ route('bookings.confirmation', $booking->reference) }}" class="text-xs font-medium text-amber-700 hover:text-amber-800 shrink-0 transition-colors">
                            View →
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <div class="w-14 h-14 rounded-2xl bg-stone-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/></svg>
                    </div>
                    <p class="text-sm text-stone-500 mb-4">You haven't made any bookings yet.</p>
                    <a href="{{ route('events.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-600 hover:bg-amber-500 text-white text-sm font-medium rounded-xl transition-colors">
                        Browse Events
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
