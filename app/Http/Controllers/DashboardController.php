<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Location;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $eventsCount = Event::count();
        $locationsCount = Location::count();
        $contactsCount = Contact::count();
        $eventsThisMonth = Event::whereMonth('date', now()->month)->count();

        $upcomingEvents = Event::where('date', '>=', now())
            ->orderBy('date')
            ->orderBy('time')
            ->take(3)
            ->get();

        $recentContacts = Contact::latest()->take(4)->get();

        // Chart Data - Events per month (Database agnostic)
        $driver = \Illuminate\Support\Facades\DB::connection()->getDriverName();
        
        if ($driver === 'sqlite') {
            $monthExpression = 'strftime("%m", date)';
        } elseif ($driver === 'pgsql') {
            $monthExpression = "TO_CHAR(date, 'MM')";
        } else {
            // mysql and others
            $monthExpression = 'DATE_FORMAT(date, "%m")';
        }

        $eventsPerMonth = Event::selectRaw("{$monthExpression} as month, count(*) as count")
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();
        
        // Fill missing months with 0
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
            $monthlyData[] = $eventsPerMonth[$month] ?? 0;
        }

        // Chart Data - Status
        $statusCounts = Event::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        // Order: Confirmado, Planificado, Cancelado
        $statusData = [
            $statusCounts['confirmado'] ?? 0,
            $statusCounts['planificado'] ?? 0,
            0 // Cancelados placeholder
        ];

        return view('dashboard', compact(
            'eventsCount', 
            'locationsCount', 
            'contactsCount', 
            'eventsThisMonth', 
            'upcomingEvents', 
            'recentContacts',
            'monthlyData',
            'statusData'
        ));
    }
}
