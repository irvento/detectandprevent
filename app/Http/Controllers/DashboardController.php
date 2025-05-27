<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        // Determine the current week's start (Monday) and end (Sunday)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();
        // Query the log table to count the number of log entries per day in the current week.
        // We use MySQL's DAYNAME() to get the name of the day.
        $logs = DB::table('log')
            ->select(DB::raw("DAYNAME(created_at) as day"), DB::raw("COUNT(*) as total"))
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();
        // Define the week days in order. This ensures that even if a particular day has no logs,
        // that day still appears in the final output.
        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $trafficLabels = $weekDays;
        $trafficData = [];
        foreach ($weekDays as $day) {
            $trafficData[] = isset($logs[$day]) ? $logs[$day] : 0;
        }
        // Pass the traffic data arrays to the dashboard view
        return view('dashboard', compact('trafficLabels', 'trafficData'));
    }
}