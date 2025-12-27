<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Location;
use App\Models\Contact;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['location', 'contact'])->latest()->paginate(10);
        $locations = Location::all();
        $contacts = Contact::all();
        return view('events.index', compact('events', 'locations', 'contacts'));
    }

    public function create()
    {
        // Not used if using modal on index, but good to have
        return view('events.create');
    }

    public function store(Request $request)
    {
        // Ensure empty strings are treated as null before validation
        $request->merge([
            'location_id' => $request->location_id ?: null,
            'contact_id' => $request->contact_id ?: null,
        ]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
            'location_id' => 'nullable|exists:locations,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'status' => 'required|in:planificado,confirmado',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
