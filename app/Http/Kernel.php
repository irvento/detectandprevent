<?php


namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareGroups = [
        'web' => [
         
            \App\Http\Middleware\LogUnauthorizedDashboardAccess::class,
        ],

        'api' => [
            
        ],
    ];
}