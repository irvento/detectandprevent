<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth0\Laravel\Facade\Auth0;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return Auth0::login();
    }

    public function logout()
    {
        return Auth0::logout();
    }

    public function callback()
    {
        return Auth0::callback();
    }
} 