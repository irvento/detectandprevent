<?php
   namespace App\Http\Controllers;
   use Illuminate\Support\Facades\DB;
   use Carbon\Carbon;
   class GraphController extends Controller
   {
       public function index()
       {
           // Define the current week range. Adjust if needed.
           $startOfWeek = Carbon::now()->startOfWeek();
           $endOfWeek   = Carbon::now()->endOfWeek();
           // Query for traffic data: count all log entries per day.
           $logs = DB::table('log')
               ->select(DB::raw("DAYNAME(created_at) as day"), DB::raw("COUNT(*) as total"))
               ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
               ->groupBy('day')
               ->pluck('total', 'day')
               ->toArray();
           // Ensure the days are in a set order.
           $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
           $trafficLabels = $weekDays;
           $trafficData = [];
           foreach ($weekDays as $day) {
               $trafficData[] = array_key_exists($day, $logs) ? $logs[$day] : 0;
           }
           // Query for failed attempts; make sure your log table really has entries with a failed attempt identifier.
           $failedLogs = DB::table('log')
               ->select(DB::raw("DAYNAME(created_at) as day"), DB::raw("COUNT(*) as total"))
               ->where('Description', 'like', '%Failed login attempt%')
               ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
               ->groupBy('day')
               ->pluck('total', 'day')
               ->toArray();
           $failedGraphLabels = $weekDays;
           $failedGraphData = [];
           foreach ($weekDays as $day) {
               $failedGraphData[] = array_key_exists($day, $failedLogs) ? $failedLogs[$day] : 0;
           }
           // Optionally, fetch all failed attempt records for the table.
           $failedAttemptsRecords = DB::table('log')
               ->where('Description', 'like', '%Failed login attempt%')
               ->orderBy('created_at', 'desc')
               ->paginate(10);
           return view('graphs', compact(
               'trafficLabels',
               'trafficData',
               'failedGraphLabels',
               'failedGraphData',
               'failedAttemptsRecords'
           ));
       }
   }