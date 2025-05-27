<?php


namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
protected $middlewareGroups = [
    'web' => [
        // other middleware...
        \App\Http\Middleware\DetectFlood::class,
    ],
];  
}