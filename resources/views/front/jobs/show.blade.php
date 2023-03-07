@extends('layouts.front')

@section('subtitle', __('Jobs') | $job->title)

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="$job->title"
        :middleLink="true"
        :middleTitle="__('Jobs')"
        :middleRouteName="route('front.jobs.index')"
    />
    <!-- Header End -->

@endsection