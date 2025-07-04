<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gift;
use App\Models\PaymentDetail;
use App\Models\User;
use Endroid\QrCode\Writer\PngWriter;
use Exception;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode as MQrCode;
use Endroid\QrCode\QrCode;


class UserController extends Controller
{
    function profile()
    {
        if (\Auth::user()->role == 'admin') {
            return redirect(route('admin.dashboard'));
        }
        $user = User::findOrFail(Auth::id());
        $event = Event::where('user_id', $user->id)->first();

        $totalGifts = Gift::where('user_id', Auth::id())->count();
        $amount = Gift::where('user_id', Auth::id())->sum('amount');

        $event = Event::where('user_id', $user->id)->first();

        $url = route('user.profile', $event->name);

        $qrCode = MQrCode::format('svg')->size(200)->generate($url);
        $user->qrcode = $qrCode;
        $user->save();

        return view('front.dashboard', compact('user', 'amount', 'totalGifts', 'event'));
    }

    public function downloadQRCode()
    {
        $user = Auth::user();
        $event = Event::where('user_id', $user->id)->first();
        $url = route('user.profile', $event->name);

        // Create a QR Code
        $qrCode = new QrCode($url);
        $qrCode->setSize(800);

        // Create a PNG writer and generate PNG data
        $writer = new PngWriter();
        $result = $writer->write(qrCode: $qrCode);
        $pngData = $result->getString();

        // Serve the PNG image for download
        return Response::make($pngData, 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="user_' . $user->id . '_qrcode.png"',
        ]);
    }

    function userProfile($id)
    {
        $formattedUserId = str_replace(' ', '-', $id);

        $event = Event::whereRaw('LOWER(name) = ?', [strtolower($formattedUserId)])->first();
        
        if ($event) {
            $user = User::findOrFail($event->user_id);

            return view('front.event', compact('user', 'event'));
        } else {
            return redirect()->route('home')->with('warning', 'User Not Found!');
        }
    }

    public function userSearch(Request $request)
    {
        $request->validate([
            'user_id' => 'required'
        ]);

        $formattedUserId = str_replace(' ', '-', $request->user_id);
        $event = Event::whereRaw('LOWER(name) = ?', [strtolower($formattedUserId)])->first();
        
        if ($event) {
            return redirect(route('user.profile', $event->name));
        }
 
        $name = strtolower($request->user_id);

        $event = Event::join('users', 'events.user_id', '=', 'users.id')
        ->whereRaw("LOWER(CONCAT(users.first_name, ' ', users.last_name)) = ?", [$name])
        ->select('events.*')
        ->first();
    
        if ($event) {
            return redirect(route('user.profile', $event->name));
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
        // return $request->file('banner');
        try {
            $event = Event::where('user_id', Auth::id())->first();

            $messages = [
                'name.unique' => 'The event name is already taken. Please choose a different name.',
            ];

            $request->validate([
                'name' => [
                    'required',
                    Rule::unique('events', 'name')->ignore($event->id)->where(function ($query) use ($request) {
                        $query->whereRaw('LOWER(name) = ?', [strtolower($request->name)]);
                    }),
                ],
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jpeg|max:2048',
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jpeg|max:2048',
                'first_name' => 'required',
                'last_name' => 'required',
            ], $messages);


            $user = User::find(Auth::id());
            $user->update([
                'phone' => $request->phone,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
            ]);

            $event = Event::where('user_id', $user->id)->first();

            if ($request->has('password')) {
                $request->user()->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $customPublicPath = env('CUSTOM_PUBLIC_PATH');

            // if ($request->hasFile('image')) {
            //     $image = $request->file('image');
            //     $imageName = time() . '_' . $image->getClientOriginalName();
            //     $path = $customPublicPath . 'uploads/images/';
            //     $image->move($path, $imageName);
            //     $imagePath = 'uploads/images/' . $imageName;
            // } else {
            //     $imagePath = $event->image;
            // }

            // // Handle banner upload
            // if ($request->hasFile('banner')) {
            //     $banner = $request->file('banner');
            //     $bannerName = time() . '_' . $banner->getClientOriginalName();
            //     $path = $customPublicPath . 'uploads/banners/';

            //     $banner->move($path, $bannerName);
            //     $bannerPath = 'uploads/banners/' . $bannerName;
            // } else {
            //     $bannerPath = $event->banner;
            // }
            
            // Handle image removal if requested
            if ($request->input('clear_image') == '1') {
                // Delete the existing image file if it exists
                if ($event->image) {
                    $existingImagePath = $customPublicPath . $event->image;
                    if (file_exists($existingImagePath)) {
                        unlink($existingImagePath);
                    }
                }
                $imagePath = null; // Set imagePath to null to indicate removal
            } else {
                // Handle image upload
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $path = $customPublicPath . 'uploads/images/';
                    $image->move($path, $imageName);
                    $imagePath = 'uploads/images/' . $imageName;
                } else {
                    $imagePath = $event->image; // Keep the existing image
                }
            }

            // Handle banner removal if requested
            if ($request->input('clear_banner') == '1') {
                // Delete the existing banner file if it exists
                if ($event->banner) {
                    $existingBannerPath = $customPublicPath . $event->banner;
                    if (file_exists($existingBannerPath)) {
                        unlink($existingBannerPath);
                    }
                }
                $bannerPath = null; // Set bannerPath to null to indicate removal
            } else {
                // Handle banner upload
                if ($request->hasFile('banner')) {
                    $banner = $request->file('banner');
                    $bannerName = time() . '_' . $banner->getClientOriginalName();
                    $path = $customPublicPath . 'uploads/banners/';
                    $banner->move($path, $bannerName);
                    $bannerPath = 'uploads/banners/' . $bannerName;
                } else {
                    $bannerPath = $event->banner; // Keep the existing banner
                }
            }


            
            // Handle meta_image removal if requested
            if ($request->input('clear_meta_image') == '1') {
                // Delete the existing meta_image file if it exists
                if ($event->meta_image) {
                    $existingMetaImagePath = $customPublicPath . $event->meta_image;
                    if (file_exists($existingMetaImagePath)) {
                        unlink($existingMetaImagePath);
                    }
                }
                $metaImagePath = null; // Set bannerPath to null to indicate removal
            } else {
                // Handle meta_image upload
                if ($request->hasFile('meta_image')) {
                    $image = $request->file('meta_image');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $path = $customPublicPath . 'uploads/meta_image/';
                    $image->move($path, $imageName);
                    $metaImagePath= 'uploads/meta_image/' . $imageName;
                } else {
                    $metaImagePath= $event->meta_image; // Keep the existing image
                }
            }
            
            
            
            

      
            $event->update([
                'name' => $request->name,
                'image' => $imagePath,
                'banner' => $bannerPath,
                'meta_image' => $metaImagePath,
                'event_date' => $request->event_date,
                'description' => $request->description,
                'showname' => $request->showname,
                'show_profile' => $request->show_image,
                'show_banner' => $request->show_banner
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
