<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstateMatter;
class EstateMatterController extends Controller
{
    public function index()
    {
        // Fetch only visible items, ordered by expiry date
        $matters = EstateMatter::where('view_status', true)
            ->orderBy('expiry_date', 'asc')
            ->get();

        return view('meetings', compact('matters'));
    }

    public function archived()
    {
        // Fetch only archived items, ordered by expiry date
     
        $matters = EstateMatter::with('documents')->where('view_status', false)->get();

        return view('archived', compact('matters'));
    }
}
