<?php

namespace App\Http\Controllers;

use App\Mail\SendVerificationCodeMail;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VerificationController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $verificationCode = rand(100000, 999999);
    
        // Store the verification code in the database
        VerificationCode::updateOrCreate(
            ['email' => $request->email],
            [
                'code' => $verificationCode,
                'expires_at' => Carbon::now()->addMinutes(10), // Code expires in 10 minutes
            ]
        );
    
        // Send the verification code to the email
        Mail::to($request->email)->send(new SendVerificationCodeMail($verificationCode));
    
        return response()->json(['success' => 'Verification code sent successfully!']);
    }

}
