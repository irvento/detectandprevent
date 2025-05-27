<?php

namespace App\Http\Controllers;

use App\Models\logsModel;
use Illuminate\Http\Request;

class logsController extends Controller
{
    public function index(Request $request)
    {
        

        $logs = logsModel::all();
        return view('logs.index', compact('logs'));
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
