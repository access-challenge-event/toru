@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
    <div class="max-w-md mx-auto px-4 sm:px-6 py-16 lg:py-24">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-700 to-amber-900 flex items-center justify-center mx-auto mb-5 shadow-lg">
                <svg class="w-8 h-8 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>
                </svg>
            </div>
            <h1 class="font-serif text-3xl text-stone-900 mb-2">Create Account</h1>
            <p class="text-stone-500 text-sm">Join us to book events at Delapre Abbey</p>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-8">
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-stone-700 mb-1.5">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="Your full name">
                    @error('name') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="you@example.com">
                    @error('email') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-stone-700 mb-1.5">Phone <span class="text-stone-400 font-normal">(optional)</span></label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="07xxx xxxxxx">
                    @error('phone') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="At least 8 characters">
                    @error('password') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-stone-700 mb-1.5">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="Repeat your password">
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    Create Account
                </button>
            </form>
        </div>

        <p class="text-center mt-6 text-sm text-stone-500">
            Already have an account?
            <a href="{{ route('login') }}" class="text-amber-700 hover:text-amber-800 font-medium">Sign in</a>
        </p>
    </div>
@endsection
