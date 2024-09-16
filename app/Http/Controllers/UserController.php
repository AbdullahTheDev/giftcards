<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gift;
use App\Models\PaymentDetail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    function profile()
    {
        $user = User::findOrFail(Auth::id());

        $totalGifts = Gift::where('user_id', Auth::id())->count();
        $amount = Gift::where('user_id', Auth::id())->sum('amount');

        $event = Event::where('user_id', $user->id)->first();

        // if ($user->qrcode == null) {
        $url = route('user.profile', $event->name);

        $qrCode = QrCode::size(200)->generate($url);
        $user->qrcode = $qrCode;
        $user->save();
        // }

        return view('front.dashboard', compact('user', 'amount', 'totalGifts'));
    }

    function userProfile($id)
    {
        $event = Event::where('name', $id)->first();
        
        $user = User::findOrFail($event->user_id);
        // return $user;

        return view('front.event', compact('user', 'event'));
    }

    function userSearch(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric'
        ]);

        $event = Event::where('name', $request->user_id)->first();;
        // $user = User::find($request->user_id);

        if ($event) {
            return redirect(route('user.profile', $event->user_id));
        }
        return redirect()->route('home')->with('warning', 'User Not Found!');
    }


    // Setting
    function setting()
    {
        $user = Auth::user();
        $paymentDetails = PaymentDetail::where('user_id', $user->id)->first();
        $event = Event::where('user_id', $user->id)->first();

        $completed = 0;
        $points = [
            "email" => 10,
            "phone" => 10,
            "name" => 10,
            "image" => 10,
            "banner" => 10,
            "event_date" => 10,
            "description" => 10,
            "location" => 10,
            "payment_details" => 20,
        ];

        // Check User fields
        if (!empty($user->email)) {
            $completed += $points["email"];
        }
        if (!empty($user->phone)) {
            $completed += $points["phone"];
        }
        // Assuming payment_details is a column in the User table
        if (!empty($user->payment_details)) {
            $completed += $points["payment_details"];
        }

        // Check Event fields
        if ($event) {
            if (!empty($event->name)) {
                $completed += $points["name"];
            }
            if (!empty($event->image)) {
                $completed += $points["image"];
            }
            if (!empty($event->banner)) {
                $completed += $points["banner"];
            }
            if (!empty($event->location)) {
                $completed += $points["location"];
            }
            if (!empty($event->event_date)) {
                $completed += $points["event_date"];
            }
            if (!empty($event->description)) {
                $completed += $points["description"];
            }
        }

        // Calculate total points and completion percentage
        $totalPoints = array_sum($points);
        $completionPercentage = ($completed / $totalPoints) * 100;

        return view('front.setting', compact('user', 'event', 'completionPercentage', 'paymentDetails'));
    }

    function updateUser(Request $request)
    {
        try {
            $event = Event::where('user_id', Auth::id())->first();

            $messages = [
                'name.unique' => 'The event name is already taken. Please choose a different name.',
            ];

            $request->validate([
                'name' => 'required|unique:events,name,' . $event->id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jpeg|max:2048',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jpeg|max:2048',
                'first_name' => 'required',
                'last_name' => 'required',
            ], $messages);


            $user = User::find(Auth::id());
            $user->update([
                'phone' => $request->phone,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name
            ]);

            $event = Event::where('user_id', $user->id)->first();

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/images'), $imageName);
                $imagePath = 'uploads/images/' . $imageName;
            } else {
                $imagePath = $event->image;
            }

            // Handle banner upload
            if ($request->hasFile('banner')) {
                $banner = $request->file('banner');
                $bannerName = time() . '_' . $banner->getClientOriginalName();
                $banner->move(public_path('uploads/banners'), $bannerName);
                $bannerPath = 'uploads/banners/' . $bannerName;
            } else {
                $bannerPath = $event->banner;
            }

            $event->update([
                'name' => $request->name,
                'image' => $imagePath,
                'banner' => $bannerPath,
                'event_date' => $request->event_date,
                'description' => $request->description,
                'location' => $request->location,
            ]);

            return redirect()->back()->with('success', 'Information Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function updatePaymentDetails(Request $request)
    {

        try {
            $paymentDetails = PaymentDetail::updateOrCreate(
                ['user_id' => Auth::id()], // Condition to check
                [
                    'accountName' => $request->accountName,
                    'BSBNumber' => $request->BSBNumber,
                    'accountNumber' => $request->accountNumber,
                    'bankName' => $request->bankName,
                ]
            );

            return redirect()->back()->with('success', 'Payment Details Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function updateLocation(Request $request)
    {

        try {

            $request->validate([
                'location' => 'required',
            ]);

            $event = Event::where('user_id', Auth::id())->first();

            $event->update([
                'location' => $request->location,
            ]);

            return redirect()->back()->with('success', 'Location Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
