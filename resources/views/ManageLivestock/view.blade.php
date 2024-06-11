@extends('layouts.user_type.auth')

@section('content')
    <div class="container mt-4">
        <div class="container mt-4">
            <div class="row mt-2">
                @if (session()->has('success') || session()->has('error'))
                    <div id="alert">
                        @include('ManageLivestock.alert')
                    </div>
                @endif
            </div>
        </div>
        <div class="card p-3">
            <div class="card-body">
                <h3 class="card-title">{{ $data->title ? $data->title : 'Livestock Title' }}</h3>
                <div>
                    <p>Category: {{ $data->category ? ucfirst($data->category) : 'Livestock Category' }}</p>
                    <p>Breed Type: {{ $data->breed_type ? $data->breed_type : 'Breed Type ' }}</p>
                    <p>Price: RM {{ $data->price ? $data->price : 'Livestock Price' }}</p>
                    <p>Weight: {{ $data->weight ? $data->weight : 'Livestock Weight' }}kg</p>
                    <p>Age: {{ $data->age ? $data->age : 'Livestock Age' }} month(s)</p>
                </div>
                <div>
                    <h4>Description</h4>
                    <p>{{ $data->description ? $data->description : 'Livestock Description' }}</p>
                </div>
                <div>    
                    <img src="{{ asset($data->image) }}" alt="{{ $data->title }}">

                </div>
                <div>
                    <form action="{{ route('livestock.addToCart', $data->id) }}" method="POST">
                        @csrf
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" max="{{ $data->quantity }}" required>
                        <button type="submit" class="btn btn-primary" style="background-color:#2A4C09">Add to Cart</button>
                    </form>
                    <a class="btn btn-secondary" style="background-color:#8BC34A" href="{{ route('home') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
