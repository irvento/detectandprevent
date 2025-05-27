<?php


namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\logsModel;
use App\Helpers\BrowserHelper;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        $request = request();
        $userAgent = $request->header('User-Agent');
        $browser = BrowserHelper::getBrowser($userAgent);

        logsModel::create([
        'user_id' => $event->user->id,
        'ip' => $request->ip(),
        'device' => $browser,
        'Description' => 'User logged in: ' . $event->user->email, // Capital D
    ]);
    }
}