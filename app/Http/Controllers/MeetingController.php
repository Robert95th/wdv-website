<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EstateMatter;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch meetings sorted by the date (expiry_date acts as the meeting date)
        $meetings = EstateMatter::orderBy('expiry_date', 'asc')->paginate(10);
        
        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'estate_matter' => 'required|string|max:255',
            'reference' => 'required|string|max:50',
            'status' => 'required|string|max:255',
            'next_action' => 'required|string|max:255',
            'date_and_venue' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'file_link' => 'nullable|url|max:500',
        ]);

        // 2. Handle checkbox (view_status)
        // If the checkbox is checked, it sends '1', otherwise it's not in the request.
        $validated['view_status'] = $request->has('view_status');

        // 3. Save
        EstateMatter::create($validated);

        // 4. Redirect
        return redirect()->route('meetings.index')->with('success', 'Estate/Meeting created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EstateMatter $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EstateMatter $meeting)
    {
        // 1. Validate
        $validated = $request->validate([
            'estate_matter' => 'required|string|max:255',
            'reference' => 'required|string|max:50',
            'status' => 'required|string|max:255',
            'next_action' => 'required|string|max:255',
            'date_and_venue' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'file_link' => 'nullable|url|max:500',
        ]);

        // 2. Handle checkbox
        $validated['view_status'] = $request->has('view_status');

        // 3. Update
        $meeting->update($validated);

        // 4. Redirect
        return redirect()->route('meetings.index')->with('success', 'Estate/Meeting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EstateMatter $meeting)
    {
        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'Estate/Meeting deleted successfully.');
    }
}