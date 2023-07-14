@extends('layouts.front')

@section('subtitle', __('Home'))

@section('content')
    
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/front/img/carousel-home-0.jpg') }}" alt="{{ config('app.name') }}" id="home-bg">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">@lang("MBOALINK, THE CHOICE OF EMPLOYMENT NEARBY.")</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/front/img/carousel-home-1.jpg') }}" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">@lang('FIND THE BEST JOB THAT FIT YOU.')</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Search Start -->
    @include('includes.front.search-bar')
    <!-- Search End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100" src="{{ asset('assets/front/img/about-3.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid" src="{{ asset('assets/front/img/about-1.jpg') }}" style="width: 85%; margin-top: 15%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid" src="{{ asset('assets/front/img/about-2.jpg') }}" style="width: 85%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100" src="{{ asset('assets/front/img/about-4.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-3">@lang('We help you get the best job and find talent')</h1>
                    <p class="mb-3 lh-lg" style="text-align: justify;"><strong>{{ config('app.name') }}</strong> @lang('is a start-up agency for employment born from a firm will to facilitate the professional insertion of any Cameroonian. It is in this optics that was set up this platform in order to bring closer to the companies, the job seekers and of professional training course, in this way they will be on the lookout for the least advertisement or request of those.') @lang('We mainly assist:')</p>
                    <p><i class="fa fa-check text-primary me-3"></i>@lang('Companies')</p>
                    <p><i class="fa fa-check text-primary me-3"></i>@lang('Unemployed')</p>
                    <p><i class="fa fa-check text-primary me-3"></i>@lang('Students')</p>
                    <p><i class="fa fa-check text-primary me-3"></i>@lang('Pupils')</p>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('front.about') }}">@lang('Read More')</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Plans Start -->
    <div class="container-xxl py-5" id="pricing">
        <div class="container">
            <hr>
            <h1 class="text-center mb-3 wow fadeInUp" data-wow-delay="0.1s">@lang('Our Best Subscription Plans')</h1>
            <div class="row row-cols-1 row-cols-md-3 text-center">
                @foreach ($subscriptions as $subscription)
                    <x-front.subscription-item :subscription="$subscription" />
                @endforeach
            </div>
            <div class="text-center" style="margin-top: 45px">
                <a class="btn btn-primary py-3 px-5" href="{{ route('front.subscriptions.index') }}">@lang('See All Plans')</a>
            </div>
        </div>
    </div>
    <!-- Plans End -->

    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <hr>
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Latest Jobs')</h1>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                @auth
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            @foreach ($jobs as $job)
                                <x-front.job-item :job="$job" />
                            @endforeach
                            <a class="btn btn-primary py-3 px-5" href="{{ route('front.jobs.index') }}">@lang('Browse More Jobs')</a>
                        </div>
                    </div>
                @else
                    <a href="#pricing" class="h6 text-primary">@lang('Subscribe to see the different jobs.')</a>
                @endauth
            </div>
        </div>
    </div>
    <!-- Jobs End -->

    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <hr>
            <h1 class="text-center mb-3 wow fadeInUp" data-wow-delay="0.1s">@lang('Explore By Category')</h1>
            <div class="row g-4">
                @foreach ($categories as $category)
                    <x-front.category-item :category="$category" />
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category End -->

@endsection