<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    function index(){
        $gifts = Gift::where('user_id', Auth::id())->get();

        return view('front.withdraw', compact('gifts'));
    }
}
