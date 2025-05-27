<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Incident;
use Illuminate\Support\Facades\Auth;

class LogUnauthorizedDashboardAccess
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('dashboard') && !Auth::check()) {
            Incident::create([
                'type' => 'unauthorized_dashboard_access',
                'description' => 'Unauthorized access attempt to /dashboard',
                'user_id' => null,
                'ip' => $request->ip(),
                'status' => 'open',
            ]);
        }

        return $next($request);
    }
}