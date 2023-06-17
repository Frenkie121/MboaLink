@extends('layouts.front')

@section('subtitle', __('Upgrade my subscription'))

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Upgrade my subscription')"
        :middleLink="true"
        :middleTitle="__('Pricing')"
        :middleRouteName="route('front.subscriptions.index')"
    />
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">@lang('Subscription upgrade')</h1>
            <h6 class="text-center mb-3 wow fadeInUp" data-wow-delay="0.1s">
                @if ($days_left < 7)
                    @lang('Click the button below to upgrade your subscription') <strong> @lang('Free') - <span class="text-secondary">{{ __($next_subscription['name']) }}</span></strong>
                    <br>
                    (<small class="text-center fw-bold mt-2">@lang('You still have') <span class="text-secondary">{{ intval($days_left) }} @lang('days').</span></small>)
                @else
                    @lang('You can renew your subscription one week before the end of the current one.')
                @endif
            </h6>
            <div class="row d-flex justify-content-center">
                @if ($days_left < 7)
                    <p class="fw-bold fs-5 text-center text-secondary">@lang('It will cost you') {{ $next_subscription['amount'] }} XAF.</p>
                    <div class="text-center">
                        <form action="{{ route('front.subscriptions.renew') }}" method="post">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary w-25">@lang('Upgrade')</button>
                        </form>
                    </div>
                @else
                    <p class="text-center fw-bold">@lang('You still have') <span class="text-secondary fs-5">{{ intval($days_left) }} @lang('days').</span></p>
                @endif
            </div>
        </div>
    </div>

@endsection