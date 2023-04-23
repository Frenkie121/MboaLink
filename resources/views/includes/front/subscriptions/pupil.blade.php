<div class="col-md-6">
    <div class="form-floating">
        <input type="text" class="form-control @error('Name') is-invalid @enderror" id="name" placeholder="@lang('Name')" wire:model.defer="name">
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
<div class="col-md-6">
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
        <input type="text" class="form-control @error('school') is-invalid @enderror" id="school" placeholder="@lang('School attended')" wire:model.defer="school">
        <label for="school">@lang('School attended') <small> <b class="text-danger">*</b></small></label>
    </div>
    @error('school')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('section') is-invalid @enderror" wire:model.change="section" id="section">
        <option hidden>@lang('Select your section') <b class="text-danger">*</b></option>
        @foreach ($sections as $key => $section)
            <option value="{{ $key }}">{{ __($section) }}</option>
        @endforeach
    </select>
    @error('section')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('education_type') is-invalid @enderror" wire:model.change="education_type" id="education_type">
        <option hidden>@lang('Select your education type') <b class="text-danger">*</b></option>
        @foreach ($educations as $key => $education)
            <option value="{{ $key }}">{{ __($education) }}</option>
        @endforeach
    </select>
    @error('education_type')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('cycle') is-invalid @enderror" wire:model.lazy="cycle" id="cycle">
        <option hidden>@lang('Select your cycle') <b class="text-danger">*</b></option>
        @foreach ($cycles as $key => $cycle)
            <option value="{{ $key }}">{{ __($cycle) }}</option>
        @endforeach
    </select>
    @error('cycle')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('serie') is-invalid @enderror" wire:model.lazy="serie" id="serie">
        <option hidden>@lang('Select your series') <b class="text-danger">*</b></option>
        @if(! is_null($section))
            @foreach ($series as $serie)
                <option value="{{ $serie }}">{{ __($serie) }}</option>
            @endforeach
        @endif
    </select>
    @error('serie')
        <span class="text-danger fw-light"><small>{{ $message }}</small></span>
    @enderror
</div>
<div class="col-md-6">
    <select class="form-select @error('current_class') is-invalid @enderror" wire:model.lazy="current_class" id="current_class">
        <option hidden>@lang('Select your current class') <b class="text-danger">*</b></option>
        @foreach ($classes as $classe)
            <option value="{{ $classe }}">{{ $classe }}</option>
        @endforeach
    </select>
    @error('current_class')
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
<div class="col-md-12">
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
<div class="col-12">
    <div class="form-floating">
        <textarea class="form-control @error('description') is-invalid @enderror" placeholder="@lang('Add a description')" id="description" style="height: 150px" wire:model.defer="description"></textarea>
        <label for="description">@lang('Describe your aspirations in a few words') <small><b class="text-danger">*</b></small></label>
        @error('description')
            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
        @enderror
    </div>
</div>