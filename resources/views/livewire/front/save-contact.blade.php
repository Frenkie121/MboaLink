<div class="col-md-6">
    <div class="wow fadeInUp" data-wow-delay="0.5s">
        <p class="mb-4 text-center fw-bold">@lang('Fill the form below to send us a message')</p>
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
                    <button wire:click.prevent="save" wire:loading.remove class="btn btn-primary w-100 py-3" type="submit">@lang('Send Message')</button>
                    <button wire:loading class="btn btn-primary w-100 py-3" type="button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        @lang('Loading')...
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>