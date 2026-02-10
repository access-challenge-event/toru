{{-- Event Card Component --}}
<a href="{{ route('events.show', $event->slug) }}" class="group block bg-white rounded-2xl border border-stone-200 overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
    {{-- Image placeholder --}}
    <div class="relative h-48 sm:h-52 bg-gradient-to-br from-amber-100 via-stone-100 to-amber-50 overflow-hidden">
        @if($event->image)
            <img src="{{ $event->image }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="absolute inset-0 flex items-center justify-center">
                <svg class="w-16 h-16 text-amber-300/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01M9 13h.01M15 13h.01"/>
                </svg>
            </div>
        @endif

        {{-- Category badge --}}
        <div class="absolute top-3 left-3">
            <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wide
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

        {{-- Featured badge --}}
        @if(isset($featured) && $featured)
        <div class="absolute top-3 right-3">
            <span class="px-2.5 py-1 rounded-full bg-amber-400 text-amber-950 text-xs font-bold uppercase tracking-wide flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                Featured
            </span>
        </div>
        @endif

        {{-- Availability indicator --}}
        @if($event->is_full)
        <div class="absolute bottom-3 right-3">
            <span class="px-3 py-1 rounded-full bg-red-600 text-white text-xs font-semibold">Fully Booked</span>
        </div>
        @elseif($event->spots_remaining <= 10)
        <div class="absolute bottom-3 right-3">
            <span class="px-3 py-1 rounded-full bg-orange-500 text-white text-xs font-semibold">{{ $event->spots_remaining }} spots left</span>
        </div>
        @endif
    </div>

    {{-- Card content --}}
    <div class="p-5 sm:p-6">
        {{-- Date --}}
        <div class="flex items-center gap-2 text-sm text-amber-700 font-medium mb-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $event->start_date->format('D, j M Y') }}
            <span class="text-stone-300">·</span>
            {{ $event->start_date->format('g:ia') }}
        </div>

        {{-- Title --}}
        <h3 class="font-semibold text-lg text-stone-900 group-hover:text-amber-800 transition-colors mb-2 line-clamp-2">
            {{ $event->title }}
        </h3>

        {{-- Description --}}
        <p class="text-stone-500 text-sm leading-relaxed line-clamp-2 mb-4">
            {{ $event->short_description ?? Str::limit($event->description, 120) }}
        </p>

        {{-- Footer --}}
        <div class="flex items-center justify-between pt-4 border-t border-stone-100">
            <div class="flex items-center gap-1.5 text-xs text-stone-400">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                {{ $event->location }}
            </div>
            <span class="text-xs font-semibold {{ $event->is_free ? 'text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full' : 'text-stone-700' }}">
                {{ $event->is_free ? 'Free' : '£' . number_format($event->price, 2) }}
            </span>
        </div>
    </div>
</a>
