<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyListing;
use App\Models\PropertyImage; // Add this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageCompressor;

class PropertyController extends Controller
{
    public function index()
    {
        // Load the properties with their images so the table can show thumbnails
        $properties = PropertyListing::with('images')->latest()->paginate(10);
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
            // Validate multiple images (array)
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];

        // 1. Create the Property first
        $property = PropertyListing::create($validated);

        // 2. Handle Multiple Image Uploads & Compression
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                // Compress and store the image using our helper
                $imagePath = ImageCompressor::compressAndStore($file);

                // Save to the new property_images table
                PropertyImage::create([
                    'property_listing_id' => $property->id,
                    'image_path' => $imagePath,
                    'is_primary' => $index === 0, // Make the first image the primary one
                ]);
            }
        }

        // 3. Handle Document Upload
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = time() . '_doc_' . $file->getClientOriginalName();
            $path = $file->storeAs('properties/documents', $filename, 'public');
            $property->update(['document_path' => $path]);
        }

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
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];

        // 1. Update basic property details
        $property->update($validated);

        // 2. Handle New Image Uploads (Append to existing)
        if ($request->hasFile('images')) {
            // Check if the property already has a primary image
            $hasPrimary = $property->images()->where('is_primary', true)->exists();

            foreach ($request->file('images') as $index => $file) {
                $imagePath = ImageCompressor::compressAndStore($file);

                PropertyImage::create([
                    'property_listing_id' => $property->id,
                    'image_path' => $imagePath,
                    // If no primary exists, make the first newly uploaded one primary
                    'is_primary' => (!$hasPrimary && $index === 0),
                ]);
            }
        }

        // 3. Handle New Document Upload
        if ($request->hasFile('document')) {
            // Delete old document if exists
            if ($property->document_path && Storage::disk('public')->exists($property->document_path)) {
                Storage::disk('public')->delete($property->document_path);
            }

            $file = $request->file('document');
            $filename = time() . '_doc_' . $file->getClientOriginalName();
            $path = $file->storeAs('properties/documents', $filename, 'public');
            $property->update(['document_path' => $path]);
        }

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(PropertyListing $property)
    {
        // 1. Delete all associated images from storage and database
        foreach ($property->images as $img) {
            if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        // 2. Delete the document if it exists
        if ($property->document_path && Storage::disk('public')->exists($property->document_path)) {
            Storage::disk('public')->delete($property->document_path);
        }

        // 3. Delete the property itself
        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Property and all associated media deleted successfully.');
    }
    public function destroyImage(\App\Models\PropertyImage $image)
    {
        // Delete physical file
        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($image->image_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
        }

        // Delete database record
        $image->delete();

        return back()->with('success', 'Image removed successfully.');
    }
}
