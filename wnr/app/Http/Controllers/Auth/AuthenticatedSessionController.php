<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

                // Attempt to log in the user
                if (Auth::attempt($request->only('email', 'password'))) {
                    $request->session()->regenerate();  // Regenerate session to prevent fixation
        
                    // Check if the user is blocked
                    if (Auth::user()->is_blocked) {
                        Auth::logout();
                        return redirect()->back()->withErrors(['email' => 'Your account has been blocked.']);
                    }
        
                    // Check if the user is an admin and redirect accordingly
                    if (Auth::user()->isAdmin()) {
                        return redirect()->intended('/admin/dashboard');  // Redirect admins
                    }
        
                    // Redirect regular users to the dashboard
                    return redirect()->intended('/');
                }
        
                // If the credentials don't match, return an error
                return back()->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
