<div class="tab-class text-center wow fadeInUp mt-5" data-wow-delay="0.3s">
    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 @if ($currentStep === 1) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('General Informations')</h6>
            </a>
        </li>
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 pb-3 @if ($currentStep === 2) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Requirements')</h6>
            </a>
        </li>
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 @if ($currentStep === 3) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Qualifications')</h6>
            </a>
        </li>
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 @if ($currentStep === 4) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Company Details')</h6>
            </a>
        </li>
        <li class="nav-item">
            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 @if ($currentStep === 5) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Confirmation')</h6>
            </a>
        </li>
    </ul>
    <div class="tab-content mb-4">
        <div class="tab-pane fade show p-0 @if ($currentStep === 1) active @endif">
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="@lang('Title')" wire:model.defer="title">
                            <label for="title">@lang('Title')<b class="text-danger">*</b></label>
                        </div>
                        @error('title')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="@lang('Location')" wire:model.defer="location">
                            <label for="location">@lang('Location')<b class="text-danger">*</b></label>
                            @error('location')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('min_salary') is-invalid @enderror" id="min_salary" placeholder="@lang('Min. salary')" wire:model.defer="min_salary">
                            <label for="minimal_salary">@lang('Min. salary')<b class="text-danger">*</b></label>
                            @error('min_salary')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control @error('max_salary') is-invalid @enderror" id="max_salary" placeholder="@lang('Max. salary')" wire:model.defer="max_salary">
                            <label for="max_salary">@lang('Max. salary')</label>
                            @error('max_salary')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select @error('category') is-invalid @enderror" wire:model.lazy="category" id="category">
                            <option>@lang('Select a category')<b class="text-danger">*</b></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <select class="form-select @error('sub_category') is-invalid @enderror" wire:model.defer="sub_category" id="sub-category">
                            <option>@lang('Select a sub-category')<b class="text-danger">*</b></option>
                            @if (! is_null($category))
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('sub_category')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <select class="form-select @error('type') is-invalid @enderror" wire:model.defer="type" id="type">
                            <option>@lang('Select the job type')<b class="text-danger">*</b></option>
                            @foreach ($types as $key => $type)
                                <option value="{{ $key }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('dateline') is-invalid @enderror" id="dateline" wire:model.defer="dateline" placeholder="@lang('Date Line')">
                            <label for="dateline">@lang('Date Line')<b class="text-danger">*</b></label>
                            @error('dateline')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="@lang('Add a description')" id="description" style="height: 150px" wire:model.defer="description"></textarea>
                            <label for="description">@lang('Short Description')<b class="text-danger">*</b></label>
                            @error('description')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" wire:model.defer="file" placeholder="@lang('Add job specifications file')">
                            <label for="file">@lang('Add job specifications file')</label>
                            @error('file')
                                <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12" wire:ignore>
                        <select class="form-select select2-multiple @error('tags') is-invalid @enderror" wire:model.defer="tags" id="tags" data-placeholder="@lang('Select Tags')" multiple>
                            @foreach ($all_tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                            <span class="text-danger fw-light"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 2) active @endif">
            <form>
                <div class="row g-3">
                    <div class="col-md-10">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('') is-invalid @enderror" id="content" placeholder="@lang('Requirement') 1" required>
                            <label for="content">@lang('Requirement') 1<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-secondary w-50 py-3 mr-1">+</button>
                    </div>
                    <div class="col-md-10">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('') is-invalid @enderror" id="content" placeholder="@lang('Requirement') 2">
                            <label for="content">@lang('Requirement') 2<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-danger w-50 py-3 mr-1">-</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 3) active @endif">
            <form>
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('') is-invalid @enderror" id="content" placeholder="@lang('Content') 1" required>
                            <label for="content">@lang('Content') 1<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 4) active @endif">
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('') is-invalid @enderror" id="name" placeholder="@lang('Name')" required>
                            <label for="name">@lang('Name')<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="email" class="form-control @error('') is-invalid @enderror" id="email" placeholder="@lang('Email')" required>
                            <label for="email">@lang('Email')<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('') is-invalid @enderror" id="location" placeholder="@lang('Location')" required>
                            <label for="location">@lang('Location')<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="url" class="form-control @error('') is-invalid @enderror" id="url" placeholder="@lang('Website')">
                            <label for="url">@lang('Website')</label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control @error('') is-invalid @enderror" placeholder="@lang('Add a description')" id="description" style="height: 150px"></textarea>
                            <label for="description">@lang('Description')<b class="text-danger">*</b></label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="file" class="form-control @error('') is-invalid @enderror" id="logo" placeholder="@lang('Add a logo')">
                            <label for="logo">@lang('Add a logo')</label>
                            @error('')
                                <span class="text-danger"></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 5) active @endif">
            Coming soon ...
        </div>
    </div>
    
    <div class="col-12 d-flex justify-content-between mt-2">
        <button class="btn btn-dark w-40 py-3" @disabled($currentStep === 1) wire:click="back(@if($currentStep === 2)1 @elseif($currentStep === 3)2 @elseif($currentStep === 4)3 @elseif($currentStep === 5)4 @endif)"><i class="fa fa-caret-left"></i>  @lang('Previous')</button>
        <button 
            class="btn btn-primary w-40 py-3"
            wire:click="@if($currentStep === 1)validateGeneralInformations()@elseif($currentStep === 2)validateRequirements()@elseif($currentStep === 3)validateQualifications()@elseif($currentStep === 4)validateCompanyDetails()@else confirm()@endif"
        >@lang('Next')  <i class="fa fa-caret-right"></i></button>
    </div>
</div>