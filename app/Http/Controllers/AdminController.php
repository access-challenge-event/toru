<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_events' => Event::count(),
            'published_events' => Event::published()->count(),
            'upcoming_events' => Event::published()->upcoming()->count(),
            'total_bookings' => Booking::where('status', 'confirmed')->count(),
            'total_attendees' => Booking::where('status', 'confirmed')->sum('tickets'),
        ];

        $upcomingEvents = Event::published()
            ->upcoming()
            ->withCount(['bookings' => fn ($q) => $q->where('status', 'confirmed')])
            ->orderBy('start_date')
            ->take(10)
            ->get();

        $recentBookings = Booking::with('event')
            ->where('status', 'confirmed')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'upcomingEvents', 'recentBookings'));
    }

    public function events()
    {
        $events = Event::withCount(['bookings' => fn ($q) => $q->where('status', 'confirmed')])
            ->orderBy('start_date', 'desc')
            ->paginate(15);

        return view('admin.events', compact('events'));
    }

    public function eventBookings(Event $event)
    {
        $bookings = $event->bookings()->latest()->paginate(20);
        return view('admin.event-bookings', compact('event', 'bookings'));
    }
}
