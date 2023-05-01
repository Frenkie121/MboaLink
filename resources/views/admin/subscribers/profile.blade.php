@extends('layouts.back')

@section('subtitle', __('Subscriber profile'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <x-admin.section-header :title="__('Subscriber profile')" :previousTitle="__('Subscribers List')" :previousRouteName="route('admin.subscribers.talent.index')" />

    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">

                        <img alt="image"
                            src="@if ($user->role_id !== 2 && is_null($user->userable->logo)) {{ asset('assets/back/img/avatar/avatar-2.png') }} @else {{ asset($user->userable->logo) }} @endif" 
                            class="rounded-circle profile-widget-picture">
                    </div>

                    <div class="profile-widget-description">
                        <div class="profile-widget-name"> {{ $user->name }} <div
                                class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div>{{ $user->subscriptions->last()->name }}
                            </div>
                        </div>
                        <div class="row"></div>

                        <hr>
                        <h6 class="text-center">@lang('General Informations')</h6>
                        <br>
                        <span class="mr-2">@lang('Email') :</span>
                        <b>{{ $user->email }}</b> <span class="mr-2 ml-4">@lang('Phone Number') :</span>
                        @if ($user->phone_number)
                            {{ $user->phone_number }}
                        @else
                            @lang('Any')
                        @endif

                        <br><br>
                        <span class="mr-2">@lang('Birth Date') :</span>
                        @if ($user->birth_date)
                            {{ $user->birth_date }}
                        @else
                            @lang('Any')
                        @endif
                        <br><br>
                        <hr>

                    </div>

                    @if ($user->role_id > 2)
                        <div class="profile-widget-description">


                            <h6 class="text-center">@lang('Personal Informations')</h6>
                            <br>

                            <span class="mr-2">@lang('Name') :</span> {{ $user->subscriptions->first()->name }}

                            <span class="mr-2 ml-4">@lang('Location') :</span> <b>{{ $user->userable->location }}</b><br>
                            <br>
                            <span class="mr-2">@lang('Aspirations') : </span><b>{{ $user->userable->aspiration }}</b>
                            <span class="mr-2 ml-4">@lang('Language') :</span><b>{{ $user->userable->language }}</b>
                            <br><br>
                            <span class="mr-2"> @lang('Category') : </span> <b>{{ $user->userable->category->name }}</b>

                            <span class="mr-2 ml-4"> @lang('CV') : </span><a href="#"
                                class="btn btn-primary"><i class="fa fa-download"></i> </a> <br> <br>
                            <hr>
                            <h6 class="text-center">@lang('More details')</h6>
                            <br>
                            @if ($user->role->id === 3)
                                {{-- Student --}}
                                <span class="mr-2">@lang('University of ') :</span>
                                <b>{{ $user->userable->talentable->university }}</b> <br><br>
                                <span class="mr-2">@lang('Training school') :</span><b>
                                    {{ $user->userable->talentable->training_school }}</b> <br><br>
                                <span class="mr-2">@lang('Field ') :</span>
                                @if ($user->userable->talentable->field)
                                    {{ $user->userable->talentable->field }}
                                @else
                                    @lang('Any')
                                @endif <br><br>
                                <span class="mr-2">@lang('Level') :</span>
                                @if ($user->userable->talentable->level)
                                    {{ $user->userable->talentable->level }}
                                @else
                                    @lang('Any')
                                @endif
                                <br><br>
                            @elseif ($user->role->id === 4)
                                {{-- Pupil --}}
                                <span class="mr-2">@lang('Section') :</span>
                                <b>{{ $user->userable->talentable->section }}</b>
                                <span class="mr-2 ml-4">@lang('Serie') :</span>
                                @if ($user->userable->talentable->serie)
                                    {{ $user->userable->talentable->serie }}
                                @else
                                    No-data
                                @endif
                                <br><br>
                                <span class="mr-2">@lang('Class') :</span>
                                @if ($user->userable->talentable->class)
                                    {{ $user->userable->talentable->class }}
                                @else
                                    No-data
                                @endif

                                <span class="mr-2 ml-4">@lang('School') :</span>
                                @if ($user->userable->talentable->school)
                                    {{ $user->userable->talentable->school }}
                                @else
                                    No-data
                                @endif
                                <br><br>
                            @elseif ($user->role->id === 5)
                                {{-- Unemployment --}}
                                {{-- Pupil --}}
                                <span class="mr-2">@lang('Diploma') :</span>
                                <b>{{ $user->userable->talentable->diploma }}</b> <br><br>
                                <span class="mr-2">@lang('Current Job') :</span><b>
                                    {{ $user->userable->talentable->current_job }}</b> <br><br>
                                <span class="mr-2">@lang('Aptitudes') :</span>
                                @if ($user->userable->talentable->aptitudes)
                                    {{ $user->userable->talentable->aptitudes }}
                                @else
                                    No-data
                                @endif

                                <br><br>
                                <span class="mr-2">@lang('Qualifications') :</span>
                                @if ($user->userable->talentable->qualifications)
                                    {{ $user->userable->talentable->qualifications }}
                                @else
                                    No-data
                                @endif
                                <br><br>

                            @endif

                        </div>
                    @elseif($user->role_id === 2)
                        <div class="profile-widget-description">

                            <h6 class="text-center">@lang('Other informations')</h6>
                            <br>
                            <span class="mr-2">@lang('Location') :</span>
                            <b>{{ $user->userable->location }}</b> <br><br>
                            <span class="mr-2">@lang('Website') :</span><b>
                                {{ $user->userable->url }}</b> <br><br>
                            <span class="mr-2">@lang('Description') :</span>
                            @if ($user->userable->description)
                                <span style="text-align: justify;">{{ $user->userable->description }}</span>
                            @else
                                @lang('Any')
                            @endif <br><br>
                            <span class="mr-2">@lang('Category') :</span>
                            @if ($user->userable->category->name)
                                {{ $user->userable->category->name }}
                            @else
                                @lang('Any')
                            @endif
                            <br><br>
                        </div>

                        <img src="{{ asset('storage/companies/' . $user->userable->logo) }}" alt="">
                    @endif

                </div>


            </div>




            {{-- ----------------------- --}}
            <div class="col-12 col-md-12 col-lg-7 row">
                <div class="card ">
                    <div class="row p-5">
                        @livewire('admin.profile-subscriber.suscription-list', ['user' => $user])
                    </div>
                </div>
            </div>

            {{-- ------------------------ --}}


        </div>
    </div>


@endsection
