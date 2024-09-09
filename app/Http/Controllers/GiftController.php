<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    function index() {
        $gifts = Gift::where('user_id', Auth::id())->get();

        return view('front.gifts', compact('gifts'));
    }
    function sendGift(Request $request){
        try{

            return redirect()->back()->with('success', 'Gift Sent!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
