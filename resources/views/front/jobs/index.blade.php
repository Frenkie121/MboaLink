@extends('layouts.front')

@section('subtitle', __('Jobs'))

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Job Listing')"
        {{-- :middleLink="request()->isMethod('post')" --}}
        {{-- :middleTitle="__('Jobs')" --}}
        {{-- :middleRouteName="route('front.jobs.index')"     --}}
    />
    <!-- Header End -->

    <!-- Search Start -->
    @include('includes.front.search-bar')
    <!-- Search End -->

    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Job Listing')</h1>
            @if ($category = request()->category)
                <h6 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('For category') 
                    <strong class="text-primary">{{ $category->name }} ({{ $category->jobs->count() }})</strong>
                </h6>
            @elseif (request()->isMethod('post'))
                <h6 class="text-center wow fadeInUp" data-wow-delay="0.1s">@lang('Search results') : <strong class="text-primary">{{ $jobs->count() }}</strong> @lang('job(s) found')
                </h6>
                <p class="text-center mb-5 fst-italic">
                    <small>
                        @lang('Keyword') : <strong class="text-primary">{{ request()->search ?? trans('Empty') }}</strong>,
                        @lang('Category') : <strong class="text-primary">{{ request()->sub_category ?? trans('Empty') }}</strong>,
                        @lang('Job Type') : <strong class="text-primary">{{ request()->type ? __(request()->type) : trans('Empty') }}</strong>
                    </small>
                </p>
            @endif
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        @foreach ($jobs as $job)
                            <x-front.job-item :job="$job" />
                        @endforeach
                        @if (! request()->isMethod('post'))
                            <div class="float-right mt-3">
                                {{ $jobs->links('vendor.pagination.bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs End -->
@endsection

@push('css')
    <style>
        .page-header {
            background: linear-gradient(rgba(43, 57, 64, .5), rgba(43, 57, 64, .5)), url({{ asset('assets/front/img/jobs-list.jpg') }}) center center no-repeat;
            background-color: rgba(0, 0, 0, 0);
            background-size: auto, auto;
            background-size: cover;
        }
    </style>
@endpush