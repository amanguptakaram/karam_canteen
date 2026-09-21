<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add food to cart
    public function add(Request $request, Food $food)
    {
        if (!$food->is_available) {
            return response()->json([
                'success' => false,
                'message' => 'This food is currently unavailable.',
            ], 422);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$food->id])) {

            $cart[$food->id]['quantity']++;

        } else {

            $cart[$food->id] = [
                'id' => $food->id,
                'name' => $food->name,
                'price' => $food->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return $this->cartResponse(
            $cart,
            $food->name . ' added to cart.'
        );
    }


    // Increase / decrease quantity
    public function update(Request $request, Food $food)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$food->id])) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart.',
            ], 404);
        }

        $action = $request->action;

        if ($action === 'increase') {

            $cart[$food->id]['quantity']++;

        } elseif ($action === 'decrease') {

            $cart[$food->id]['quantity']--;

            if ($cart[$food->id]['quantity'] <= 0) {
                unset($cart[$food->id]);
            }

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Invalid cart action.',
            ], 422);
        }

        session()->put('cart', $cart);

        return $this->cartResponse($cart);
    }


    // Remove food from cart
    public function remove(Food $food)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$food->id])) {
            unset($cart[$food->id]);
        }

        session()->put('cart', $cart);

        return $this->cartResponse(
            $cart,
            'Item removed from cart.'
        );
    }


    // Clear complete cart
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully.',
            'cart' => [],
            'cartCount' => 0,
            'cartTotal' => 0,
        ]);
    }


    // Common cart response
    private function cartResponse($cart, $message = null)
    {
        $cartCount = 0;
        $cartTotal = 0;

        foreach ($cart as $item) {

            $cartCount += $item['quantity'];

            $cartTotal +=
                $item['price'] * $item['quantity'];
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'cart' => $cart,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
        ]);
    }
}