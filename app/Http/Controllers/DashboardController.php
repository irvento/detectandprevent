<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DashboardController extends Controller
{
    public function index()
    {
        // Define date range for the current week (Monday to Sunday)
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek   = Carbon::now()->endOfWeek();
        // All log entries by day (traffic data)
        $logs = DB::table('log')
            ->select(DB::raw("DAYNAME(created_at) as day"), DB::raw("COUNT(*) as total"))
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();
        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $trafficLabels = $weekDays;
        $trafficData = [];
        foreach ($weekDays as $day) {
            $trafficData[] = isset($logs[$day]) ? $logs[$day] : 0;
        }
        // Failed login attempts graph: Filter log records by “Failed login attempt”
        $failedLogs = DB::table('log')
            ->select(DB::raw("DAYNAME(created_at) as day"), DB::raw("COUNT(*) as total"))
            ->where('Description', 'like', '%Failed login attempt%')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('day')
            ->pluck('total', 'day')
            ->toArray();
        $failedGraphLabels = $weekDays;  // even if no data for a day, show label
        $failedGraphData = [];
        foreach ($weekDays as $day) {
            $failedGraphData[] = isset($failedLogs[$day]) ? $failedLogs[$day] : 0;
        }
        // Get records for failed attempts to display in a table (all-time or within a period)
        $failedAttemptsRecords = DB::table('log')
            ->where('Description', 'like', '%Failed login attempt%')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', compact(
            'trafficLabels', 
            'trafficData',
            'failedGraphLabels',
            'failedGraphData',
            'failedAttemptsRecords'
        ));
    }
}