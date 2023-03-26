@extends('layouts.front')

@section('subtitle', __('Pricing') . ' | ' . __($subscription->name))

@push('css')
    @livewireStyles
    <style>
        .btn-danger {
            background-color: #f9460c;
            border-color: #f9460c;
        }
        .btn-danger:hover {
            background-color: #f9460c;
            border-color: #f9460c;
        }
        .isDisabled {
            color: #fff;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
            pointer-events: none;
        }
    </style>
@endpush

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Subscription') . ' ' . __($subscription->name)"
        :middleLink="true"
        :middleTitle="__('Pricing')"
        :middleRouteName="route('front.subscriptions.index')"
    />
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container" id="tabs">
            <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">@lang('Subscribe to a new subscription')</h1>
            <h6 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                @if ($subscription->id === 1)
                    @lang('Fill the form below to save your subscription')
                @else
                    @lang('Follow the steps below save your subscription') 
                @endif
            </h6>
            <div class="d-flex justify-content-center">
                <div class="col-md-8">
                    @if ($subscription->id === 1)
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" wire:model.defer="name" placeholder="@lang('Name')">
                                            <label for="name">@lang('Name')</label>
                                            @error('name')
                                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" wire:model.defer="email" placeholder="Email">
                                            <label for="email">Email</label>
                                            @error('email')
                                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" wire:model.defer="subject" placeholder="@lang('Subject')">
                                            <label for="subject">@lang('Subject')</label>
                                            @error('subject')
                                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" wire:model.defer="message" id="message" style="height: 150px"></textarea>
                                            <label for="message">Message</label>
                                            @error('message')
                                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button wire:click.prevent="save" wire:loading.remove class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                        <button wire:loading class="btn btn-primary w-100 py-3" type="button" disabled>
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            @lang('Loading')...
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        @livewire('front.subscription.paid-subscription')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    @livewireScripts
@endpush