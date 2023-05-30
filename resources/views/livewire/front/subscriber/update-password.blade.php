<div>
    <h3 class="text-center fw-bolder">@lang('Update Password')</h3>
    <p class="mb-4 text-center fw-bold">@lang('Update your password using the form below')</p>
    <form>
        <div class="row g-3 d-flex justify-content-center">
            <div class="col-md-10">
                <div class="form-floating">
                    <input type="password" class="form-control" id="current_password" wire:model.defer="current_password" placeholder="@lang('Current password')">
                    <label for="current_password">@lang('Current password')</label>
                    @error('current_password')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" wire:model.defer="password" placeholder="@lang('New password')">
                    <label for="password">@lang('New password')</label>
                    @error('password')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="col-md-10">
                <div class="form-floating">
                    <input type="password" class="form-control" id="password_confirmation" wire:model.defer="password_confirmation" placeholder="@lang('Confirm new password')">
                    <label for="password_confirmation">@lang('Confirm new password')</label>
                    @error('password_confirmation')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
            <div class="col-10 d-flex justify-content-end">
                <button wire:click.prevent="update" wire:loading.remove class="btn btn-primary py-3" type="submit">@lang('Update')</button>
                <button wire:loading wire:target="update" class="btn btn-primary py-3" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    @lang('Loading')...
                </button>
            </div>
        </div>
    </form>
</div>