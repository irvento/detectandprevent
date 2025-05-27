<?php


namespace App\Listeners;

use Illuminate\Auth\Events\Failed;
use App\Models\logsModel;
use App\Helpers\BrowserHelper;

class LogFailedLogin
{
    public function handle(Failed $event)
    {
        $request = request();
        $userAgent = $request->header('User-Agent');
        $browser = BrowserHelper::getBrowser($userAgent);

        logsModel::create([
            'user_id' => $event->user?->id, // null if user doesn't exist
            'ip' => $request->ip(),
            'device' => $browser,
            'Description' => 'Failed login attempt for email: ' . ($event->credentials['email'] ?? 'unknown'),
        ]);
    }
}