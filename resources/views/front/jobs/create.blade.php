@extends('layouts.front')

@section('subtitle', __('Jobs') . ' | ' . __('Post A Job'))

@push('css')
    <link href="{{ asset('assets/front/select2/select2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')

    <!-- Header End -->
    <x-front.header
        :title="__('Post A Job')"
        :middleLink="true"
        :middleTitle="__('Jobs')"
        :middleRouteName="route('front.jobs.index')"
    />
    <!-- Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">@lang('Post A Job')</h1>
        <h6 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">@lang('Follow the steps below to post a job') 
            <div class="tab-class text-center wow fadeInUp mt-5" data-wow-delay="0.3s">
                <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                            <h6 class="mt-n1 mb-0">@lang('General Informations')</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                            <h6 class="mt-n1 mb-0">@lang('Requirements')</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                            <h6 class="mt-n1 mb-0">@lang('Qualifications')</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-4">
                            <h6 class="mt-n1 mb-0">@lang('Company Details')</h6>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-5">
                            <h6 class="mt-n1 mb-0">@lang('Confirmation')</h6>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="title" placeholder="@lang('Title')" required>
                                        <label for="title">@lang('Title') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="location" placeholder="@lang('Location')" required>
                                        <label for="location">@lang('Location') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="minimal_salary" placeholder="@lang('Min. salary')" required>
                                        <label for="minimal_salary">@lang('Min. salary') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="maximal_salary" placeholder="@lang('Max. salary')">
                                        <label for="maximal_salary">@lang('Max. salary')</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" name="category" id="category">
                                        <option>@lang('Select a category') <b class="text-danger">*</b></option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" name="category" id="category">
                                        <option>@lang('Select a sub-category') <b class="text-danger">*</b></option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-select" name="type" id="type">
                                        <option>@lang('Select the job type') <b class="text-danger">*</b></option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="dateline" placeholder="@lang('Date Line')">
                                        <label for="dateline">@lang('Date Line') <b class="text-danger">*</b></label>
                                    </div>
                                    {{-- <small><b class="text-danger">*</b> @lang('Deadline for receipt of applications')</small> --}}
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="@lang('Add a description')" id="description" style="height: 150px"></textarea>
                                        <label for="description">@lang('Short Description') <b class="text-danger">*</b></label>
                                    </div>
                                    {{-- <small><b class="text-danger">*</b> @lang('General introduction to the job')</small> --}}
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="file" placeholder="@lang('Add job specifications file')">
                                        <label for="file">@lang('Add job specifications file')</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <select class="form-select select2-multiple" name="tags[]" id="tags" data-placeholder="@lang('Select Tags')" multiple>
                                        <option>tytyty</option>
                                        <option value="d">2</option>
                                        <option value="c">3</option>
                                        <option value="b">4</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="content" placeholder="@lang('Requirement') 1" required>
                                        <label for="content">@lang('Requirement') 1 <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-between">
                                    <button class="btn btn-secondary w-50 py-3 mr-1">+</button>
                                    {{-- <button class="btn btn-danger w-50 py-3 ml-1">-</button> --}}
                                </div>
                                <div class="col-md-10">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="content" placeholder="@lang('Requirement') 2">
                                        <label for="content">@lang('Requirement') 2 <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-between">
                                    <button class="btn btn-secondary w-50 py-3 mr-1">+</button>
                                    <button class="btn btn-danger w-50 py-3 ml-1">-</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="content" placeholder="@lang('Content') 1" required>
                                        <label for="content">@lang('Content') 1 <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="@lang('Name')" required>
                                        <label for="name">@lang('Name') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="@lang('Email')" required>
                                        <label for="email">@lang('Email') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="location" placeholder="@lang('Location')" required>
                                        <label for="location">@lang('Location') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="url" class="form-control" id="url" placeholder="@lang('Website')">
                                        <label for="url">@lang('Website')</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="@lang('Add a description')" id="description" style="height: 150px"></textarea>
                                        <label for="description">@lang('Description') <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="logo" placeholder="@lang('Add a logo')">
                                        <label for="logo">@lang('Add a logo')</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-5" class="tab-pane fade show p-0">
                        
                    </div>
                </div>
                
                <div class="col-12 d-flex justify-content-between mt-2">
                    <button class="btn btn-dark w-40 py-3" type="submit">@lang('Back')</button>
                    <button class="btn btn-primary w-40 py-3" type="submit">@lang('Next')</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('assets/front/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2();
        });
    </script>
@endpush