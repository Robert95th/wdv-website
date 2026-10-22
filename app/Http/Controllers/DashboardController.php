<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstateMatter;
use App\Models\ServiceRequest;
use App\Models\PropertyListing;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Get counts for the metrics
        $totalMeetings = EstateMatter::count();
        
        // Count meetings happening this month (using expiry_date as the meeting date)
        $meetingsThisMonth = EstateMatter::whereMonth('expiry_date', Carbon::now()->month)
            ->whereYear('expiry_date', Carbon::now()->year)
            ->count();
            
        $totalProperties = PropertyListing::count();
        $totalRequests = ServiceRequest::count();
        
        // 2. Get the latest 5 service requests
        $latestRequests = ServiceRequest::latest()->take(5)->get();

        // 3. Get the next 5 upcoming meetings (only those in the future)
        $upcomingMeetings = EstateMatter::where('expiry_date', '>=', Carbon::today())
            ->orderBy('expiry_date', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMeetings', 
            'meetingsThisMonth', 
            'totalProperties', 
            'totalRequests', 
            'latestRequests', 
            'upcomingMeetings'
        ));
    }
}