<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\WithdrawGifts;
use App\Models\Withdrawl;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    function index(){
        $gifts = Gift::where('user_id', Auth::id())->get();

        return view('front.withdraw.withdraw', compact('gifts'));
    }

    function requestWithdrawPage(Request $request){
        $gifts = Gift::where('user_id', Auth::id())->get();

        return view('front.withdraw.gifts', compact('gifts'));
    }
    function requestWithdraw(Request $request){
        try {

            $withdrawl = Withdrawl::create([
                'user_id' => Auth::id()
            ]);
            $amount = 0;

            foreach($request->gift_ids as $gift_id){
                $gift = Gift::find($gift_id);

                $withdrawGifts = WithdrawGifts::create([
                    'gift_id' => $gift_id,
                    'withdrawl_id' => $withdrawl->id
                ]);

                $amount += $gift->amount;
            }
            return $request->all();
            
            return redirect()->back()->with('success', 'Withdrawl request successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
