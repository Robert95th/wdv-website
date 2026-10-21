<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstateMatterController extends Controller
{
    public function index()
    {
        // Fetch only visible items, ordered by expiry date
        $matters = \App\Models\EstateMatter::where('view_status', true)
            ->orderBy('expiry_date', 'asc')
            ->get();

        return view('meetings', compact('matters'));
    }
}
