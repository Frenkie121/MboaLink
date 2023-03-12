@extends('layouts.front')

@section('subtitle', __('Jobs') . ' | ' . __('Post A Job'))

@push('css')
    @livewireStyles
    <link href="{{ asset('assets/front/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        .btn-danger {
            background-color: #f9460c;
            border-color: #f9460c;
        }
        .btn-danger:hover {
            background-color: #f9460c;
            border-color: #f9460c;
        }
        .isDisabled {
            color: #fff;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <!-- Header End -->
    <x-front.header
        :title="__('Post A Job')"
        :middleLink="true"
        :middleTitle="__('Jobs')"
        :middleRouteName="route('front.jobs.index')"
    />
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container" id="tabs">
            <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">@lang('Post A Job')</h1>
        <h6 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Follow the steps below to post a job') 
            @livewire('front.create-job')
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/front/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>

    @livewireScripts
@endpush