<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect user after login based on their role.
     */
    protected function redirectTo()
    {
        if (auth()->user()->role === 'admin') {
            return '/admin/dashboard';
        }

        return '/home'; // untuk user biasa
    }
}
