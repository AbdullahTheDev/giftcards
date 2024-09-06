<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    function profile(){
        $user = User::findOrFail(Auth::id());


        if($user->qrcode == null){
            $profileUrl = route('user.profile', $user->id);
            
            $qrCode = QrCode::size(200)->generate($profileUrl);
            $user->qrcode = $qrCode;
            $user->save();
        }

        return view('front.dashboard');
    }

    function userProfile($id) {
        $user = User::findOrFail($id);


        return view('front.event', compact('user'));
    }

    function userSearch(Request $request) {
        $request->validate([
            'user_id' => 'required|numeric'
        ]);
        
        $user = User::find($request->user_id);
        
        if($user){
            return redirect(route('user.profile', $user->id));
        }
        return redirect()->route('home')->with('warning', 'User Not Found!');
    }


    // Setting
    function setting(){
        $user = Auth::user();
        $event = Event::where('user_id', $user->id)->first();

        return view('front.setting', compact('user', 'event'));
    }

    function updateUser(Request $request){
        try{
            $request->validate([
                'name' => 'unique:events,name',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for images
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add validation for banners
            ]);
            $user = User::find(Auth::id());
            $user->update([
                'phone' => $request->phone 
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
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
