<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Validation\Rule;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
       
        if ($request->filled('website_url')) {
         
            return redirect()->back()->with('success', 'Thank you for subscribing!');
        }

   
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('subscribers', 'email'), 
            ],
            'first_name' => 'required|string|max:100',
        ], [
            // Custom error messages
            'email.unique' => 'This email is already subscribed to our newsletter.',
        ]);

        // 3. Save to database
        Subscriber::create($validated);

        // 4. Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}