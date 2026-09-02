<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $remember = $request->boolean('remember');

        // Find user by username
        $user = \App\Models\User::where('username', $request->username)->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            Auth::login($user, $remember);
            $request->session()->regenerate();

            // Role-based Redirection Logic
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            // POS Redirection Logic
            if ($user->username === 'pos1') {
                return redirect()->intended(route('pos1.dashboard'));
            }
            if ($user->username === 'pos2') {
                return redirect()->intended(route('pos2.dashboard'));
            }

            // Redirect to intended URL or main dashboard
            return redirect()->intended(route('dashboard.main'));
        }

        throw ValidationException::withMessages([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
