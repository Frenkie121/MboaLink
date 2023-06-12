<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} | @yield('subtitle')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/back/modules/bootstrap/css/bootstrap.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/back/css/style.css') }}">

    <style>
        .error, .error:hover {
            color: #f9460c;
        }

        .error-link, .error-link:hover {
            color: #40d38d;
        }
    </style>

</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="page-error error">
                    <div class="page-inner">
                        <h1>@yield('code')</h1>
                        <div class="page-description mt-5">
                            <h4 class="fw-bold">@yield('message')</h4>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 error">
                    <a class="error-link h6" href="{{ url()->previous() }}">@lang('Back')</a>
                </div>
                <div class="simple-footer mt-5">
                Copyright &copy; <a class="error-link" href="{{ route('front.home') }}">{{ config('app.name') }}</a> 2023
                </div>
            </div>
        </section>
    </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/back//modules/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>