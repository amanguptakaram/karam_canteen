<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        // Cart empty hai
        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Total calculate
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Order create
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Order ke items create
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id' => $item['id'],
                'food_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Cart empty
        session()->forget('cart');

        return redirect()
            ->route('orders.index')
            ->with('success', 'Your order has been placed successfully.');
    }
}
