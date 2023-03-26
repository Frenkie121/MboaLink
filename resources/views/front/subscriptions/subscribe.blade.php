@extends('layouts.front')

@section('subtitle', __('Pricing') . ' | ' . __($subscription->name))

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
                @if ($subscription->id === 1)
                    <div class="col-md-8">
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
                    </div>
                @else
                    <div class="tab-class text-center wow fadeInUp mt-2" data-wow-delay="0.3s">
                        <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                            <li class="nav-item">
                                <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3" data-bs-toggle="pill" href="#1">
                                    <h6 class="mt-n1 mb-0">@lang('General Informations')</h6>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#2">
                                    <h6 class="mt-n1 mb-0">@lang('Requirements')</h6>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mb-4">
                            <div class="tab-pane fade show p-0" id="1">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="@lang('Title')" wire:model.defer="title">
                                                <label for="title">@lang('Title')<b class="text-danger">*</b></label>
                                            </div>
                                            @error('title')
                                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="@lang('Location')" wire:model.defer="location">
                                                <label for="location">@lang('Location')<b class="text-danger">*</b></label>
                                                @error('location')
                                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control @error('min_salary') is-invalid @enderror" id="min_salary" placeholder="@lang('Min. salary')" wire:model.defer="min_salary">
                                                <label for="minimal_salary">@lang('Min. salary')<b class="text-danger">*</b></label>
                                                @error('min_salary')
                                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="number" class="form-control @error('max_salary') is-invalid @enderror" id="max_salary" placeholder="@lang('Max. salary')" wire:model.defer="max_salary">
                                                <label for="max_salary">@lang('Max. salary')</label>
                                                @error('max_salary')
                                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="date" class="form-control @error('dateline') is-invalid @enderror" id="dateline" wire:model.defer="dateline" placeholder="@lang('Date Line')">
                                                <label for="dateline">@lang('Date Line')<b class="text-danger">*</b></label>
                                                @error('dateline')
                                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control @error('description') is-invalid @enderror" placeholder="@lang('Add a description')" id="description" style="height: 150px" wire:model.defer="description"></textarea>
                                                <label for="description">@lang('Short Description')<b class="text-danger">*</b></label>
                                                @error('description')
                                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating">
                                                <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" wire:model.defer="file" placeholder="@lang('Add job specifications file')" accept=".pdf,.doc,.docx,.ppt,.xlsx">
                                                <label for="file">@lang('Add job specifications file')</label>
                                                @error('file')
                                                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade show p-0" id="2">
                                <form>
                                    <div class="row gy-2 gx-0 gx-sm-0">
                                        <div class="col-md-10 col-sm-9 col-8">
                                            <div class="form-floating">
                                                <input type="text" class="form-control @error('requirement.0') is-invalid @enderror" id="content" placeholder="@lang('Requirement') 1" wire:model.defer="requirements.0">
                                                <label for="content">@lang('Requirement') 1<b class="text-danger">*</b></label>
                                                @error('requirements.0')
                                                    <span class="text-danger"><small>{{ $message }}</small></span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="col d-flex justify-content-between mt-2">
                            <a href="#tabs" class="btn btn-dark w-40 py-3"><i class="fa fa-caret-left"></i>  <span class="d-none d-md-inline d-sm-inline">@lang('Previous')</span></a>
                    
                            <div class="d-flex justify-content-end">
                                {{-- @if ($currentStep === 5) --}}
                                    <a wire:target="confirm" wire:loading.class="isDisabled" class="btn btn-danger w-40 py-3" wire:click="cancel()"><i class="fa fa-trash-alt"></i>  <span class="d-none d-md-inline d-sm-inline">@lang('Cancel')</span></a>
                                {{-- @endif --}}
                    
                                <div class="mx-1">
                                    <a href="#tabs" wire:loading.class="isDisabled"
                                        class="btn btn-primary }} w-40 py-3">
                                        <span class="d-none d-md-inline d-sm-inline">
                                                @lang('Next')
                                        </span>
                                        <i class="fa fa-caret-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection