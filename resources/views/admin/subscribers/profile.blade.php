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
    <x-admin.section-header :title="__('Subscriber profile')" :previousTitle="__('Subscribers List')" :previousRouteName="url()->previous() === route('admin.subscribers.talent.index')
        ? route('admin.subscribers.talent.index')
        : route('admin.subscribers.company.index')" />

    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-7">

                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image"
                            src="@if (!$user->userable->logo) {{ asset('assets/back/img/avatar/avatar-2.png') }} @else {{ asset($user->userable->logo) }} @endif"
                            class="rounded-circle profile-widget-picture" width="100px" height="100px">
                    </div>

                    <div class="profile-widget-description">
                        <div class="profile-widget-name"> {{ $user->name }} <div
                                class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div>
                                {{ $user->userable_type !== 'App\Models\Company' ? __('Talent') : __('Company') }}

                                <div class="slash"></div>
                                @if ($user->userable->talentable_type === 'App\Models\Student')
                                    @lang('Student')
                                @elseif ($user->userable->talentable_type === 'App\Models\Unemployed')
                                    @lang('Unemployed')
                                @elseif ($user->userable->talentable_type === 'App\Models\Pupil')
                                    @lang('Pupil')
                                @endif

                                <div
                                    class="badge badge-{{ $user->subscriptions->last()->id === 1 ? 'danger' : 'success' }}">
                                    @if ($user->subscriptions->last()->id === 1)
                                        @lang('Free')
                                    @else
                                        @lang('Premuim')
                                    @endif
                                </div>

                            </div>
                        </div>
                        <div class="row"></div>
                        <hr>
                        <h6>@lang('General Informations')</h6>
                        <br> <br>
                        <span class="mr-2">@lang('Email') :</span>
                        <b>{{ $user->email }}</b> <span class="mr-2 ml-4">@lang('Phone Number') :</span>
                        @if ($user->phone_number)
                            <b> {{ $user->phone_number }}</b>
                        @else
                            @lang('Any')
                        @endif
                        <br><br>
                        @if ($user->userable_type !== 'App\Models\Company')
                            <span class="mr-2">@lang('Birth Date') :</span>
                            @if ($user->userable->birth_date)
                                <b>{{ $user->userable->birth_date }}</b>
                            @else
                                @lang('Any')
                            @endif
                        @endif

                        <br><br>
                        <hr>

                    </div>

                    @if ($user->userable_type !== 'App\Models\Company')
                        <div class="profile-widget-description">

                            <h6>@lang('Personal Informations')</h6>
                            <br><br>

                            <span class="mr-2"> @lang('Research Area') : </span> <b>{{ $user->userable->category->name }}</b>

                            <span class="mr-2 ml-4">@lang('Location') :</span> <b>{{ $user->userable->location }}</b><br>
                            <br>
                            <span class="mr-2">@lang('Language') :</span><b>
                                @if ($user->userable->language === 'fr')
                                    @lang('French')
                                @elseif($user->userable->language === 'en')
                                    @lang('English')
                                @elseif($user->userable->language === 'bi')
                                    @lang('Bilingual')
                                @endif
                            </b>

                            <span class="mr-6 ml-4"> @lang('CV') : </span><a
                                href="{{ route('admin.subscribers.download', $user) }}" class="btn btn-primary"
                                title="@lang('Download')"><i class="fa fa-download"></i> </a>
                            <br><br>
                            <p> @lang('Aspirations') : <strong> {{ $user->userable->aspiration }}</strong> </p>

                            <hr>

                            @if ($user->role->id === 3)
                                @include('includes.back.subscribers.student')
                            @elseif ($user->role->id === 4)
                                {{-- Pupil --}}
                                @include('includes.back.subscribers.pupil')
                            @elseif ($user->role->id === 5)
                                @include('includes.back.subscribers.unemployed')
                            @endif
                        </div>
                    @elseif($user->userable_type === 'App\Models\Company')
                        @include('includes.back.subscribers.company')
                    @endif

                </div>
            </div>




            {{-- ----------------------- --}}
            <div class="col-12 col-md-12 col-lg-5">

                <div class="card profile-widget">
                    <h4 class="m-3">@lang('Subscription list')</h4>
                    <div class="row p-5">
                        @livewire('admin.profile-subscriber.suscription-list', ['user' => $user])
                    </div>
                </div>
            </div>

            {{-- ------------------------ --}}


        </div>
    </div>


@endsection
