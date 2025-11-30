<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Display a listing of events
    public function index()
    {
        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    // Show the form for creating a new event
    public function create()
    {
        return view('admin.events.create');
    }

    // Store a newly created event in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'photo' => 'nullable|image|max:2048',
            'participants' => 'required',
            'duration' => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('events', 'public');
            $validated['photo'] = $path;
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil ditambahkan!');
    }

    // Display the specified event
    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    // Show the form for editing the specified event
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // Update the specified event in storage
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'location' => 'required',
            'photo' => 'nullable|image|max:2048',
            'participants' => 'required',
            'duration' => 'required'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('events', 'public');
            $validated['photo'] = $path;
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil diupdate!');
    }

    // Remove the specified event from storage
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event berhasil dihapus!');
    }
}