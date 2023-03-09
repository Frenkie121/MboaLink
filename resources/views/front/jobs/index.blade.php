@extends('layouts.front')

@section('subtitle', __('Jobs'))

@php
    $currentRouteName = Route::currentRouteName();
@endphp

@section('content')

    <!-- Header End -->
    <x-front.header :title="__('Jobs')" />
    <!-- Header End -->

    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">@lang('Job Listing')</h1>
            @if ($category = request()->category)
                <h6 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('For category') 
                    <strong class="text-primary">{{ $category->name }} ({{ $category->jobs->count() }})</strong>
                </h6>
            @endif
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        @foreach ($jobs as $job)
                            <x-front.job-item :job="$job" />
                        @endforeach
                        <div class="float-right mt-3">
                            {{ $jobs->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs End -->

@endsection