@extends('layouts.front')

@section('subtitle', __('Categories'))

@section('content')

    <!-- Header End -->
    <x-front.header :title="__('Categories')" />
    <!-- Header End -->

    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Explore By Category')</h1>
            <div class="row g-4">
                @foreach ($categories as $category)
                    <x-front.category-item :category="$category" />
                @endforeach
            </div>
            <div class="float-right mt-3">
                {{ $categories->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- Category End -->

@endsection