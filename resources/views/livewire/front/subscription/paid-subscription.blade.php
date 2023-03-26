@php
    $company = $subscription_id === 2;
@endphp

<div class="tab-class text-center wow fadeInUp mt-2" data-wow-delay="0.3s">
    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 @if ($currentStep === 1) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">
                    @if ($company)
                        @lang('Company Informations')
                    @else
                        @lang('Personal Informations')
                    @endif
                </h6>
            </a>
        </li>
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 pb-3 @if ($currentStep === 2) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Payment')</h6>
            </a>
        </li>
    </ul>
    <div class="tab-content mb-4">
        <div class="tab-pane fade show p-0 @if ($currentStep === 1) active @endif">
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('Name') is-invalid @enderror" id="name" placeholder="@lang('Name')" wire:model.defer="name">
                            <label for="name">@lang('Name')<b class="text-danger">*</b></label>
                        </div>
                        @error('name')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('Email')" wire:model.defer="email">
                            <label for="email">@lang('Email')<b class="text-danger">*</b></label>
                            @error('email')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="@lang('Phone Number')" wire:model.defer="phone_number">
                            <label for="phone_number">@lang('Phone Number')<b class="text-danger">*</b></label>
                        </div>
                        @error('phone_number')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="@lang('Location')" wire:model.defer="location">
                            <label for="location">@lang('Location') <small><b class="text-danger">*</b></small></label>
                        </div>
                        @error('location')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <select class="form-select @error('category') is-invalid @enderror" wire:model.lazy="category" id="category">
                            <option hidden>
                                @if ($company)
                                    @lang('Select your activity field')
                                @else
                                    @lang('Select the field you are looking for')
                                @endif
                                <b class="text-danger">*</b>
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
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
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="@lang('Website')" wire:model.defer="website">
                            <label for="website">@lang('Website')</label>
                            @error('website')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" placeholder="@lang('Add a logo')" wire:model.defer="logo" accept=".png,.jpeg,.jpg">
                            <label for="logo">@lang('Add a logo')</label>
                            @error('logo')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 2) active @endif">
            <form>
                <div class="row gy-2 gx-0 gx-sm-0">
                    <div class="col-md-10 col-sm-9 col-8">
                        {{-- <div class="form-floating">
                            <input type="text" class="form-control @error('requirement.0') is-invalid @enderror" id="content" placeholder="@lang('Requirement') 1" wire:model.defer="requirements.0">
                            <label for="content">@lang('Requirement') 1<b class="text-danger">*</b></label>
                            @error('requirements.0')
                                <span class="text-danger"><small>{{ $message }}</small></span>
                            @enderror
                        </div> --}}
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="col d-flex justify-content-between mt-2">
        <a href="#tabs" class="btn btn-dark w-40 py-3  {{ $currentStep === 1 ? 'isDisabled' : '' }}" wire:click="previous(1)"><i class="fa fa-caret-left"></i>  <span class="d-none d-md-inline d-sm-inline">@lang('Previous')</span></a>

        <div class="d-flex justify-content-end">
            @if ($currentStep === 2)
                <a wire:target="confirm" wire:loading.class="isDisabled" class="btn btn-danger w-40 py-3" wire:click="cancel()"><i class="fa fa-trash-alt"></i>  <span class="d-none d-md-inline d-sm-inline">@lang('Cancel')</span></a>
            @endif

            <div class="mx-1">
                <a href="#tabs" wire:loading.class="isDisabled"
                    class="btn btn-{{ $currentStep === 2 ? 'secondary' : 'primary' }} w-40 py-3"
                    wire:click="@if($currentStep === 1)validateInformations()@else confirm()@endif">
                    <span class="d-none d-md-inline d-sm-inline">
                        @if ($currentStep === 2)
                            @lang('Confirm')
                        @else
                            @lang('Next')
                        @endif
                    </span>
                    <i class="fa fa-caret-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>