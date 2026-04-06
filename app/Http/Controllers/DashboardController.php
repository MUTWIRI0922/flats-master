<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;


class DashboardController extends Controller
{
    //get dashboard data
    public function index(){
        // counts for cards
        $userscount = User::all() -> count();
        $activesubscriptionscount = Subscription::where('status', 'active')->count();
        $expiredsubscriptionscount = Subscription::where('status', 'expired')->count();
        $totalrevenue = Payment::sum('amount');

        //full data
        $recentsignups = User::whereHas('roles', function ($query) {
            $query->where('name', 'agent');
        })->orderBy('created_at', 'desc')->limit(5)->get();
        $activesubscriptions = Subscription::where('status', 'active')->limit(5)->get();
        $expiredsubscriptions = Subscription::where('status', 'expired')->limit(5)->get();
        //chart data
        $subscriptionPerMonth = Subscription::selectRaw('MONTH(start_date) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('count', 'month')->toArray();

        $subscriptionData = [];
        for ($i = 1; $i <= 12; $i++) {
            $subscriptionData[$i] = $subscriptionPerMonth[$i] ?? 0;
        }
        ksort($subscriptionData);

        $usersPerMonth = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('count', 'month')->toArray();

        $userdata = [];
        for ($i = 1; $i <= 12; $i++) {
            $userdata[$i] = $usersPerMonth[$i] ?? 0;
        }
        ksort($userdata);


        return view('admin.dashboard', [
            'userscount' => $userscount,
            'activesubscriptionscount' => $activesubscriptionscount,
            'expiredsubscriptionscount' => $expiredsubscriptionscount,
            'totalrevenue' => $totalrevenue,
            'subscriptionData' => $subscriptionData,
            'userdata' => $userdata,
            'recentsignups' => $recentsignups,
            'activesubscriptions' => $activesubscriptions,
            'expiredsubscriptions' => $expiredsubscriptions,
        ]);
    }
}
