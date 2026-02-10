<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'tickets' => 'required|integer|min:1|max:10',
            'special_requirements' => 'nullable|string|max:1000',
        ]);

        if ($event->status !== 'published') {
            return back()->with('error', 'This event is no longer available for booking.');
        }

        if ($event->spots_remaining < $validated['tickets']) {
            return back()->with('error', 'Sorry, there are not enough spots remaining for this event.')
                ->withInput();
        }

        $booking = DB::transaction(function () use ($event, $validated) {
            $event->lockForUpdate();

            if ($event->spots_remaining < $validated['tickets']) {
                return null;
            }

            $event->decrement('spots_remaining', $validated['tickets']);

            return Booking::create([
                'reference' => Booking::generateReference(),
                'event_id' => $event->id,
                'user_id' => Auth::id(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'tickets' => $validated['tickets'],
                'special_requirements' => $validated['special_requirements'] ?? null,
            ]);
        });

        if (!$booking) {
            return back()->with('error', 'Sorry, those spots were just taken. Please try again.')
                ->withInput();
        }

        return redirect()->route('bookings.confirmation', $booking->reference);
    }

    public function confirmation(string $reference)
    {
        $booking = Booking::where('reference', $reference)->with('event')->firstOrFail();
        return view('bookings.confirmation', compact('booking'));
    }

    public function cancel(Request $request, string $reference)
    {
        $booking = Booking::where('reference', $reference)->with('event')->firstOrFail();

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'This booking has already been cancelled.');
        }

        DB::transaction(function () use ($booking) {
            $booking->event->increment('spots_remaining', $booking->tickets);
            $booking->update(['status' => 'cancelled']);
        });

        return redirect()->route('bookings.confirmation', $booking->reference)
            ->with('success', 'Your booking has been successfully cancelled.');
    }

    public function lookup()
    {
        return view('bookings.lookup');
    }

    public function find(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string',
        ]);

        $booking = Booking::where('reference', strtoupper($validated['reference']))->with('event')->first();

        if (!$booking) {
            return back()->with('error', 'No booking found with that reference number.')
                ->withInput();
        }

        return redirect()->route('bookings.confirmation', $booking->reference);
    }
}
