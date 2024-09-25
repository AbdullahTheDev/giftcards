<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Mail;
use Str;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user
        $request->authenticate();
        
        // Regenerate the session
        $request->session()->regenerate();
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user is verified
        if (!$user->hasVerifiedEmail()) {
            // Send the verification email
            $user->sendEmailVerificationNotification();
            
            // Log out the user and redirect to the verification notice page
            Auth::logout();
            
            return redirect()->route('verification.notice'); // Make sure to create this route
        }
    
        // Update last login time and redirect based on role
        $user->last_login = now();
        $user->save();
        
        if ($user->role == 'admin') {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }
        
        return redirect()->intended(RouteServiceProvider::HOME);
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

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6',
        ]);
    
        // Check the entered code against the stored session code
        if ($request->code === session('verification_code')) {
            // Log the user in
            Auth::loginUsingId(session('user_id'));
    
            // Clear the session values
            session()->forget(['verification_code', 'user_id']);
    
            if(Auth::user()->role == 'admin'){
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }
            // Redirect to intended route
            return redirect()->intended(RouteServiceProvider::HOME); // Change as needed
        }
    
        // If the code is invalid, redirect back with an error
        return back()->withErrors(['code' => 'The verification code is invalid.']);
    }
    
}
