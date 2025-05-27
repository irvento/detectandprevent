<?php


namespace App\Http\Controllers;

use App\Models\Incident;

class IncidentController extends Controller
{
    public function index()
    {
        $incidents = Incident::orderBy('created_at', 'desc')->get();
        return view('incidents.index', compact('incidents'));
    }
}