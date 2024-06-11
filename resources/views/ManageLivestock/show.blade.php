@extends('layouts.user_type.auth')

@section('content')
    <div class="container mt-4">
        <div class="row mt-2">
            @if (session()->has('success') || session()->has('error'))
                <div id="alert">
                    @include('ManageLivestock.alert')
                </div>
            @endif
        </div>
    </div>

    <div class="card text-center">
        <div class="card-body">
            <h3 class="card-title">View Livestock Post</h3>
            <div class="text-center" style="width: 80%; margin:auto">
                <div class="form-group mb-3">
                    <label for="title">Livestock Title</label>
                    <input disabled type="text" class="form-control" id="title" name="title"
                        value="{{ $data->title ? $data->title : 'Livestock Title' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <input disabled type="text" class="form-control" id="description" name="description"
                        value="{{ $data->description ? $data->description : 'Description' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="category">Livestock Category</label>
                    <select disabled class="form-select" name="category" id="category">
                        <option {{ $data->type == 'default' ? 'selected' : '' }} value="$data->type">Select Category</option>
                        <option {{ $data->type == 'cattle' ? 'selected' : '' }} selected value="$data->type">Cattle</option>
                        <option {{ $data->type == 'sheep' ? 'selected' : '' }} value="$data->type">Sheep</option>
                        <option {{ $data->type == 'goat' ? 'selected' : '' }} value="$data->type">Goat</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="breed_type">Breed Type</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="breed_type" id="cross" value="Cross" {{ $data->breed_type == 'Cross' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="cross">Cross</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="breed_type" id="purebred" value="Purebred" {{ $data->breed_type == 'Purebred' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="purebred">Purebred</label>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <input disabled type="text" class="form-control" id="price" name="price"
                        value="{{ $data->price ? $data->price : 'Livestock Price' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="age">Age (month)</label>
                    <input disabled type="text" class="form-control" id="age" name="age"
                        value="{{ $data->age ? $data->age : 'Livestock Age' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="weight">Weight (kg)</label>
                    <input disabled type="text" class="form-control" id="weight" name="weight"
                        value="{{ $data->weight ? $data->weight : 'Livestock Weight' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Quantity</label>
                    <input disabled type="text" class="form-control" id="quantity" name="quantity"
                        value="{{ $data->quantity ? $data->quantity : 'Livestock Quantity' }}">
                </div>
                <div class="form-group mb-3">
                    <label for="image">Livestock Image</label><br>
                    @if ($data->image)
                        <img src="{{ $data->image }}" alt="Livestock Image" style="max-width: 200px;">
                    @else
                        <p>No Image Found</p>
                    @endif
                </div>                
                <a class="btn btn-secondary" style="width: 70%" href="{{ route('livestocks-list') }}">Back</a>
            </div>
        </div>
    </div>
    </div>
@endsection
