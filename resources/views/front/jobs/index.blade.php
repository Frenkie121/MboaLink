@extends('layouts.front')

@section('subtitle', __('Jobs'))

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Search results')"
        :middleLink="request()->isMethod('post')"
        :middleTitle="__('Jobs')"
        :middleRouteName="route('front.jobs.index')"    
    />
    <!-- Header End -->

    <!-- Search Start -->
    <div class="container-fluid bg-secondary mb-3 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <form action="{{ route('front.jobs.search') }}" method="post">
                @csrf
                <div class="row g-2">
                    <div class="col-md-9">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="search" class="form-control border-0" name="search" placeholder="@lang('Eg.: Web Developper, Marketing, ...')" value="{{ request()->search ?? '' }}" />
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" name="sub_category">
                                    <option disabled selected>@lang('Select a category')</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option @selected(request()->sub_category === $subCategory->name) value="{{ $subCategory->name }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" name="type">
                                    <option disabled selected>@lang('Job Type')</option>
                                    @foreach ($types as $type)
                                        <option @selected(request()->type === $type) value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex d-inline">
                        <button type="submit" class="btn btn-primary border-0 w-100">@lang('Search')</button>
                        <button type="reset" class="btn btn-dark border-0 w-100">@lang('Clear')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
                        @lang('Job Type') : <strong class="text-primary">{{ request()->type ?? trans('Empty') }}</strong>
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