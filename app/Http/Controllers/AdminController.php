<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function profile()
    {
        $user = User::findOrFail(Auth::id());

        $totalUsers = User::count();

        return view('admin.dashboard', compact('user', 'totalUsers'));
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
        try{
            $request->validate([
                'admin_fees' => 'required|numeric',
                'merchant_fees' => 'required|numeric',
            ]);

            $settings = Setting::find(1);
            $settings->admin_fees = $request->admin_fees;
            $settings->merchant_fees = $request->merchant_fees;
            $settings->save();

            return redirect()->back()->with('success', 'Settings Updated!');
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
