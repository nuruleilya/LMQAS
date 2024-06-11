<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Livestock;

class CartController extends Controller
{
    public function index()
    {
        // Retrieve items in the cart for the authenticated user
        $cartItems = auth()->user()->cartItems;
        $cartItems = CartItem::with('livestock')->get();
        return view('cart', compact('cartItems'));
    }

    public function create(Request $request)
    {
        // Validate the request
        $request->validate([
            'livestock_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // Check if the item already exists in the cart
        $existingItem = auth()->user()->cartItems()->where('livestock_id', $request->livestock_id)->first();

        if ($existingItem) {
            // If the item exists, update the quantity
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity
            ]);
        } else {
            // If the item doesn't exist, create a new cart item
            auth()->user()->cartItems()->create([
                'livestock_id' => $request->livestock_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart successfully.');
    }

    public function destroy($id)
    {
        // Find the cart item by its ID
        $cartItem = CartItem::findOrFail($id);

        // Delete the cart item
        $cartItem->delete();

        // Redirect back to the cart with a success message
        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
    }
}