<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    function index()
    {
        $gifts = Gift::where('user_id', Auth::id())->get();

        return view('front.gifts', compact('gifts'));
    }
    function sendGift(Request $request)
    {
        try {

            return redirect()->back()->with('success', 'Gift Sent!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function reports()
    {
        $userId = Auth::id();

        // Fetch all gifts for the user
        $gifts = Gift::where('user_id', $userId)->get();

        // Calculate total gifts and total amount
        $totalGifts = $gifts->count();
        $totalAmount = $gifts->sum('amount');

        // Group gifts by day, week, month, and year
        $giftsByDay = $gifts->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m-d'); // grouping by dates
        });

        $giftsByWeek = $gifts->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('o-W'); // grouping by week number
        });

        $giftsByMonth = $gifts->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y-m'); // grouping by months
        });

        $giftsByYear = $gifts->groupBy(function ($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('Y'); // grouping by year
        });

        // Prepare data for the graph
        $graphData = [
            'day' => [
                'labels' => $giftsByDay->keys()->toArray(),
                'count' => $giftsByDay->map->count()->values()->toArray(),
                'amount' => $giftsByDay->map->sum('amount')->values()->toArray(),
            ],
            'week' => [
                'labels' => $giftsByWeek->keys()->toArray(),
                'count' => $giftsByWeek->map->count()->values()->toArray(),
                'amount' => $giftsByWeek->map->sum('amount')->values()->toArray(),
            ],
            'month' => [
                'labels' => $giftsByMonth->keys()->toArray(),
                'count' => $giftsByMonth->map->count()->values()->toArray(),
                'amount' => $giftsByMonth->map->sum('amount')->values()->toArray(),
            ],
            'year' => [
                'labels' => $giftsByYear->keys()->toArray(),
                'count' => $giftsByYear->map->count()->values()->toArray(),
                'amount' => $giftsByYear->map->sum('amount')->values()->toArray(),
            ],
        ];

        return view('front.reports.report', compact('graphData', 'totalGifts', 'totalAmount'));
    }

}
