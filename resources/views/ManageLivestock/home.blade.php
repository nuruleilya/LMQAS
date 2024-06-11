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
    <div class="row">
        <div class="col-lg-9">
            <h3>Livestock</h3>
            <p>Browse the latest listings for livestock available for purchase.</p>
        </div>
        <div class="col-lg-3">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'seller')
                <a href="{{ route('livestocks.create') }}" class="btn" style="background-color: #2A4C09; color:white">Post Livestock</a>
            @endif
        </div>
    </div>
    @if ($datas->isEmpty())
        <div class="row mt-4">
            <h6>Currently no livestock are available...</h6>
        </div>
    @else
        @php $count = 0; @endphp
        @foreach ($datas as $data)
            @if ($count % 3 == 0)
                <div class="row mt-4">
            @endif
            <div class="col-lg-4 mb-2">
                <div class="card h-100 p-3">
                    <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100">
                        <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                            <h5 class="font-weight-bolder mb-4 pt-2">
                                {{ $data->title ? $data->title : 'Livestock Title' }}
                            </h5>
                            <p class="text-sm">Price: RM{{ $data->price }}</p>
                           
                            <a class="text-sm font-weight-bold mb-0 icon-move-right mt-auto"
                                href="{{ route('livestocks.view', ['id' => $data->id]) }}">
                                View Details
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @php $count++; @endphp
            @if ($count % 3 == 0 || $loop->last)
                </div>
            @endif
        @endforeach
    @endif
@endsection
