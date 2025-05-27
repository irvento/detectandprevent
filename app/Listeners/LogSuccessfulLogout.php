<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\logsModel;
use App\Helpers\BrowserHelper;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        $request = request();
        $userAgent = $request->header('User-Agent');
        $browser = BrowserHelper::getBrowser($userAgent);

        logsModel::create([
            'user_id' => $event->user->id,
            'ip' => $request->ip(),
            'device' => $browser,
            'Description' => 'User logged out: ' . $event->user->email,
        ]);
    }
}