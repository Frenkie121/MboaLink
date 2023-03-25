@extends('layouts.front')

@section('subtitle', __('Pricing'))

@section('content')

    <!-- Header End -->
    <x-front.header :title="__('Pricing')" />
    <!-- Header End -->

    <!-- Plans Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Our Subscription Plans')</h1>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                @foreach ([1, 2, 3, 4, 5] as $item)
                    <x-front.subscription-item />
                @endforeach
            </div>
        </div>
    </div>
    <!-- Plans End -->

@endsection