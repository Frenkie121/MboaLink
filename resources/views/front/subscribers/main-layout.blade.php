@extends('layouts.front')

@section('subtitle', $subtitle)

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />

@push('css')
    @livewireStyles
@endpush

@section('content')

    <div class="container-xxl py-5 row">
        @include('includes.front.subscriber-sidebar')
        <div class="col-md-9">
            <div class="wow fadeInUp" data-wow-delay="0.7s">
                {{ $slot }}
            </div>
        </div>
    </div>

@endsection

@push('js')
    @livewireScripts
@endpush