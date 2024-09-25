<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class VerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('auth.verify'); // Create this view
    }

    public function verifyCode(Request $request)
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
