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
            // Retrieve settings for fees
            $settings = Setting::findOrFail(1);

            // Calculate fees and total amount
            $merchantFees = ($request->amount * $settings->merchant_fees) / 100;
            $totalAmount = $request->amount + $merchantFees;

            // Set Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));

            // Check if the Stripe token exists
            if (!$request->has('stripeToken')) {
                throw new \Exception("Payment token missing");
            }

            $token = $request->input('stripeToken');

            // Process payment via Stripe
            $payment_details = Charge::create([
                'amount' => $totalAmount * 100, // Amount in cents
                'currency' => 'usd',
                'source' => $token,
                'description' => $request->message,
            ]);

            // Create the sender record
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

            // Generate a unique gift ID
            $giftId = 'GFT-' . strtoupper(Str::random(8));

            // Create the Gift record
            $gift = Gift::create([
                'gift_id' => $giftId,
                'user_id' => $request->user_id,
                'sender' => $sender->id,
                'message' => $request->message,
                'amount' => $request->amount,
                'total_amount' => $totalAmount,
                'admin_fee' => $settings->admin_fees,
                'merchant_fee' => $merchantFees,
                'date' => now(),
                'payment_details' => json_encode($payment_details),
            ]);

            // Find the user receiving the gift
            $user = User::findOrFail($request->user_id);

            // Prepare data for the emails
            $data = [
                'sender_name' => $request->first_name . ' ' . $request->last_name,
                'receiver_name' => $user->first_name . ' ' . $user->last_name,
                'gift_id' => $giftId,
                'amount' => $request->amount,
            ];

            // Send confirmation emails
            Mail::to($user->email)->send(new GiftRecieve($data));
            Mail::to($settings->email)->send(new AdminGift($data));
            Mail::to($request->email)->send(new SenderGift($data));

            // Redirect on success
            return redirect()->route('payment.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            // Handle any errors
            return redirect()->route('payment.failure')->with('error', $e->getMessage());
        }
    }

}
