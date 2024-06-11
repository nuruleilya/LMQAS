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
        <div class="card text-center">
            <div class="card-body">
                <h3 class="card-title">Edit Livestock Post</h3>
                <div class="text-center">
                    <form style="width: 80%; margin:auto" action={{ route('livestocks.update', ['id' => $data->id]) }}
                        class="form" method="post" enctype="multipart/form-data" role="form">
                        @csrf
                        @method('PUT')
                        <input hidden type="text" class="form-control @error('file') is-invalid @enderror"
                            id="publisher_id" name="publisher_id" required
                            value="{{ $data->publisher_id ? $data->publisher_id : 'publisher_id' }}">
                        <div class="form-group mb-3">
                            <label for="title">Livestock Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" required value="{{ $data->title ? $data->title : 'Livestock Title' }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description" required value="{{ $data->description ? $data->description : 'Livestock Description' }}">
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Livestock Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" name="category" id="category">
                                <option disabled {{ $data->category == 'default' ? 'selected' : '' }} value="default">Select Livestock Category</option>
                                <option {{ $data->category == 'cattle' ? 'selected' : '' }} selected value="cattle">Cattle</option>
                                <option {{ $data->category == 'sheep' ? 'selected' : '' }} value="sheep">Sheep</option>
                                <option {{ $data->category == 'goat' ? 'selected' : '' }} value="goat">Goat</option>
                            </select>
                            @error('category')
                                <spantype class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </spantype>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="breed_type">Breed Type</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="breed_type" id="cross" value="Cross" {{ $data->breed_type == 'Cross' ? 'checked' : '' }}>
                                <label class="form-check-label" for="cross">Cross</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="breed_type" id="purebred" value="Purebred" {{ $data->breed_type == 'Purebred' ? 'checked' : '' }}>
                                <label class="form-check-label" for="purebred">Purebred</label>
                            </div>
                            @error('breed_type')
                                <div class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                            </div>
                        <div class="form-group mb-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required value="{{ $data->price }}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>  
                        <div class="form-group mb-3">
                            <label for="age">Age</label>
                            <input type="number" class="form-control @error('age') is-invalid @enderror" id="age" name="age" required value="{{ $data->age }}">
                            @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="weight">Weight</label>
                            <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" required value="{{ $data->weight }}">
                            @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" required value="{{ $data->quantity }}">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Livestock Image</label><br>
                            <img src="{{ asset($data->image) }}" alt="Livestock Image" style="max-width: 100px;">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" style="width: 80%; background-color:#2A4C09" class="btn btn-view">Save</button>

                    </form>
                    <a class="btn btn-secondary" style="width: 70%; background-color: #8BC34A" href="{{ route('livestocks-list') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
