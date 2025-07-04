<?php

namespace App\Http\Controllers;

use App\Mail\AdminWithdraw;
use App\Mail\PaymentDone;
use App\Models\Gift;
use App\Models\PaymentDetail;
use App\Models\Setting;
use App\Models\User;
use App\Models\WithdrawGifts;
use App\Models\Withdrawl;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class WithdrawController extends Controller
{
    function index()
    {
        $withdrawls = Withdrawl::where('user_id', Auth::id())->get();

        $giftsAmount = Gift::where('user_id', Auth::id())->where('requested', 0)->sum('amount');

        $total = 0;

        foreach ($withdrawls as $withdrawl) {
            $total += $withdrawl->amount;
        }

        return view('front.withdraw.withdraw', compact('withdrawls', 'total', 'giftsAmount'));
    }

    function adminWithdraw()
    {
        $withdrawls = Withdrawl::all();

        return view('admin.withdraw.withdraw', compact('withdrawls'));
    }
    function adminWithdrawDetails($id)
    {
        $withdraw = Withdrawl::find($id);

        $withdrawlGifts = WithdrawGifts::where('withdrawl_id', $withdraw->id)->get();

        $paymentDetails = PaymentDetail::where('user_id', $withdraw->user_id)->first();

        // return $withdrawlGifts[0]->gifts;
        return view('admin.withdraw.withdraw_details', compact('withdraw', 'withdrawlGifts', 'paymentDetails'));
    }

    function adminWithdrawPaymentStatus($id, Request $request)
    {
        try {
            $withdraw = Withdrawl::find($id);
            $withdraw->payment_status = $request->payment_status;
            $withdraw->save();

            $data = [];

            if($request->payment_status == 'paid'){
                Mail::to($withdraw->user->email)->send(new PaymentDone($data));
            }

            return redirect()->back()->with('success', 'Payment status updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function requestWithdrawPage(Request $request)
    {
        $gifts = Gift::where('user_id', Auth::id())->where('requested', 0)->get();

        return view('front.withdraw.gifts', compact('gifts'));
    }
    function requestWithdraw(Request $request)
    {
        try {
            $settings = Setting::find(1);

            $withdrawl = Withdrawl::create([
                'user_id' => Auth::id()
            ]);
            $amount = 0;

            $admin_fees = 0;
            foreach ($request->gift_ids as $gift_id) {
                $gift = Gift::find($gift_id);
                $gift->requested = 1;
                $gift->save();

                $withdrawGifts = WithdrawGifts::create([
                    'gift_id' => $gift_id,
                    'withdrawl_id' => $withdrawl->id
                ]);

                $netAmount = $gift->amount - $settings->admin_fees;
                $admin_fees += $settings->admin_fees;
                $amount += $netAmount;
            }

            $withd = Withdrawl::find($withdrawl->id);
            $withd->invoice_id = Auth::id() . (time() % 100000);
            $withd->amount = $amount;
            $withd->admin_fees = $admin_fees;
            $withd->merchant_fees = $settings->merchant_fees;
            $withd->mode = 'Bank Transfer';
            
            $withd->save();

            $user = User::find(Auth::id());

            $data = [
                'username' => $user->first_name . ' ' . $user->last_name,
                'total' => $amount,
            ];

            Mail::to($settings->email)->send(new AdminWithdraw($data));

            // return $request->all();

            return redirect()->route('withdraw')->with('success', 'Withdrawl request sent successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
