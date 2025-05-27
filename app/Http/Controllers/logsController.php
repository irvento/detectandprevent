<?php

namespace App\Http\Controllers;

use App\Models\logsModel;
use Illuminate\Http\Request;
use App\Models\ErrorLog;
use Illuminate\Support\Facades\Http;
use App\Models\Incident;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class logsController extends Controller
{
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index(Request $request)
    {
        $this->checkAdmin();
        
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

        // Get all users
        $users = User::orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        // Fetch commits from GitHub API
        $commitLogs = [];
        $response = Http::get('https://api.github.com/repos/irvento/detectandprevent/commits?sha=deployment');
        if ($response->ok()) {
            $commitLogs = $response->json();
        }

        return view('logs.index', compact('logs', 'commitLogs', 'errorLogs', 'incidents', 'users'));
    }

    public function suspendUser(Request $request, $userId)
    {
        $this->checkAdmin();
        
        $user = User::where('id', $userId)->first();
        
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        if ($user->is_suspended === 1) {
            return back()->with('error', 'User is already suspended.');
        }

        try {
            $user->update([
                'is_suspended' => 1,
                'suspended_until' => now()->addMinutes(30)
            ]);

            // Log the suspension
            Incident::create([
                'type' => 'account_suspension',
                'description' => 'Account suspended by administrator',
                'user_id' => $userId,
                'ip' => $request->ip(),
                'status' => 'open'
            ]);

            return back()->with('success', 'User account has been suspended successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to suspend user: ' . $e->getMessage());
        }
    }

    public function reactivateUser(Request $request, $userId)
    {
        $this->checkAdmin();
        
        $user = User::findOrFail($userId);
        
        if (!$user->is_suspended) {
            return back()->with('error', 'User is not suspended.');
        }

        $user->update([
            'is_suspended' => 0,
            'suspended_until' => null
        ]);

        // Log the reactivation
        Incident::create([
            'type' => 'account_reactivation',
            'description' => 'Account reactivated by administrator',
            'user_id' => $userId,
            'ip' => $request->ip(),
            'status' => 'resolved'
        ]);

        return back()->with('success', 'User account has been reactivated successfully.');
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