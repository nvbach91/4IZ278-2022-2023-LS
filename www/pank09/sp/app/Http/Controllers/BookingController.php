<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->is_admin)
            return view('booking.index', [
                'bookings' => Booking::with('owner', 'ticket', 'ticket.event')->paginate(15)
            ]);

        return view('booking.index', [
            'bookings' => Booking::own()->with('ticket', 'ticket.event')->paginate(15)
        ]);
    }

    public function store(Event $event, Ticket $ticket, Request $request)
    {
        $request->validate([
            'amount'  => 'required|integer|min:1',
        ]);

        if ($request->get('amount') > $ticket->remaining_amount)
            return redirect()->back()->withError(__('We have only :remaining of :type tickets.', ['remaining' => $ticket->remaining_amount, 'type' => $ticket->type]));

        $booking = $ticket->bookings()->create([
            'user_id' => auth()->id(),
            'amount' => $request->get('amount')
        ]);

        Mail::to(auth()->user()->email)->queue(new BookingConfirmation($booking));

        return redirect()->back()->withSuccess('You have successfully booked tickets!');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);

        $booking->delete();
        return redirect()->back()->withSuccess('Booking was successfully removed!');
    }
}
