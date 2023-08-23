@php
    $fr_locale = app()->getLocale() === 'fr';
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('subtitle') | {{ config('app.name', 'MboaLink') }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/favicon.png') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/front/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/front/css/style.css') }}" rel="stylesheet">

    <style>
        #lang {
            color: #f9460c !important;
        }
        #copyright-text {
            font-size: 65%;
        }

        #lang-dropdown {
            width: 180px;
        }

        .fs-custom {
            font-size: 10pt;
        }
        
        @media (min-width: 576px) {
            #logo-nav {
                margin-left: 15px;
            }
        }
        
        @media (max-width: 992px) {
            .auth {
                margin-left: 30px;
            }

            #auth-btn {
                margin-left: 15px;
                margin-bottom: 10px;
            }
        }

        @media (min-width: 1290px) {
            #navbar-nav {
                margin-left: 300px;
            }
            .auth {
                margin-left: 170px;
            }
            .auth-btn {
                margin-left: 110px;
            }
        }

        @media (max-width: 1050px) and (min-width: 992px) {
            #navbar-nav {
                margin-left: 100px;
            }

            .auth {
                margin-left: 38px;
            }

            #auth-btn {
                margin-left: 0;
            }
        }

        @media (max-width: 1290px) and (min-width: 1050px) {
            #navbar-nav {
                margin-left: 100px;
            }

            .auth {
                margin-left: 80px;
            }

            #auth-btn {
                min-width: 10px;
            }
        }
    </style>

    @stack('css')
</head>

<body>
    @include('sweetalert::alert')
    
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-danger" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">@lang('Loading...')</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        @include('includes.front.navbar')
        <!-- Navbar End -->

        @yield('content')
        
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">@lang('Quick Links')</h5>
                        <a class="btn btn-link text-white-50" href="{{ route('front.home') }}">@lang('Home')</a>
                        <a class="btn btn-link text-white-50" href="{{ route('front.jobs.index') }}">@lang('Jobs')</a>
                        <a class="btn btn-link text-white-50" href="{{ route('front.about') }}">@lang('About')</a>
                        <a class="btn btn-link text-white-50" href="{{ route('front.contact') }}">@lang('Contact')</a>
                        <a class="btn btn-link text-white-50" href="{{ route('front.faq') }}">@lang('FAQ')</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">@lang('Contact')</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Douala, @lang('Cameroon')</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+237 697 421 377</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>mboalink@gmail.com</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">@lang('Social Media')</h5>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="https://twitter.com/MboaLink?t=IjCfaY_61fhxuWnG8xv0IA&s=35" target="__blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/profile.php?id=100082315072957&mibextid=ZbWKwL" target="__blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://instagram.com/mboalink?igshid=NGExMmI2YTkyZg==" target="__blank"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href="#" title="@lang('Coming soon ...')"><i class="fab fa-linkedin-in" target="__blank"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">@lang('Change Language')</h5>
                        <div class="dropdown">
                            <button id="lang-dropdown" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">@if ($fr_locale) @lang('French') @else @lang('English') @endif</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item {{ $fr_locale ? 'active' : '' }}" href="{{ route('lang', 'fr') }}">@lang('French')</a></li>
                                <li><a class="dropdown-item {{ $fr_locale ? '' : 'active' }}" href="{{ route('lang', 'en') }}">@lang('English')</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div id="copyright-text" class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">{{ config('app.name') }}</a>, @lang('All Rights Reserved.')
                            <br>
                            <br>
                            @lang('Made By') <a class="border-bottom" href="https://bvision-lte.com" target="__blank">Better Vision</a>
                            <br>
                            @lang('Template Designed By') <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                            @lang('Distributed By') <a class="border-bottom" href="https://themewagon.com" target="_blank">ThemeWagon</a>
                            <br>
                            @lang('Some images are provided by') <a href="https://www.freepik.com/free-photo/composition-with-question-mark-urban-landscape_48050491.htm#query=faq&position=36&from_view=search&track=sph" target="_blank">Freepik</a>
                        </div>
                        {{-- <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/front/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/front/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/front/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
    
    <!-- Specific Page Ssripts -->
    @stack('js')
</body>

</html>