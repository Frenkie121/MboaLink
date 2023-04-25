<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="@lang('Name')" wire:model.defer="name">
        <label for="name">@lang('Name') <small><b class="text-danger">*</b></small></label>
    </div>
    @error('name')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="@lang('Email')" wire:model.defer="email">
        <label for="email">@lang('Email') <small><b class="text-danger">*</b></small></label>
        @error('email')
            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="@lang('Parent Phone Number') (WhatsApp)" wire:model.defer="phone_number">
        <label for="phone_number">@lang('Parent Phone Number') (WhatsApp) <small><b class="text-danger">*</b></small></label>
    </div>
    @error('phone_number')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" placeholder="@lang('Birth Date')" wire:model.defer="birth_date">
        <label for="birth_date">@lang('Birth Date') <small><b class="text-danger">*</b></small></label>
    </div>
    @error('birth_date')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-12">
    <div class="form-floating">
        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="@lang('Location')" wire:model.defer="location">
        <label for="location">@lang('Location') <small><b class="text-danger">*</b></small></label>
    </div>
    @error('location')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control @error('diploma') is-invalid @enderror" id="diploma" placeholder="@lang('Your last diploma')" wire:model.defer="diploma">
        <label for="diploma">@lang('Your last diploma')</label>
    </div>
    @error('diploma')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control @error('current_job') is-invalid @enderror" id="current_job" placeholder="@lang('Your current job')" wire:model.defer="current_job">
        <label for="current_job">@lang('Your current job')</label>
    </div>
    @error('current_job')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('language') is-invalid @enderror" wire:model.lazy="language" id="language">
        <option hidden>@lang('Select your language of expression') <b class="text-danger">*</b></option>
        @foreach ($languages as $key => $language)
            <option value="{{ $key }}">{{ __($language) }}</option>
        @endforeach
    </select>
    @error('language')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('category') is-invalid @enderror" wire:model.lazy="category" id="category">
        <option hidden>@lang('Select the field you are looking for') <b class="text-danger">*</b></option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <div class="form-floating">
        <textarea class="form-control @error('qualifications') is-invalid @enderror" placeholder="@lang('Describe your qualifications in a few words')" id="qualifications" style="height: 150px" wire:model.defer="qualifications"></textarea>
        <label for="qualifications">@lang('Describe your qualifications in a few words')</label>
        @error('qualifications')
            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-floating">
        <textarea class="form-control @error('aptitudes') is-invalid @enderror" placeholder="@lang('Describe your aptitudes in a few words')" id="aptitudes" style="height: 150px" wire:model.defer="aptitudes"></textarea>
        <label for="aptitudes">@lang('Describe your aptitudes in a few words')</label>
        @error('aptitudes')
            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>
<div class="col-12">
    <div class="form-floating">
        <textarea class="form-control @error('aspiration') is-invalid @enderror" placeholder="@lang('Add a description')" id="aspiration" style="height: 150px" wire:model.defer="aspiration"></textarea>
        <label for="aspiration">@lang('Describe your aspirations in a few words') <small><b class="text-danger">*</b></small></label>
        @error('aspiration')
            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>