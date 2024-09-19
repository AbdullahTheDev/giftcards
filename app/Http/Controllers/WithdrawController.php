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
        $withdrawls = Withdrawl::where('user_id', Auth::id())->get();

        $total = 0;

        foreach($withdrawls as $withdrawl){
            $total += $withdrawl->amount;
        }

        return view('front.withdraw.withdraw', compact('withdrawls', 'total'));
    }

    function adminWithdraw(){
        $withdrawls = Withdrawl::all();

        return view('admin.withdraw.withdraw', compact('withdrawls'));
    }
    function adminWithdrawDetail(){
        $withdrawls = Withdrawl::all();

        return view('admin.withdraw.withdraw', compact('withdrawls'));
    }
    function requestWithdrawPage(Request $request){
        $gifts = Gift::where('user_id', Auth::id())->where('requested', 0)->get();

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
                $gift->requested = 1;
                $gift->save();

                $withdrawGifts = WithdrawGifts::create([
                    'gift_id' => $gift_id,
                    'withdrawl_id' => $withdrawl->id
                ]);

                $amount += $gift->amount;
            }

            $withd = Withdrawl::find($withdrawl->id);
            $withd->invoice_id = Auth::id() . (time() % 100000);
            $withd->amount = $amount;
            $withd->admin_fees = 5;
            $withd->save();


            // return $request->all();
            
            return redirect()->back()->with('success', 'Withdrawl request sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
