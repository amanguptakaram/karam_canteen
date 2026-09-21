<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();

        $totalFoods = Food::count();

        $availableFoods = Food::where('is_available', true)->count();

        $totalOrders = Order::count();

        $pendingOrders = Order::where('status', 'pending')->count();

        $acceptedOrders = Order::where('status', 'accepted')->count();

        $todayOrders = Order::whereDate('created_at', today())->count();


        /*
        |--------------------------------------------------------------------------
        | Last 6 Working Days Orders
        |--------------------------------------------------------------------------
        */

        $chartDates = [];

        $date = Carbon::today();

        while (count($chartDates) < 6) {

            // Sunday skip
            if ($date->dayOfWeek !== Carbon::SUNDAY) {
                $chartDates[] = $date->copy();
            }

            $date->subDay();
        }

        // Oldest → Latest
        $chartDates = array_reverse($chartDates);


        $salesChartLabels = [];

        $salesChartData = [];

        foreach ($chartDates as $chartDate) {

            $salesChartLabels[] = $chartDate->format('D, d M');

            $salesChartData[] = Order::whereDate(
                'created_at',
                $chartDate->toDateString()
            )->count();
        }


        /*
        |--------------------------------------------------------------------------
        | Recent Orders
        |--------------------------------------------------------------------------
        */

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();


        return view('admin.dashboard', compact(
            'totalUsers',
            'totalFoods',
            'availableFoods',
            'totalOrders',
            'pendingOrders',
            'acceptedOrders',
            'todayOrders',
            'recentOrders',
            'salesChartLabels',
            'salesChartData'
        ));
    }
}