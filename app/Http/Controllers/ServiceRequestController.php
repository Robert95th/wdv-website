<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled('website_url')) {
            abort(403, 'Bot detected.');
        }
        $validated = $request->validate([
           
            'service' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'preferred_datetime' => 'nullable|date',
            'website_url' => 'nullable|string',
        ]);


        ServiceRequest::create($validated);


        return redirect()->back()->with('success', 'Your request has been submitted successfully. We will contact you shortly.');
    }
}
