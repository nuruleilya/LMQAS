<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function sellerOrders()
{
    $orders = Order::with('orderItems.livestock')->whereHas('orderItems.livestock', function($query) {
        $query->where('user_id', Auth::id());
    })->get();

    return view('seller.orders', compact('orders'));
}
}
