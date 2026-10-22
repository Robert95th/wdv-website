<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PropertyListing;
use Illuminate\Http\Request;

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
            'image' => 'nullable|url|max:500',
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];
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
            'image' => 'nullable|url|max:500',
            'view_status' => 'required|boolean',
        ]);

        $validated['view_status'] = (bool) $validated['view_status'];
        $property->update($validated);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(PropertyListing $property)
    {
        $property->delete();
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}