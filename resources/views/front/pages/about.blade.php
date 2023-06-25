@extends('layouts.front')

@section('subtitle', __('About'))

@section('content')

    <!-- Header End -->
    <x-front.header :title="__('About')" />
    <!-- Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100" src="{{ asset('assets/front/img/about-1.jpg') }}">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid" src="{{ asset('assets/front/img/about-3.jpg') }}" style="width: 85%; margin-top: 15%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid" src="{{ asset('assets/front/img/about-4.jpg') }}" style="width: 85%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100" src="{{ asset('assets/front/img/about-2.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">@lang('We help you get the best job and find talent')</h1>
                    <p class="mb-4 lh-lg" style="text-align: justify;"><strong>{{ config('app.name') }}</strong> @lang('is a start-up agency for employment born from a firm will to facilitate the professional insertion of any Cameroonian. It is in this optics that was set up this platform in order to bring closer to the companies, the job seekers and of professional training course, in this way they will be on the lookout for the least advertisement or request of those.')</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    
    <!-- Targets Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="text-center mb-5">@lang('Our target audience')</h1>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item bg-light rounded p-4">
                    <h3 class="text-primary mb-3"> @lang('Companies')</h3>
                    <p style="text-align: justify;">@lang('You are a company looking for interns or qualified personnel, subscribe with the company status and publish your recruitment ads while benefiting from our tools and formulas in order to reach more quickly your objectives and improve your MboaLink experience.')</p>
                    <div class="d-flex align-items-center">
                        {{-- <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div> --}}
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <h3 class="text-primary mb-3"> @lang('Unemployed ')</h3>
                    <p style="text-align: justify;">@lang('You are a Cameroonian graduate, without a permanent job and maybe even with exceptional aptitude in one or more professional fields and wish to register in a career project, subscribe with the status without permanent job and apply for the position that corresponds to your abilities while benefiting from our tools and formulas to reach your goals faster and your objectives and enhance your MboaLink experience.')</p>
                    <div class="d-flex align-items-center">
                        {{-- <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div> --}}
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <h3 class="text-primary mb-3"> @lang('Students')</h3>
                    <p style="text-align: justify;">@lang('You are a Cameroonian student, at the beginning, middle or end of your studies, and you wish to put into practice your knowledge, discover the world of work and acquire a professional experience; subscribe with the STUDENT status and benefit from our tools and formulas in order to reach your objectives and enhance your MboaLink experience.')</p>
                    <div class="d-flex align-items-center">
                        {{-- <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div> --}}
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <h3 class="text-primary mb-3"> @lang('Pupils')</h3>
                    <p style="text-align: justify;">@lang('You are a Cameroonian pupil, eager to acquire professional skills in order to develop your abilities faster and arrive with a head start on the job market, subscribe with the pupil status and benefit from our tools and formulas in order to reach your objectives and enhance your MboaLink experience.')</p>
                    <div class="d-flex align-items-center">
                        {{-- <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg" style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Targets End -->

@endsection

@push('css')
    <style>
        .page-header {
            background: linear-gradient(rgba(43, 57, 64, .5), rgba(43, 57, 64, .5)), url({{ asset('assets/front/img/about-main.jpg') }}) center center no-repeat;
            background-color: rgba(0, 0, 0, 0);
            background-size: auto, auto;
            background-size: cover;
        }
    </style>
@endpush