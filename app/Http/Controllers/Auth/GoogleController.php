<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Event;
use App\Models\PaymentDetail;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            // Get the user information from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Split full name into first and last name
            $nameParts = explode(' ', $googleUser->getName(), 2);
            $firstName = $nameParts[0];
            $lastName = isset($nameParts[1]) ? $nameParts[1] : ''; // In case there's no last name

            // Check if the user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // If the user already exists, update their Google ID if necessary
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            } else {
                // If the user does not exist, create a new one
                $user = User::create([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make('dummy_password'), // Using Hash::make instead of bcrypt
                ]);

                // Create the related Event
                $event = Event::create([
                    'user_id' => $user->id,
                    'name' => $user->id, // Set event name as user ID (modify as needed)
                ]);

                // Create the related PaymentDetail
                $payment = PaymentDetail::create([
                    'user_id' => $user->id,
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect to the dashboard or intended page
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            // Handle error
            return redirect()->route('login')->with('error', 'Something went wrong with Google login.');
        }
    }
}
