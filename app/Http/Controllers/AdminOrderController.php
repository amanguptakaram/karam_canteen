<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display all orders.
     */
    public function index()
    {
        $orders = Order::with('user', 'items.food')
            ->latest()
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display a single order.
     */
    public function show(Order $order)
    {
        $order->load('user', 'items.food');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Accept a pending order.
     */
    public function accept(Order $order)
    {
        if ($order->status === 'pending') {
            $order->update([
                'status' => 'accepted',
            ]);
        }

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order accepted successfully.');
    }
}