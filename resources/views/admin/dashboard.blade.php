@extends('layouts.back')

@section('subtitle', __('Dashboard'))

@section('content')

    {{-- <div class="section-header"> --}}
    {{-- <h1>@lang('Dashboard')</h1> --}}
    <x-admin.section-header :title="__('Statistics')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />
    {{-- </div> --}}


    <div class="section-body">
        <div class="container">
            {{-- <form class="form-inline">
                <div class="form-group mr-2">
                    <label for="Name2">@lang('Start')</label>
                    <input type="date" name="startDate" id="oldest-date" class="form-control">
                    @error('startDate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mr-2">
                    <label for="Email2">@lang('End')</label>
                    <input type="date" name="endDate" id="todays-date" class="form-control">
                    @error('endDate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

            </form> --}}
        </div>
        <hr>
        <div class="row">
            <div class="">

            </div>
        </div>

    </div>
    <div class="row"></div>
    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4> @lang('Users')</h4>
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
                    <i class="fas fa-plug" style="font-size: 2em; color: white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Subscriptions')</h4>
                    </div>
                    <div class="card-body">
                        {{ $subscriptions }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-dollar-sign" style="font-size: 2em; color: white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Balance')</h4>
                    </div>
                    <div class="card-body">
                        <h6>{{ formatMoney($money) }} XAF</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fa fa-briefcase" style="font-size: 2em; color: white"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>@lang('Jobs')</h4>
                    </div>
                    <div class="card-body">
                        {{ $CountJob }}
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row">

        <br>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                {!! $subscriptionsAccount->container() !!}
            </div>
        </div>
        <div class="col-xl-8 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div id="revenue"> {!! $ChartUserData->container() !!}</div>
                </div>
            </div>
        </div>


        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                {!! $JobPie->container() !!}
            </div>
        </div>
        <div class="row col-12">
            {{-- <div class="col-md-12 col-sm-12 col-lg-12"> --}}
            <div class="card col-lg-8 ">
                <div class="card-body">
                    {!! $usersChart->container() !!}
                </div>
            </div>
            <div class="card col-lg-4">
                <div class="card-body">
                    {!! $Jobs->container() !!}
                </div>
            </div>
            {{-- </div> --}}

        </div>

    @endsection

    @push('js')
        <script>
            var today = new Date();
            // today Date
            var dd = ("0" + (today.getDate())).slice(-2);
            var mm = ("0" + (today.getMonth() + 1)).slice(-2);
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;

            $("#todays-date").attr("value", today);
            $("#oldest-date").attr("value", "2023-01-01");
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
        {!! $usersChart->script() !!}
        {!! $ChartUserData->script() !!}
        {!! $subscriptionsAccount->script() !!}
        {!! $Jobs->script() !!}
        {!! $JobPie->script() !!}
        {{-- ChartScript --}}
        {{-- @if ($usersChart)
    @endif --}}


        <script src="https://unpkg.com/vue"></script>
        <script>
            var app = new Vue({
                el: '#app',
            });
        </script>
        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {{-- {!! $chart->script() !!} --}}
    @endpush
