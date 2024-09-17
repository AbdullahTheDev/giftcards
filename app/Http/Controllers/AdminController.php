<?php

namespace App\Http\Controllers;

use App\Models\User;
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
}
