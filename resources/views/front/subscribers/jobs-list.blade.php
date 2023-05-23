@extends('layouts.front')

@section('subtitle', __('Profile'))

@section('content')

    <!-- Header End -->
    {{-- <x-front.header :title="__('Profile')" /> --}}
    <!-- Header End -->

    <!-- Plans Start -->
    <div class="container-xxl py-5">
        @include('includes.front.subscriber-sidebar')
        <div class="container">
            
        </div>
    </div>
    <!-- Plans End -->

@endsection