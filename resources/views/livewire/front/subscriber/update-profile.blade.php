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
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="phone_number" wire:model.defer="phone_number" placeholder="@lang('Phone Number')">
                <label for="phone_number">@lang('Phone Number')</label>
                @error('phone_number')
                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                @enderror
            </div>
        </div>
        @if (auth()->user()->role_id !== 2)
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="date" class="form-control" id="birth_date" wire:model.defer="birth_date" placeholder="@lang('Birth Date')">
                    <label for="birth_date">@lang('Birth Date')</label>
                    @error('birth_date')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
        @else
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="@lang('Website')" wire:model.defer="website">
                    <label for="website">@lang('Website')</label>
                    @error('website')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="location" wire:model.defer="location" placeholder="@lang('Location')">
                <label for="location">@lang('Location')</label>
                @error('location')
                    <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                @enderror
            </div>
        </div>
        @if (auth()->user()->role_id !== 2)
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="file" class="form-control @error('cv') is-invalid @enderror" id="cv" wire:model="cv" placeholder="@lang('Add a CV')" accept=".pdf,.doc,.docx">
                    <label for="cv">@lang('Add a CV')</label>
                    @error('cv')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
        @else
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" placeholder="@lang('Add a logo')" wire:model.defer="logo" accept=".png,.jpeg,.jpg">
                    <label for="logo">@lang('Add a logo')</label>
                    @error('logo')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
        @endif
        @if (auth()->user()->role_id === 2)
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" wire:model.defer="description" id="description" style="height: 150px"></textarea>
                    <label for="description">Description</label>
                    @error('description')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
        @else
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" wire:model.defer="aspiration" id="aspiration" style="height: 150px"></textarea>
                    <label for="aspiration">Aspiration</label>
                    @error('aspiration')
                        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                    @enderror
                </div>
            </div>
        @endif
        <div class="col-12">
            <button wire:click.prevent="save" wire:loading.remove class="btn btn-primary w-100 py-3" type="submit">@lang('Save')</button>
            <button wire:loading class="btn btn-primary w-100 py-3" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                @lang('Loading')...
            </button>
        </div>
    </div>
</form>