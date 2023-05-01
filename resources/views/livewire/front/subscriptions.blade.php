@php
    $free = $subscription_id === 1;
    $company = $subscription_id === 2;
    $student = $subscription_id === 3;
    $pupil = $subscription_id === 4;
    $unemployed = $subscription_id === 5;
@endphp
<form wire:submit.prevent="save()">
    <div class="row g-3">
        @if ($company)
            @include('includes.front.subscriptions.company')
        @elseif ($student)
            @include('includes.front.subscriptions.student')
        @elseif ($pupil)
            @include('includes.front.subscriptions.pupil')
        @elseif ($unemployed)
            @include('includes.front.subscriptions.unemployed')
        @elseif ($free)
            <div class="col-md-12">
                <select class="form-select @error('type') is-invalid @enderror" wire:model.lazy="type" id="type">
                    <option hidden>@lang('Select the desired subscription type') <b class="text-danger">*</b></option>
                    @foreach ($subscription_types as $subscription)
                        <option value="{{ $subscription->id }}">{{ __($subscription->name) }}</option>
                    @endforeach
                </select>
                @error('type')
                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                @enderror
            </div>
            
            @if (!is_null($type))
                @if ($type == 2)
                    @include('includes.front.subscriptions.company')
                @elseif ($type == 3)
                    @include('includes.front.subscriptions.student')
                @elseif ($type == 4)
                    @include('includes.front.subscriptions.pupil')
                @elseif ($type == 5)
                    @include('includes.front.subscriptions.unemployed')
                @else
                    <p class="text-center alert alert-info">@lang('Coming soon ...')</p>
                @endif
            @endif
        @else
            <p class="text-center alert alert-info">@lang('Coming soon ...')</p>
        @endif
    </div>
    @if ($free && $type || !in_array($subscription_id, [1, 2, 3, 4, 5]))
        <div class="d-flex justify-content-end mt-2">
            <button wire:loading.remove class="btn btn-primary">
                <span class="d-md-inline d-sm-inline">@lang('Confirm')</span>
            </button>
            <button wire:loading="save()" class="btn btn-primary" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="sr-only">@lang('Loading...')</span>@lang('Loading...')
            </button>
        </div>
    @endif
</form>
