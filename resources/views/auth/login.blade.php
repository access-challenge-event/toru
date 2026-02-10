@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
    <div class="max-w-md mx-auto px-4 sm:px-6 py-16 lg:py-24">
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-700 to-amber-900 flex items-center justify-center mx-auto mb-5 shadow-lg">
                <svg class="w-8 h-8 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>
                </svg>
            </div>
            <h1 class="font-serif text-3xl text-stone-900 mb-2">Welcome Back</h1>
            <p class="text-stone-500 text-sm">Sign in to your Delapre Abbey account</p>
        </div>

        <div class="bg-white rounded-2xl border border-stone-200 shadow-sm p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-stone-700 mb-1.5">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="you@example.com">
                    @error('email') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-stone-700 mb-1.5">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2.5 rounded-xl border border-stone-300 text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                        placeholder="••••••••">
                    @error('password') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-amber-600 focus:ring-amber-500">
                        <span class="text-sm text-stone-600">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-amber-600 hover:bg-amber-500 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    Sign In
                </button>
            </form>
        </div>

        <p class="text-center mt-6 text-sm text-stone-500">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-amber-700 hover:text-amber-800 font-medium">Create one</a>
        </p>
    </div>
@endsection
