<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TrafficLog;


class DetectFlood
{
    public function handle(Request $request, Closure $next): Response
{
    $ip = $request->ip();
    $key = "flood:$ip";
    $count = Cache::increment($key);

    Cache::put($key, $count, now()->addSeconds(10));

    // Optional: log every N requests
    if ($count % 10 === 0) {
        TrafficLog::create([
            'ip' => $ip,
            'url' => $request->fullUrl(),
            'user_agent' => $request->userAgent(),
            'request_count' => $count
        ]);
    }

    if ($count > 50) {
        return response("Too many requests from $ip", 429);
    }

    return $next($request);
    
}

}
