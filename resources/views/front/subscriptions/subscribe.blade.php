@extends('layouts.front')

@section('subtitle', __('Pricing') . ' | ' . __($subscription->name))

@push('css')
    @livewireStyles
    <style>
        .btn-danger {
            background-color: #f9460c;
            border-color: #f9460c;
        }
        .btn-danger:hover {
            background-color: #f9460c;
            border-color: #f9460c;
        }
        .isDisabled {
            color: #fff;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Subscription') . ' ' . __($subscription->name)"
        :middleLink="true"
        :middleTitle="__('Pricing')"
        :middleRouteName="route('front.subscriptions.index')"
    />
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container" id="tabs">
            <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">@lang('Subscribe to a new subscription')</h1>
            <h6 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                @lang('Fill the form below to save your subscription')
            </h6>
            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                    @livewire('front.subscriptions')
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    @livewireScripts
@endpush

@push('css')
    <style>
        .page-header {
            background: linear-gradient(rgba(43, 57, 64, .5), rgba(43, 57, 64, .5)), url({{ asset('assets/front/img/pricing.jpg') }}) center center no-repeat;
            background-color: rgba(0, 0, 0, 0);
            background-size: auto, auto;
            background-size: cover;
        }
    </style>
@endpush