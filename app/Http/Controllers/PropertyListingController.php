<?php

namespace App\Http\Controllers;

use App\Models\PropertyListing;
use Illuminate\Http\Request;

class PropertyListingController extends Controller
{
   

public function index()
{
    $listings = PropertyListing::latest()->get();
    
    // Calculate counts for the filter pills
    $categories = ['Residential', 'Farmland', 'Commercial', 'Vehicles', 'Movables', 'Other'];
    $counts = [];
    foreach ($categories as $cat) {
        $counts[$cat] = $listings->where('category', $cat)->count();
    }
    $counts['All'] = $listings->count();

    return view('properties', compact('listings', 'categories', 'counts'));
}
}
