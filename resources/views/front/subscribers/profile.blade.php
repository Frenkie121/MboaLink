@extends('layouts.front')

@section('subtitle', __('Profile'))

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />

@push('css')
    @livewireStyles
@endpush

@section('content')
    <div class="container-xxl py-5 row">
        @include('includes.front.subscriber-sidebar')
        <div class="col-md-8">
            <div class="wow fadeInUp" data-wow-delay="0.7s">
                <h3 class="text-center fw-bolder">@lang('Personal Information')</h3>
                <p class="mb-4 text-center fw-bold">@lang('Update your personal information using the form below')</p>
                @livewire('front.subscriber.update-profile')
            </div>
        </div>
    </div>
@endsection

@push('js')
    @livewireScripts
@endpush