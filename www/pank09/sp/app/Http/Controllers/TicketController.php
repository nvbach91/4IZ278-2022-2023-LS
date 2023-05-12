<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is.admin')->only(['store', 'edit', 'update', 'destroy']);
    }
    
    public function store(Event $event, Request $request)
    {
        $validated = $request->validate([
            'type'              => 'required|max:50',
            'price'             => 'required|decimal:0,2|max:999999.99',
            'available_amount'  => 'required|integer|min:1|max:25000',
        ]);

        $event->tickets()->create($validated);

        return redirect()->route('event', $event->id)->withSuccess('The new ticket was successfully added!');
    }

    public function edit(Event $event, Ticket $ticket)
    {
        $this->authorize('edit', $ticket);

        return view('ticket.edit', [
            'event' => $event,
            'ticket' => $ticket
        ]);
    }

    public function update(Event $event, Ticket $ticket,  Request $request)
    {
        $validated = $request->validate([
            'type'              => 'required|max:50',
            'price'             => 'required|decimal:0,2|max:999999.99',
            'available_amount'  => 'required|integer|min:1|max:25000',
        ]);

        $ticket->update($validated);

        return redirect()->route('event', $event->id)->withSuccess('The ticket was successfully updated!');
    }

    public function destroy(Event $event, Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->withSuccess('The ticket was successfully removed!');
    }
}