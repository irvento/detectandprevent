<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ReportsController extends Controller
{
    public function index()
    {
        // Define today's date for regular daily counts
        $today = Carbon::today();
        // Daily summary counts
        $usersTodayCount = DB::table('users')
            ->whereDate('created_at', $today)
            ->count();
        $failedAttemptsTodayCount = DB::table('log')
            ->where('Description', 'like', '%Failed login attempt%')
            ->whereDate('created_at', $today)
            ->count();
        $loginCountToday = DB::table('log')
            ->where('Description', 'like', '%logged in%')
            ->whereDate('created_at', $today)
            ->count();
        $incidentsTodayCount = DB::table('incidents')
            ->whereDate('created_at', $today)
            ->count();
        // Now assess for potential attacks in a very recent timeframe (e.g., the last minute)
        $oneMinuteAgo = Carbon::now()->subMinute();
        // Count recent failed login attempts (brute force indicator)
        $failedRecentAttempts = DB::table('log')
            ->where('Description', 'like', '%Failed login attempt%')
            ->where('created_at', '>=', $oneMinuteAgo)
            ->count();
        // Count distinct users who have logged in recently (potential DDoS indicator)
        $distinctRecentUsers = DB::table('log')
            ->where('Description', 'like', '%logged in%')
            ->where('created_at', '>=', $oneMinuteAgo)
            ->distinct('user_id')
            ->count('user_id');
        // Define thresholds (you can adjust these numbers based on normal traffic)
        $failedAttemptsThreshold = 20;
        $distinctUsersThreshold = 10;
        $isBruteforce = $failedRecentAttempts >= $failedAttemptsThreshold;
        $isPossibleDdos = $distinctRecentUsers >= $distinctUsersThreshold;
        return view('report', compact(
            'usersTodayCount',
            'failedAttemptsTodayCount',
            'loginCountToday',
            'incidentsTodayCount',
            'failedRecentAttempts',
            'distinctRecentUsers',
            'isBruteforce',
            'isPossibleDdos'
        ));
    }
}