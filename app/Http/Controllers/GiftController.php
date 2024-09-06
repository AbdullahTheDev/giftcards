<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    function sendGift(Request $request){
        try{

            return redirect()->back()->with('success', 'Gift Sent!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
