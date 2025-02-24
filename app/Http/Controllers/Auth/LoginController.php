<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role user
            if ($user->hasRole('admin')) {
                return redirect()->route('pages.admin.welcome');
            } elseif ($user->hasRole('umkm')) {
                return redirect()->route('pages.umkm.welcome');
            } elseif ($user->hasRole('user')) {
                return redirect()->route('pages.user.welcome');
            }
        }

        return redirect()->back()->withErrors(['login_error' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
