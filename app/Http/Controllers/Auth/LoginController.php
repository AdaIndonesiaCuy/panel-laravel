<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('index'); // Redirect authenticated users
        }

        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('index')->with('success', 'Login successful!');
    }

    protected function loggedOut(Request $request)
    {
        return redirect()->route('login');
    }
}
