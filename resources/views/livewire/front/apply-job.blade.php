<div>
    <button wire:click.prevent="apply" wire:loading.remove class="btn btn-primary w-100 mb-2" type="submit">@lang('Apply Now')</button>
    <button wire:loading class="btn btn-primary w-100 mb-2" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        @lang('Loading')...
    </button>
</div>