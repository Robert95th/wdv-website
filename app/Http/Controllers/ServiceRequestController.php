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
            'preferred_datetime' => [
                'required',
                'date',
                'after:today', // Must be tomorrow or later
                function ($attribute, $value, $fail) {
                    $time = \Carbon\Carbon::parse($value)->format('H:i');
                    if ($time < '08:00' || $time > '17:00') {
                        $fail('The preferred time must be between 08:00 AM and 05:00 PM.');
                    }
                },
            ],
            'website_url' => 'nullable|string',
        ]);


        ServiceRequest::create($validated);


        return redirect()->back()->with('success', 'Your request has been submitted successfully. We will contact you shortly.');
    }
}
