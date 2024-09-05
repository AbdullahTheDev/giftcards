<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    function profile(){
        $user = User::findOrFail(Auth::id());

        // Generate the URL to the user's profile
        $profileUrl = route('user.profile', $user->id); // Example URL

        return $profileUrl;
        // Generate the QR code as a base64 image
        $qrCode = QrCode::size(200)->generate($profileUrl);

        return view('front.dashboard');
    }

    function userProfile($id) {
        $user = User::findOrFail($id);

        
        return;
    }
}
