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
                    <h3 class="card-title">Post New Livestock</h3>
                    <div class="text-center">
                        <form style="width: 70%; margin:auto" action={{ route('livestocks.store') }} class="form"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Livestock Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" required value="{{ old('title') }}"
                                    placeholder="eg. Pedigree Suffolk Breeding Ewes... (Max 255 words)">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="author">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" required value="{{ old('description') }}"
                                    placeholder="These beautiful girls will make a fantastic addition to any flock or be great as a starter flock...(Max 255 words)">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="type">Livestock Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" name="category"
                                    id="category" required>
                                    <option disabled selected value="default">Select Livestock Category</option>
                                    <option {{ old('category') == 'cattle' ? 'selected' : '' }} value="cattle">Cattle
                                    </option>
                                    <option {{ old('category') == 'sheep' ? 'selected' : '' }} value="sheep">Sheep</option>
                                    <option {{ old('category') == 'goat' ? 'selected' : '' }} value="goat">
                                        Goat
                                    </option>
                                </select>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Breed Type</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="breed_type" id="cross" value="Cross" {{ old('breed_type') == 'Cross' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cross">Cross</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="breed_type" id="purebred" value="Purebred" {{ old('breed_type') == 'Purebred' ? 'checked' : '' }}>
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
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" required value="{{ old('price') }}"
                                    placeholder="eg. 300.00" step="0.01" min="0">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="age">Age (month)</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror"
                                    id="age" name="age" required value="{{ old('age') }}"
                                    placeholder="age in month(s): eg. 3">
                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight"
                                    name="weight" required value="{{ old('weight') }}"
                                    placeholder="eg. 50">
                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-group mb-3">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                        name="quantity" required value="{{ old('quantity') }}"
                                        placeholder="eg. 50">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="image">Upload Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        id="image" name="image" required>
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            <button type="submit" style="width: 70%; background-color:#2A4C09" class="btn btn-view">Submit</button>
                        </form>
                        <a class="btn btn-secondary" style="width: 70%; background-color: #8BC34A" href="{{ route('home') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
