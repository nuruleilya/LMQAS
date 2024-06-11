@extends('layouts.user_type.auth')

@section('content')
    <div class="container mt-4">
        <div class="row mt-2">
            @if (session()->has('success') || session()->has('error'))
                <div id="alert">
                    @include('ManageLivestock.alert')
                </div>
            @endif
            @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="text-white mb-0">{{ session()->get('message') }}</p>
            </div>
            @endif
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Checkout</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>{{ $item->livestock->title }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>RM{{ $item->livestock->price }}</td>
                                        <td>RM{{ $item->quantity * $item->livestock->price }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                    <td><strong>RM{{ $totalAmount }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('payment.success') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm and Pay</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
        </div>
    </div>