<?php

namespace App\Http\Controllers;

use App\Models\ErrorLog;

class ErrorLogController extends Controller
{
    public function index()
    {
        $errorLogs = ErrorLog::orderBy('created_at', 'desc')->get();
        return view('error_logs.index', compact('errorLogs'));
    }
}