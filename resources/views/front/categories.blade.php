@extends('layouts.front')

@section('subtitle', __('Categories'))

@section('content')

    <!-- Header End -->
    <x-front.header :title="__('Categories')" : />
    <!-- Header End -->

    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Explore By Category')</h1>
            <div class="row g-4">
                @foreach ($categories as $category)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.{{ array_rand([1, 3, 5, 7]) }}s">
                        <a class="cat-item rounded p-4" href="">
                            <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>
                            <h6 class="mb-3">{{ $category->name }}</h6>
                            {{-- <p class="mb-0">123 Vacancy</p> --}}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category End -->

@endsection