<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Tenants;
use App\Models\Lease;
use App\Models\Maintenancerequests;

class UserDashboardController extends Controller
{
    //get dashboard data
    public function index(Request $request){
        $user_id = session()->get('owner_id');

        $totalmonthlyrevenue = Payment::sum('amount');
        $listedproperties = Property::where('owner_id', $user_id)->count();
        // Calculate the number of tenants for the current month and the previous month
        $now = now();
        $currentMonthStart = $now->copy()->startOfMonth();
        $previousMonthStart = $currentMonthStart->copy()->subMonth();
        $previousMonthEnd = $previousMonthStart->copy()->addDays(
            min($now->day, $previousMonthStart->daysInMonth) - 1
        );

        $currentMonthTenants = Tenants::where('owner_id', $user_id)
            ->whereHas('leases', function ($query) use ($currentMonthStart, $now) {
                $query->where('status', 'active')
                    ->whereDate('start_date', '<=', $now->toDateString())
                    ->where(function ($query) use ($currentMonthStart) {
                        $query->whereNull('end_date')
                            ->orWhereDate('end_date', '>=', $currentMonthStart->toDateString());
                    });
            })
            ->count();
        $previousMonthTenants = Tenants::where('owner_id', $user_id)
            ->whereHas('leases', function ($query) use ($previousMonthStart, $previousMonthEnd) {
                $query->where('status', 'active')
                    ->whereDate('start_date', '<=', $previousMonthEnd->toDateString())
                    ->where(function ($query) use ($previousMonthStart) {
                        $query->whereNull('end_date')
                            ->orWhereDate('end_date', '>=', $previousMonthStart->toDateString());
                    });
            })
            ->count();

        $tenantscount = $currentMonthTenants;
        //monthly percentage change in number of tenants calculation
        $tenantspercentageChange = $previousMonthTenants === 0
            ? ($currentMonthTenants === 0 ? 0 : null)
            : (($currentMonthTenants - $previousMonthTenants) / $previousMonthTenants) * 100;


        $totalmonthlyrevenueChange = Payment::whereIn('lease_id', Lease::whereIn(
            'tenant_id', Tenants::where('owner_id', $user_id)->pluck('id')
        )->pluck('id'))->where(
            'created_at', '>=', now()->subMonth()
        )->sum('amount');

        //full data
        $recentPayments = Payment::whereIn(
            'lease_id', Lease::whereIn(
                'tenant_id', Tenants::where('owner_id', $user_id)->pluck('id')
            )->pluck('id')
        )->orderBy('created_at', 'desc')->limit(5)->get();

        $activeTickets = Maintenancerequests::whereIn(
            'lease_id', Lease::whereIn(
                'tenant_id', Tenants::where('owner_id', $user_id)->pluck('id')
            )->pluck('id')
        )->where('status', 'pending')->limit(3)->get();

        //chart data
        $rentPerMonth = Payment::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->pluck('count', 'month')->toArray();

        $rentData = [];
        for ($i = 1; $i <= 12; $i++) {
            $rentData[$i] = $rentPerMonth[$i] ?? 0;
        }
        ksort($rentData);

        return view('user.dashboard', [

            'tenantscount' => $tenantscount,
            'activeTickets' => $activeTickets,
            'totalmonthlyrevenue' => $totalmonthlyrevenue,
            'tenantspercentageChange' => $tenantspercentageChange,
            'totalmonthlyrevenueChange' => $totalmonthlyrevenueChange,
            'rentData' => $rentData,
            'recentPayments' => $recentPayments,
            'listedproperties' => $listedproperties,
        ]);

    }
}
