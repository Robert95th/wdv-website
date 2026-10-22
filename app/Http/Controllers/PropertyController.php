<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PropertyController extends Controller
{
    public function index()
    {
        $properties = PropertyListing::latest()->paginate(10);
        return view('admin.properties.index', compact('properties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:Residential,Farmland,Commercial,Vehicles,Movables,Other',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'auctioneer' => 'nullable|string|max:255',
            'date_and_time' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            // Change to validate an uploaded image file instead of a URL
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // 5MB Max
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // 10MB Max
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('properties/images', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        // Handle Document Upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_doc_' . $file->getClientOriginalName();
            $path = $file->storeAs('properties/documents', $filename, 'public');
            $validated['document_path'] = $path;
        }

        PropertyListing::create($validated);

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
    }

    public function update(Request $request, PropertyListing $property)
    {
        $validated = $request->validate([
            'category' => 'required|string|in:Residential,Farmland,Commercial,Vehicles,Movables,Other',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'auctioneer' => 'nullable|string|max:255',
            'date_and_time' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];

        // Handle New Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($property->image && Storage::disk('public')->exists($property->image)) {
                Storage::disk('public')->delete($property->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('properties/images', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        // Handle New Document Upload
        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($property->document_path && Storage::disk('public')->exists($property->document_path)) {
                Storage::disk('public')->delete($property->document_path);
            }

            $file = $request->file('document');
            $filename = time() . '_doc_' . $file->getClientOriginalName();
            $path = $file->storeAs('properties/documents', $filename, 'public');
            $validated['document_path'] = $path;
        }

        $property->update($validated);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(PropertyListing $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
