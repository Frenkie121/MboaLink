<div class=" wow fadeInUp mt-5" data-wow-delay="0.3s">
    <ul class="nav nav-pills d-inline-flex justify-content-left border-bottom mb-5">
        <li class="nav-item col-12 col-md-3 mb-2 md-md-0">
            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 @if ($currentStep === 1) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('General Informations')</h6>
            </a>
        </li>
        <li class="nav-item col-12 col-md-3 mb-2 md-md-0">
            <a class="d-flex align-items-center text-start mx-3 pb-3 @if ($currentStep === 2) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Requirements')</h6>
            </a>
        </li>
        <li class="nav-item col-12 col-md-3 mb-2 md-md-0">
            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 @if ($currentStep === 3) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Qualifications')</h6>
            </a>
        </li>
        <li class="nav-item col-12 col-md-3 mb-2 md-md-0">
            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3 @if ($currentStep === 4) active @endif" data-bs-toggle="pill" href="#">
                <h6 class="mt-n1 mb-0">@lang('Confirmation')</h6>
            </a>
        </li>
    </ul>
    <div class="tab-content mb-4">
        <div class="tab-pane fade show p-0 @if ($currentStep === 1) active @endif">
            <form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="@lang('Title')" wire:model.defer="title">
                            <label for="title">@lang('Title')<b class="text-danger">*</b></label>
                        </div>
                        @error('title')
                            <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control @error('dateline') is-invalid @enderror" id="dateline" wire:model.defer="dateline" placeholder="@lang('Deadline for applications')">
                            <label for="dateline">@lang('Deadline for applications')<b class="text-danger">*</b></label>
                            @error('dateline')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('min_salary') is-invalid @enderror" id="min_salary" placeholder="@lang('Min. salary')" wire:model.defer="min_salary">
                            <label for="minimal_salary">@lang('Min. salary')<b class="text-danger">*</b></label>
                            @error('min_salary')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('max_salary') is-invalid @enderror" id="max_salary" placeholder="@lang('Max. salary')" wire:model.defer="max_salary">
                            <label for="max_salary">@lang('Max. salary')</label>
                            @error('max_salary')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <select class="form-select mb-3 @error('category') is-invalid @enderror" wire:model.lazy="category" id="category">
                            <option hidden>@lang('Select a category')<b class="text-danger">*</b></option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <select class="form-select mb-3 @error('sub_category') is-invalid @enderror" wire:model.defer="sub_category" id="sub-category">
                            <option hidden>@lang('Select a sub-category')<b class="text-danger">*</b></option>
                            @if (! is_null($category))
                                @foreach ($sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('sub_category')
                            <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <select class="form-select mb-3 @error('type') is-invalid @enderror" wire:model.defer="type" id="type">
                            <option hidden>@lang('Select the job type')<b class="text-danger">*</b></option>
                            @foreach ($types as $key => $type)
                                <option value="{{ $key }}">{{ __($type) }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <textarea class="form-control @error('description') is-invalid @enderror" placeholder="@lang('Add a description')" id="description" style="height: 150px" wire:model.defer="description"></textarea>
                            <label for="description">@lang('Short Description')<b class="text-danger">*</b></label>
                            @error('description')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" wire:model.defer="file" placeholder="@lang('Add job specifications file')" accept=".pdf,.doc,.docx,.ppt,.xlsx">
                            <label for="file">@lang('Add job specifications file')</label>
                            @error('file')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-md-12" wire:ignore>
                        <select class="form-select select2-multiple @error('tags') is-invalid @enderror" wire:model.defer="tags" id="tags" data-placeholder="@lang('Select Tags')" multiple>
                            @foreach ($all_tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                            <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                        @enderror
                    </div> --}}
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 2) active @endif">
            <form>
                <div class="row gy-2 gx-0 gx-sm-0">
                    <div class="col-md-10 col-sm-9 col-8">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('requirement.1') is-invalid @enderror" id="content" placeholder="@lang('Requirement') 1" wire:model.defer="requirements.1">
                            <label for="content">@lang('Requirement') 1<b class="text-danger">*</b></label>
                            @error('requirements.1')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-4">
                        <a class="btn btn-secondary w-50 py-3" wire:click.prevent="add({{ $i }})">+</a>
                    </div>
                    @foreach ($requirementsInputs as $key => $input)
                        <div class="col-md-10 col-sm-9 col-8" wire:key="{{ $input }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('requirements.' . $loop->iteration + 1) is-invalid @enderror" id="content" placeholder="@lang('Requirement') {{ $loop->iteration + 1 }}" wire:model.defer="requirements.{{ $loop->iteration + 1 }}">
                                <label for="content">@lang('Requirement') {{ $loop->iteration + 1 }}</label>
                                @error('requirements.' . $loop->iteration + 1)
                                    <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-4">
                            <a class="btn btn-danger w-50 py-3" wire:click.prevent="remove({{ $key }})">-</a>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 3) active @endif">
            <form>
                <div class="row g-3 gx-sm-0">
                    <div class="col-md-10 col-sm-9 col-8" wire:key="{{ uniqid() }}">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('qualifications.1') is-invalid @enderror" id="content" placeholder="@lang('Qualification') 1" wire:model.defer="qualifications.1">
                            <label for="content">@lang('Qualification') 1<b class="text-danger">*</b></label>
                            @error('qualifications.1')
                                <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3 col-4">
                        <a class="btn btn-secondary w-50 py-3" wire:click.prevent="add({{ $i }})">+</a>
                    </div>
                    @foreach ($qualificationsInputs as $key => $input)
                        <div class="col-md-10 col-sm-9 col-8" wire:key="{{ uniqid() }}">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('qualifications.' . $loop->iteration + 1) is-invalid @enderror" id="content" placeholder="@lang('Qualification') {{ $loop->iteration + 1 }}" wire:model.defer="qualifications.{{ $loop->iteration + 1 }}">
                                <label for="content">@lang('Qualification') {{ $loop->iteration + 1 }}</label>
                                @error('qualifications.' . $loop->iteration + 1)
                                    <span class="text-danger d-flex justify-content-start"><small>{{ $message }}</small></span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-3 col-4">
                            <a class="btn btn-danger w-50 py-3" wire:click.prevent="remove({{ $key }})">-</a>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="tab-pane fade show p-0 @if ($currentStep === 4) active @endif">
            @if ($currentStep === 4)
                <div class="row g-3">
                    <h5>@lang('General Informations')</h5>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="title" placeholder="@lang('Title')" value="{{ $title }}" readonly>
                            <label for="title">@lang('Title')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="dateline" value="{{ $dateline }}" placeholder="@lang('Deadline for applications')" readonly>
                            <label for="dateline">@lang('Deadline for applications')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="min_salary" placeholder="@lang('Min. salary')" value="{{ $min_salary }}" readonly>
                            <label for="min_salary">@lang('Min. salary')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="max_salary" placeholder="@lang('Max. salary')" value="{{ $max_salary }}" readonly>
                            <label for="max_salary">@lang('Max. salary')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="type" placeholder="@lang('Type')" value="{{ $type }}" readonly>
                            <label for="type">@lang('Type')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="category" placeholder="@lang('Category')" value="{{ $category->name }}" readonly>
                            <label for="category">@lang('Category')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="sub_category" placeholder="@lang('Sub-category')" value="{{ $sub_category->name }}" readonly>
                            <label for="sub_category">@lang('Sub-category')</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="file" class="form-control" id="file" wire:model.defer="file" placeholder="@lang('File')" accept=".pdf,.doc,.docx,.ppt,.xlsx" disabled>
                            <label for="file">@lang('File')</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="description" readonly>{{ $description }}</textarea>
                            <label for="description">@lang('Description')</label>
                        </div>
                    </div>
                    
                    @if ($tags)
                        <div class="col-md-6">
                            <div class="form-floating">
                                <textarea class="form-control" id="tags" readonly>
                                    @foreach ($tags as $tag)
                                        @dump(App\Models\Tag::find($tag))
                                        {{ App\Models\Tag::find($tag)->name }}@if(!$loop->last), @else. @endif 
                                    @endforeach
                                </textarea>
                                <label for="tags">@lang('Tags')</label>
                            </div>
                        </div>
                    @endif

                    <hr>
                    <h5>@lang('Requirements')</h5>
                    @foreach ($requirements as $requirement)
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="requirement-{{ $loop->iteration }}" placeholder="@lang('Requirement') {{ $loop->iteration }}" value="{{ $requirement }}" readonly>
                                <label for="requirement-{{ $loop->iteration }}">@lang('Requirement') {{ $loop->iteration }}</label>
                            </div>
                        </div>
                        <br>
                    @endforeach

                    <hr>
                    <h5>@lang('Qualifications')</h5>
                    @foreach ($qualifications as $qualification)
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="qualification-{{ $loop->iteration }}" placeholder="@lang('Qualification') {{ $loop->iteration }}" value="{{ $qualification }}" readonly>
                                <label for="qualification-{{ $loop->iteration }}">@lang('Qualification') {{ $loop->iteration }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="col-{{ $currentStep === 2 || $currentStep === 3 ? '11' : '12' }} d-flex justify-content-between mt-2">
        <a @if($currentStep === 4) href="#tabs" @endif wire:target="confirm" wire:loading.class="isDisabled" class="btn btn-dark w-40 py-3 {{ $currentStep === 1 ? 'isDisabled' : '' }}" wire:click="previous({{ $currentStep }})"><i class="fa fa-caret-left"></i>  <span class="d-none d-md-inline d-sm-inline">@lang('Previous')</span></a>

        <div class="d-flex justify-content-end">
            @if ($currentStep === 4)
                <a wire:target="confirm" wire:loading.class="isDisabled" class="btn btn-danger w-40 py-3" wire:click="cancel()"><i class="fa fa-trash-alt"></i>  <span class="d-none d-md-inline d-sm-inline">@lang('Cancel')</span></a>
            @endif

            <div class="mx-1">
                <a @if($currentStep !== 4)href="#tabs"@endif wire:loading.class="isDisabled"
                    class="btn btn-{{ $currentStep === 4 ? 'secondary' : 'primary' }} w-40 py-3"
                    wire:click="@if($currentStep === 1)validateGeneralInformations()@elseif($currentStep === 2)validateRequirements()@elseif($currentStep === 3)validateQualifications()@else confirm()@endif">
                    <span class="d-none d-md-inline d-sm-inline">
                        @if ($currentStep === 4)
                            @lang('Confirm')
                        @else
                            @lang('Next')
                        @endif
                    </span>
                    <i class="fa fa-caret-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
