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
            @include('includes.front.subscriptions.free')
        @else
            @lang('Coming soon ...')
        @endif
    </div>
    <div class="d-flex justify-content-end mt-2">
        <button wire:loading.remove class="btn btn-primary">
            <span class="d-md-inline d-sm-inline">@lang('Confirm')</span>
        </button>
        <button wire:loading="save()" class="btn btn-primary" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only">@lang('Loading...')</span>@lang('Loading...')
        </button>
    </div>
</form>
