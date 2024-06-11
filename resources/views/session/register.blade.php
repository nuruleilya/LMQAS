@extends('layouts.user_type.guest')

@section('content')
    <section class="min-vh-100 mb-8" style="background-image: url('../assets/img/regBG.png');">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome to LMQAS!</h1>
                        <p class="text-lead text-white">Fill in this form to create new account.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Sign Up</h5>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" method="POST" action="/register">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                        id="name" aria-label="Name" aria-describedby="name"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Address" name="address"
                                        id="address" aria-label="address" value="{{ old('address') }}">
                                    @error('address')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Phone" name="phone"
                                        id="phone" aria-label="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                        id="email" aria-label="Email" aria-describedby="email-addon"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" name="role" id="role">
                                        <option disabled selected value="default">Select Your Role</option>
                                        <option value="buyer">Buyer</option>
                                        <option value="seller">Seller</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    @error('role')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn" style="background-color: #2A4C09; color: white">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="login"
                                        class="font-weight-bolder" style="color: #2A4C09">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
