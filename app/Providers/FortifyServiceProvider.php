<?php

namespace App\Providers;

use App\Models\logsModel; // Import the Logs model
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
    
        RateLimiter::for('login', function (Request $request): mixed {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
    
            $limit = Limit::perMinute(5)->by($throttleKey);
            

            $userIp = $request->ip();
            $userDevice =  $request->header('User-Agent');

            // Check if the user has exceeded the limit
            if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
                $user = \App\Models\User::where('email', $request->input(Fortify::username()))->first();
    
                if ($user) {
                    // Insert log into database
                    logsModel::create([
                        'ip' => $userIp,
                        'device' => $userDevice,
                        'user_id' => $user->id,
                        'description' => 'User exceeded login attempts, CHANGE PASSWORD NOW! Someone might be trying to hack your account',                                  
                    ]);
                }
            }
    
            return $limit;
        });
    
        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
