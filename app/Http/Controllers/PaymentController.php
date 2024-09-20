<?php

namespace App\Http\Controllers;

use App\Mail\AdminGift;
use App\Mail\GiftRecieve;
use App\Mail\Payment;
use App\Mail\SenderGift;
use App\Models\Gift;
use App\Models\Sender;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'address' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'message' => 'required',
            'user_id' => 'required'
        ]);

        try {
            $settings = Setting::find(1);

            $adminFees = ($request->amount * $settings->admin_fees) / 100;
            $merchantFees = ($request->amount * $settings->merchant_fees) / 100;

            $totalAmount = $request->amount + $adminFees + $merchantFees;

            Stripe::setApiKey(env('STRIPE_SECRET'));

            $token = $request->input('stripeToken');

            $payment_details = Charge::create([
                'amount' => $totalAmount * 100,
                'currency' => 'usd',
                'source' => $token,
                'description' => $request->message,
            ]);
            

            $sender = Sender::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'country' => $request->country,
                'address' => $request->address,
                'suburb' => $request->suburb,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'phone' => $request->phone,
                'email' => $request->email
            ]);

            $giftId = 'GFT-' . strtoupper(Str::random(8));

            // Create the Gift with the generated ID
            $gift = Gift::create([
                'gift_id' => $giftId,
                'user_id' => $request->user_id,
                'sender' => $sender->id,
                'message' => $request->message,
                'amount' => $request->amount,
                'total_amount' => $totalAmount,
                'admin_fee' => $merchantFees,
                'merchant_fee' => $adminFees,
                'date' => now(),
                'payment_details' => $payment_details,
            ]);

            $user = User::find($request->user_id);

            $data = [
                'sender_name' => $request->first_name . ' ' . $request->last_name,
                'receiver_name' => $user->first_name . ' ' . $user->last_name,
            ];
            
            
            
            Mail::to($user->email)->send(new GiftRecieve($data));
            Mail::to($settings->email)->send(new AdminGift($data));
            Mail::to($request->email)->send(new SenderGift($data));

            return redirect()->route('payment.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->route('payment.failure')->with('error', $e->getMessage());
        }
    }
}
