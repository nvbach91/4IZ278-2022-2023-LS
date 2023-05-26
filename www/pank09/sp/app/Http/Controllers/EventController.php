<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store', 'edit', 'update', 'destroy']);
        $this->middleware('is.admin')->only(['store', 'edit', 'update', 'destroy']);
    }

    public function index(Request $request)
    {
        $params = [];

        if ($request->has('search_query') && !empty($request->get('search_query'))) {
            $params = [
                'events' => Event::where('title', 'LIKE', '%'. $request->get('search_query') .'%')->nearest()->relevant()->paginate(5),
                'search_query' => $request->get('search_query')
            ];
        } else {
            $params = [
                'events' => Event::nearest()->relevant()->paginate(5)
            ];
        }

        return view('home', $params);
    }

    public function show(Event $event)
    {
        return view('event.show', [
            'event' => $event->load('tickets')
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|max:100',
            'datetime'      => 'required|date',
            'image'         => 'required|url|max:255',
            'place'         => 'required|max:255',
            'city'          => 'required|max:255',
            'country'       => 'required|max:255',
            'description'   => 'required',
        ]);

        Event::create($validated);

        return redirect()->route('home')->withSuccess('The new concert was successfully added!');
    }

    public function edit(Event $event)
    {
        $this->authorize('edit', $event);
        
        return view('event.edit', [
            'event' => $event
        ]);
    }

    public function update(Event $event, Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|max:100',
            'datetime'      => 'required|date',
            'image'         => 'required|url|max:255',
            'place'         => 'required|max:255',
            'city'          => 'required|max:255',
            'country'       => 'required|max:255',
            'description'   => 'required',
        ]);

        $event->update(
            array_merge($validated, [
                'lock_opened_by' => null,
                'lock_opened_at' => null
            ])
        );

        return redirect()->route('home')->withSuccess('The concert was successfully updated!');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->withSuccess('The event was successfully removed!');
    }
}