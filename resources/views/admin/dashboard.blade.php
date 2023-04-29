@extends('layouts.back')

@section('subtitle', __('Dashboard'))

@section('content')

    <div class="section-header">
        <h1>@lang('Dashboard')</h1>
    </div>
    {{--  ---------- Users -------------- --}}
    <h4 class="text-center"> @lang('Statitics Users')</h4> <br>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total @lang('Users')</h4>
                    </div>
                    <div class="card-body">
                        {{ $users }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Subscribers')</h4>
                    </div>
                    <div class="card-body">
                        {{ $subscribers }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('User Not Suscribe')</h4>
                    </div>
                    <div class="card-body">
                        {{ $users - $subscribers }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Online Users</h4>
                    </div>
                    <div class="card-body">
                        47
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- --------------- Jobs -------------------- --}}
    <h4 class="text-center"> @lang('Statitics Jobs')</h4><br>

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fab fa fa-briefcase"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total @lang('Jobs')</h4>
                    </div>
                    <div class="card-body">
                        {{ $jobs }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fab fa-phoenix-framework"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Disabled Jobs')</h4>
                    </div>
                    <div class="card-body">
                        {{ $jobs - $enableJobs }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Enable Jobs')</h4>
                    </div>
                    <div class="card-body">
                        {{ $enableJobs }}
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Online Users</h4>
                    </div>
                    <div class="card-body">
                        47
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


@endsection

@push('js')
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/back/js/page/index-0.js') }}"></script>
@endpush
