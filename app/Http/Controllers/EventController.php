<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::published()->upcoming()->orderBy('start_date');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $featuredEvents = Event::published()->upcoming()->featured()
            ->orderBy('start_date')
            ->take(3)
            ->get();

        $events = $query->paginate(9);

        $categories = Event::published()->upcoming()
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('events.index', compact('events', 'featuredEvents', 'categories'));
    }

    public function show(Event $event)
    {
        if ($event->status !== 'published') {
            abort(404);
        }

        $relatedEvents = Event::published()
            ->upcoming()
            ->where('id', '!=', $event->id)
            ->where('category', $event->category)
            ->take(3)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }
}
