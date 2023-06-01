@php
    $active = $user->is_active;
@endphp

<div class="text-center">
    <h3 class="fw-bolder mb-4">@lang('Account Status')</h3>
    <div class="mt-4 fw-bold">
        @lang('Your account is') <span class="text-{{ $active ? 'primary' : 'danger' }} h5">{{ $active ? __('active') : __('disabled') }}</span>.
    </div>
    <div class="h6 mt-3">
        @if ($active)
            @lang('You can continue to browse the website and enjoy the privileges of your subscription.')
        @else
            @lang('Your account has been disabled on') <span class="text-danger">{{ $disabled_at }}</span> @lang('by') <span class="text-danger">{{ $user->disabled_by === $user->id ? __('you') : __('administrator') }}.</span>
        @endif
    </div>
    <div class="mt-3 fw-bold">
        @if (! $active)
            @if ($user->disabled_by !== $user->id)
                @lang('You can contact the administrator to find out more:') <a class="text-secondary" href="tel:+237{{ $admin->phone_number }}">{{ $admin->phone_number }}</a> @lang('or') <a class="text-secondary" href="mailto:{{ $admin->email }}">{{ $admin->email }}</a>.
            @else
                @if (! $changeStatus)
                    @lang('You can click on the button below to activate you account.')
                    <div class="mt-3">
                        <button wire:click="changeStatus" class="btn btn-secondary">@lang('Activate my account')</button>
                    </div>
                @endif
            @endif
        @else
            @if (! $changeStatus)
                @lang('You can click on the button below to disable you account.')
                <div class="mt-3">
                    <button wire:click="changeStatus" class="btn btn-danger mt-2">@lang('Disable my account')</button>
                </div>
            @endif
        @endif
        @if ($changeStatus)
            <div class="row">
                <div class="col-md-6">
                    <button wire:click="cancel" class="btn btn-light w-50">@lang('Cancel')</button>
                </div>
                <div class="col-md-6">
                    <button wire:click="confirm" wire:loading.remove class="btn btn-{{ $active ? 'danger' : 'secondary' }} w-50">@lang('Confirm')</button>
                    <button wire:loading wire:target="confirm" class="btn btn-{{ $active ? 'danger' : 'secondary' }} w-50" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        @lang('Loading')...
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>