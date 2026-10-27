<?php

namespace App\Http\Controllers;

use App\Models\PropertyListing;
use Illuminate\Http\Request;

class PropertyListingController extends Controller
{


    public function index()
    {
        
        $properties = PropertyListing::with('images')->where('view_status', true)->latest()->get();


        $listings = $properties->map(function ($property) {
            return [
                'id' => $property->id,
                'title' => $property->title,
                'description' => $property->description,
                'category' => $property->category,
                'auctioneer' => $property->auctioneer,
                'date_and_time' => $property->date_and_time,
                'venue' => $property->venue,
                // Get all images, use the first one as the main card thumbnail
                'image' => $property->images->first() ? $property->images->first()->image_path : null,
                // Send the full array of images for the modal gallery
                'all_images' => $property->images->map(function ($img) {
                    return asset('storage/' . $img->image_path);
                })->toArray(),
            ];
        });

  
        $categories = $properties->pluck('category')->unique()->values();
        $counts = ['All' => $properties->count()];
        foreach ($categories as $cat) {
            $counts[$cat] = $properties->where('category', $cat)->count();
        }

        return view('properties', compact('listings', 'categories', 'counts'));
    }
}
