<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\Sender;
use App\Models\Setting;
use App\Models\User;
use App\Models\Event;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    function profile()
    {
        $user = User::findOrFail(Auth::id());

        $totalUsers = User::count();
        $totalGifts = Gift::count();
        $totalSenders = Sender::count();

        return view('admin.dashboard', compact('user', 'totalUsers', 'totalGifts', 'totalSenders'));
    }

    function users()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.users.users', compact('users'));
    }

    function settings()
    {
        $settings = Setting::find(1);

        return view('admin.settings.settings', compact('settings'));
    }

    function settingsSave(Request $request)
    {
        try {
            $request->validate([
                'admin_fees' => 'required|numeric',
                'merchant_fees' => 'required|numeric',
                'email' => 'required|email',
            ]);

            $settings = Setting::find(1);
            $settings->admin_fees = $request->admin_fees;
            $settings->merchant_fees = $request->merchant_fees;
            $settings->email = $request->email;
            $settings->save();

            return redirect()->back()->with('success', 'Settings Updated!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function transactions()
    {
        $transactions = Gift::latest()->get();

        return view('admin.transactions.transactions', compact('transactions'));
    }

    function gifts()
    {
        $gifts = Gift::latest()->get();

        return view('admin.gifts.gifts', compact('gifts'));
    }

    function events()
    {
        $events = Event::latest()->get();

        return view('admin.events.events', compact('events'));
    }

    function eventDetails($id)
    {
        $event = Event::find($id);

        $event->event_date = Carbon::parse($event->event_date)->format('Y-m-d');

        return view('admin.events.event_details', compact('event'));
    }

    function eventUpdate(Request $request)
    {
        try {
            $event = Event::find($request->event_id);

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
                'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jpeg|max:2048'
            ], $messages);
            // $event = Event::where('user_id', $user->id)->first();

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
                'showname' => $request->showname,
                'image' => $imagePath,
                'banner' => $bannerPath,
                'event_date' => $request->event_date,
                'description' => $request->description,
                'location' => $request->location,
            ]);

            return redirect()->back()->with('success', 'Event Updated Successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
