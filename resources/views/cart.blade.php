@extends('layouts.user_type.auth')

@section('content')
    <div class="container mt-4">
        <div class="row mt-2">
            
            <div class="card text-center">
                <div class="card-body">
                    <div class="container">
                        <h1>Shopping Cart</h1>
                        @if (count($cartItems) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $cartItem)
                                        <tr>
                                            <td>{{ $cartItem->livestock->title }}</td>
                                            <td>${{ $cartItem->livestock->price }}</td>
                                            <td>{{ $cartItem->quantity }}</td>
                                            <td>RM{{ $cartItem->livestock->price * $cartItem->quantity }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                                    <button type="submit">Update</button>
                                                </form>
                                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary" style="background-color: #2A4C09;">Proceed to Checkout</button>
                                </form>
                            </div>
                        @else
                            <p>Your cart is empty</p>
                        @endif
                    </div>
                </div>
            </div>

@endsection