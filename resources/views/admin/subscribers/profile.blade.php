@extends('layouts.back')

@section('subtitle', __('Subscriber profile'))

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <x-admin.section-header :title="__('Subscriber profile')" :previousTitle="__('Subscribers List')" :previousRouteName="url()->previous()" />

    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-7">

                <div class="card profile-widget">
                    <div class="d-flex justify-content-end m-2">
                        @if ($user->userable->jobs->isNotEmpty())
                            <a href="{{ route('admin.subscribers.jobs', $user->slug) }}" class="btn btn-primary">
                                @if ($user->role_id === 2)
                                    @lang('See its job offers')
                                @else
                                    @lang('See its applications')
                                @endif
                                ({{ $user->userable->jobs->count() }})
                            </a>
                        @else
                            <button class="btn btn-dark">
                                @if ($user->role_id === 2)
                                    @lang('No job yet')
                                @else
                                    @lang('No application yet')
                                @endif   
                            </button>
                        @endif
                    </div>
                    <div class="profile-widget-header">
                        <img alt="image"
                            src="{{ ($user->role_id === 2 && $user->userable->logo) ? route('company-logo', $user->userable->logo) : asset('assets/back/img/avatar/avatar-2.png') }}"
                            class="rounded-circle profile-widget-picture" width="100px" height="100px"
                        >
                    </div>

                    <div class="profile-widget-description">
                        <div class="profile-widget-name">
                            {{ $user->userable_type !== 'App\Models\Company' ? __('Job seekers') : __('Company') }}
                            <div class="text-muted d-inline font-weight-normal">
                                @if ($user->role_id !== 2)
                                    <div class="slash"></div>
                                    @if ($user->userable->talentable_type === 'App\Models\Student')
                                        @lang('Student')
                                    @elseif ($user->userable->talentable_type === 'App\Models\Unemployed')
                                        @lang('Unemployed')
                                    @elseif ($user->userable->talentable_type === 'App\Models\Pupil')
                                        @lang('Pupil')
                                    @endif
                                @endif
                                <div class="slash"></div><b>{{ $user->name }}</b>
                                {{-- This condition is there just because seeders --}}
                                @if ($user->subscriptions->isNotEmpty())
                                    <div class="badge badge-{{ $user->subscriptions->last()->id === 1 ? 'danger' : 'success' }}">
                                        
                                        @if ($user->subscriptions->last()->id === 1)
                                            @lang('Free')
                                        @else
                                            @lang('Premuim')
                                        @endif
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <hr class="my-0">

                    <div class="profile-widget-description">
                        
                        <h4 class="mb-4">@lang('General Informations')</h4>
                        <p>@lang('Email') : <b>{{ $user->email }}</b></p>
                        <p>@lang('Phone Number') : <b>{{ $user->phone_number }}</b></p>
                        @if ($user->userable_type !== 'App\Models\Company')
                            <p>@lang('Birth Date') : <b>{{ $user->userable->birth_date }}</b></p> 
                        @endif
                    </div>

                    <hr class="my-0">

                    @if ($user->userable_type !== 'App\Models\Company')
                        <div class="profile-widget-description">

                            <h4 class="mb-4">@lang('Personal Informations')</h4>

                            <p> @lang('Research Area') : <b>{{ $user->userable->category->name }}</b></p>
                            <p>@lang('Location') : <b>{{ $user->userable->location }}</b></p>
                            <p>@lang('Language') : <b>{{ $user->userable->language }}</b></p>

                            <p> @lang('CV') :
                                @if ($user->userable->cv)
                                    <a href="{{ route('admin.subscribers.download', $user) }}" class="btn btn-primary" title="@lang('Download')" target="_blank"><i class="fa fa-download"></i></a>
                                @else
                                    <span class="text-danger"> @lang('No CV')</span>
                                @endif
                            </p>
                            <p> @lang('Aspirations') :  <b>{{ $user->userable->aspiration }}</b></p>

                            <hr class="my-0">

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
