<div class="container-fluid bg-secondary mb-3 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
    <div class="container">
        <form action="{{ route('front.jobs.search') }}" method="post">
            @csrf
            <div class="row g-2">
                <div class="col-md-9">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <input type="search" class="form-control border-0" name="search" placeholder="@lang('Eg.: Web Developper, Marketing, ...')" value="{{ request()->search ?? '' }}" />
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0" name="sub_category">
                                <option disabled selected>@lang('Select a category')</option>
                                @foreach ($subCategories as $subCategory)
                                    <option @selected(request()->sub_category === $subCategory->name) value="{{ $subCategory->name }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select border-0" name="type">
                                <option disabled selected>@lang('Job Type')</option>
                                @foreach ($types as $type)
                                    <option @selected(request()->type === $type) value="{{ $type }}">{{ __($type) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex d-inline">
                    <button type="submit" class="btn btn-primary border-0 w-100">@lang('Search')</button>
                    @if (! request()->has('search'))
                        <button type="reset" class="btn btn-dark border-0 w-100">@lang('Clear')</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>