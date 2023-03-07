@extends('layouts.front')

@section('subtitle', __('Jobs') . ' | ' . __('Post A Job'))

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Post A Job')"
        :middleLink="true"
        :middleTitle="__('Jobs')"
        :middleRouteName="route('front.jobs.index')"
    />
    <!-- Header End -->

@endsection