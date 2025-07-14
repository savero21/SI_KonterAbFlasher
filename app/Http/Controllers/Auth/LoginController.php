<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Tambahan pengecekan status akun dan redirect sesuai role.
     */
protected function authenticated(Request $request, $user)
{
    if ($user->status !== 'active') {
        auth()->logout();
        return redirect()->route('login')->with('error', 'Akun Anda masih dalam proses persetujuan.');
    }

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    }

    if ($user->role === 'superadmin') {
        return redirect('/superadmin/dashboard');
    }

    return redirect('/');
}


    /**
     * RedirectTo hanya fallback, tapi bisa diabaikan karena authenticated dipakai lebih dahulu
     */
    // protected function redirectTo()
    // {
    //     return '/home';
    // }
}
