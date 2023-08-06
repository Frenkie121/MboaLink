@extends('layouts.back')

@section('subtitle', __('Dashboard'))

@section('content')

    {{-- <div class="section-header"> --}}
    {{-- <h1>@lang('Dashboard')</h1> --}}
    <x-admin.section-header :title="__('Statistics')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />
    {{-- </div> --}}


    <div class="section-body">
        <div class="row">
            <div class="col-md-6">
                {!! $ChartUserData->container() !!}
            </div>

            <div class="col-md-6">
                {!! $usersChart->container() !!}
            </div>
            <div class="col-md-6">
                {!! $chart2->container() !!}
            </div>

        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    {{-- ChartScript --}}
    @if ($usersChart)
        {!! $ChartUserData->script() !!}
        {!! $usersChart->script() !!}
        {!! $chart2->script() !!}
    @endif


    <script src="https://unpkg.com/vue"></script>
    <script>
        var app = new Vue({
            el: '#app',
        });
    </script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
    {{-- {!! $chart->script() !!} --}}
@endpush
