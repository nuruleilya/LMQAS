<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Livestock;
use App\Models\Payment;
use Auth;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        // Fetch cart items
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $totalAmount = $cartItems->sum(function ($item) {
            return $item->quantity * $item->livestock->price;
        });
        // Redirect to payment gateway (mock for this example)
        return view('checkout', compact('cartItems', 'totalAmount'));
    }

    public function paymentSuccess(Request $request)
    {
        // Handle successful payment
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $order = Order::create(['user_id' => Auth::id(), 'status' => 'paid']);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'livestock_id' => $cartItem->livestock_id,
                'quantity' => $cartItem->quantity,
            ]);

            // Update Livestock quantity
            $livestock = Livestock::find($cartItem->livestock_id);
            $livestock->quantity -= $cartItem->quantity;
            $livestock->save();
        }

        // Clear cart
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Payment successful and order created.');
    }

    public function paymentFailure(Request $request)
    {
        // Handle failed payment
        return redirect()->route('cart.index')->with('error', 'Payment failed, please try again.');
    }
}