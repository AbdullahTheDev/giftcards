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


        if($user->qrcode == null){
            $profileUrl = route('user.profile', $user->id);
            
            $qrCode = QrCode::size(200)->generate($profileUrl);
            $user->qrcode = $qrCode;
            $user->save();
        }

        return view('front.dashboard');
    }

    function userProfile($id) {
        $user = User::findOrFail($id);


        return view('front.event', compact('user'));
    }
}
