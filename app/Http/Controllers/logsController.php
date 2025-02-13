<?php

namespace App\Http\Controllers;

use App\Models\logsModel;
use Illuminate\Http\Request;

class logsController extends Controller
{
    public function index()
    {
        $logs = logsModel::all();
        return view('logs.index', compact('logs'));
    }
}
