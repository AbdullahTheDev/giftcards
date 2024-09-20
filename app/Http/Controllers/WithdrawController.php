<?php

namespace App\Http\Controllers;

use App\Mail\AdminWithdraw;
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

        $total = 0;

        foreach ($withdrawls as $withdrawl) {
            $total += $withdrawl->amount;
        }

        return view('front.withdraw.withdraw', compact('withdrawls', 'total'));
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
            $withdrawl = Withdrawl::create([
                'user_id' => Auth::id()
            ]);
            $amount = 0;

            foreach ($request->gift_ids as $gift_id) {
                $gift = Gift::find($gift_id);
                $gift->requested = 1;
                $gift->save();

                $withdrawGifts = WithdrawGifts::create([
                    'gift_id' => $gift_id,
                    'withdrawl_id' => $withdrawl->id
                ]);

                $amount += $gift->amount;
            }
            $settings = Setting::find(1);

            $withd = Withdrawl::find($withdrawl->id);
            $withd->invoice_id = Auth::id() . (time() % 100000);
            $withd->amount = $amount;
            $withd->admin_fees = $settings->merchant_fees;
            $withd->merchant_fees = $settings->admin_fees;
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
