<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Delapre Abbey') — Delapre Abbey Events</title>
    <meta name="description" content="@yield('meta_description', 'Discover and book free public events at Delapre Abbey, Northampton. Heritage tours, family activities, exhibitions and more.')">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|dm-serif-display:400,400i" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-stone-50 text-stone-900 min-h-screen flex flex-col">
    {{-- Navigation --}}
    <nav class="bg-white/80 backdrop-blur-md border-b border-stone-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl bg-gradient-to-br from-amber-700 to-amber-900 flex items-center justify-center shadow-md group-hover:shadow-lg transition-shadow">
                        <svg class="w-6 h-6 lg:w-7 lg:h-7 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-serif text-xl lg:text-2xl font-normal text-stone-900 tracking-tight">Delapre Abbey</span>
                        <span class="hidden sm:block text-xs text-stone-500 tracking-wide uppercase">Events & Booking</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-900' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                        Home
                    </a>
                    <a href="{{ route('events.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('events.*') ? 'bg-amber-50 text-amber-900' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                        Events
                    </a>
                    <a href="{{ route('bookings.lookup') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('bookings.lookup') ? 'bg-amber-50 text-amber-900' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                        My Booking
                    </a>
                    @auth
                        @if(Auth::user()->isStaff())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('admin.*') ? 'bg-amber-50 text-amber-900' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                            Staff
                        </a>
                        @endif
                    @endauth

                    <div class="w-px h-6 bg-stone-200 mx-2"></div>

                    @auth
                        <a href="{{ route('profile.show') }}" class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('profile.*') ? 'bg-amber-50 text-amber-900' : 'text-stone-600 hover:text-stone-900 hover:bg-stone-100' }}">
                            <span class="flex items-center gap-2">
                                <span class="w-6 h-6 rounded-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                {{ Auth::user()->name }}
                            </span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium text-stone-500 hover:text-stone-700 hover:bg-stone-100 transition-colors">
                                Sign Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-stone-600 hover:text-stone-900 hover:bg-stone-100 transition-colors">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-amber-600 hover:bg-amber-500 text-white rounded-lg text-sm font-medium transition-colors shadow-sm">
                            Register
                        </a>
                    @endauth
                </div>

                {{-- Mobile menu button --}}
                <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden p-2 rounded-lg text-stone-500 hover:bg-stone-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div id="mobile-menu" class="hidden md:hidden pb-4 border-t border-stone-100 mt-2 pt-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'bg-amber-50 text-amber-900' : 'text-stone-600' }}">Home</a>
                <a href="{{ route('events.index') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('events.*') ? 'bg-amber-50 text-amber-900' : 'text-stone-600' }}">Events</a>
                <a href="{{ route('bookings.lookup') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('bookings.lookup') ? 'bg-amber-50 text-amber-900' : 'text-stone-600' }}">My Booking</a>
                @auth
                    @if(Auth::user()->isStaff())
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('admin.*') ? 'bg-amber-50 text-amber-900' : 'text-stone-600' }}">Staff</a>
                    @endif
                    <div class="border-t border-stone-100 my-2"></div>
                    <a href="{{ route('profile.show') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('profile.*') ? 'bg-amber-50 text-amber-900' : 'text-stone-600' }}">
                        <span class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-white text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            My Profile
                        </span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2.5 rounded-lg text-sm font-medium text-stone-500 hover:text-stone-700">Sign Out</button>
                    </form>
                @else
                    <div class="border-t border-stone-100 my-2"></div>
                    <a href="{{ route('login') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-stone-600">Sign In</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2.5 rounded-lg text-sm font-medium text-amber-700">Create Account</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-5 py-4 flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-xl px-5 py-4 flex items-center gap-3">
                <svg class="w-5 h-5 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    {{-- Main content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-stone-900 text-stone-300 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-600 to-amber-800 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6"/>
                            </svg>
                        </div>
                        <span class="font-serif text-xl text-white">Delapre Abbey</span>
                    </div>
                    <p class="text-sm text-stone-400 leading-relaxed">
                        A stunning historic venue in the heart of Northampton, hosting events and welcoming visitors since the 12th century.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Quick Links</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('events.index') }}" class="hover:text-amber-400 transition-colors">Upcoming Events</a></li>
                        <li><a href="{{ route('bookings.lookup') }}" class="hover:text-amber-400 transition-colors">Find My Booking</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-amber-400 transition-colors">Sign In</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Visit Us</h3>
                    <ul class="space-y-2.5 text-sm text-stone-400">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            London Road, Northampton, NN4 8AW
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            events@delapreabbey.org
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-stone-800 mt-10 pt-8 text-center text-xs text-stone-500">
                &copy; {{ date('Y') }} Delapre Abbey. All rights reserved.
            </div>
        </div>
    </footer>
</body>
</html>
