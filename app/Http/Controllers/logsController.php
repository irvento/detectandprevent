<?php

namespace App\Http\Controllers;

use App\Models\logsModel;
use Illuminate\Http\Request;
use App\Models\ErrorLog;
use Illuminate\Support\Facades\Http;
use App\Models\Incident;

class logsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10; // Number of items per page

        $logs = logsModel::where('device', '!=', 'git')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        $errorLogs = ErrorLog::orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        $incidents = Incident::orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        // Fetch commits from GitHub API
        $commitLogs = [];
        $response = \Illuminate\Support\Facades\Http::get('https://api.github.com/repos/irvento/detectandprevent/commits?sha=main');
        if ($response->ok()) {
            $commitLogs = $response->json();
        }

        return view('logs.index', compact('logs', 'commitLogs', 'errorLogs', 'incidents'));
    }

    private function getBrowser($userAgent)
    {
        // Basic browser detection
        if (strpos($userAgent, 'Chrome') !== false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            return 'Edge';
        } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) {
            return 'Internet Explorer';
        } else {
            return 'Unknown Browser';
        }
    }
}