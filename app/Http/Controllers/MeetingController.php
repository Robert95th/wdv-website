<?php

namespace App\Http\Controllers;

use App\Models\EstateMatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class MeetingController extends Controller
{
    public function index()
    {
        // Fetch meetings sorted by the date (expiry_date acts as the meeting date)
        // You might want to only show view_status = 1 here if this is the public page!
        $meetings = EstateMatter::orderBy('expiry_date', 'asc')->paginate(10);

        return view('meetings.index', compact('meetings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estate_matter' => 'required|string|max:255',
            'reference' => 'required|string|max:50',
            'status' => 'required|string|max:255',
            'next_action' => 'required|string|max:255',
            'date_and_venue' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];

        // Handle File Upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            // Store in public/storage/documents
            $path = $file->storeAs('documents', $filename, 'public');
            $validated['document_path'] = $path;
        }

        EstateMatter::create($validated);

        return redirect()->route('admin.meetings.index')->with('success', 'Estate created successfully.');
    }

    // Inside your update() method:
    public function update(Request $request, EstateMatter $meeting)
    {
        $validated = $request->validate([
            'estate_matter' => 'required|string|max:255',
            'reference' => 'required|string|max:50',
            'status' => 'required|string|max:255',
            'next_action' => 'required|string|max:255',
            'date_and_venue' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];

        // Handle File Upload
        if ($request->hasFile('document')) {
            // Delete old file if it exists
            if ($meeting->document_path && Storage::disk('public')->exists($meeting->document_path)) {
                Storage::disk('public')->delete($meeting->document_path);
            }

            $file = $request->file('document');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename, 'public');
            $validated['document_path'] = $path;
        }

        $meeting->update($validated);

        return redirect()->route('admin.meetings.index')->with('success', 'Estate updated successfully.');
    }
    public function destroy(EstateMatter $meeting)
    {
        $meeting->delete();

        return redirect()->route('admin.meetings.index')->with('success', 'Estate/Meeting deleted successfully.');
    }
}
