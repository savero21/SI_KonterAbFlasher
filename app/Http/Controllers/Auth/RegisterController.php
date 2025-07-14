<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration (not used here since we're overriding register()).
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'admin',   // default role
            'status'   => 'pending', // akun menunggu persetujuan
        ]);
    }

    /**
     * Override the default register behavior to avoid auto-login.
     */
    public function register(Request $request)
    {
        // Validasi input
        $this->validator($request->all())->validate();

        // Buat user dan kirim event Registered
        event(new Registered($user = $this->create($request->all())));

        // Jangan login otomatis
        // Auth::login($user);

        // Redirect ke halaman login dengan notifikasi
        return redirect()->route('login')->with('info', '✅ Pendaftaran berhasil! Akun Anda menunggu persetujuan Superadmin.');
    }
}
