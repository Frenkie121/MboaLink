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
        <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="@lang('Phone Number') (WhatsApp)" wire:model.defer="phone_number">
        <label for="phone_number">@lang('Phone Number') (WhatsApp) <small><b class="text-danger">*</b></small></label>
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
        <option hidden>@lang('Select your activity field')<b class="text-danger">*</b></option>
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
        <label for="description">@lang('Short Description') <small>(@lang('Describe your activity in a few words'))<b class="text-danger">*</b></small></label>
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