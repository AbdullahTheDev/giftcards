<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return $request->all();
        
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $token = $request->input('stripeToken');

            Charge::create([
                'amount' => 1000, // Amount in cents
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Test Payment',
            ]);

            return redirect()->route('payment.success')->with('success', 'Payment successful!');
        } catch (\Exception $e) {
            return redirect()->route('payment.failure')->with('error', $e->getMessage());
        }
    }
}
