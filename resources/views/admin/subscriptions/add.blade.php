@extends('layouts.back')

@section('subtitle', __('Job Details'))

@push('css')
    @livewireStyles()
    <style>
        .list-group-item p {
            margin-bottom: -10px;
        }
    </style>
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <div>
        <x-admin.section-header :title="__('Add Subscription')" :previousTitle="__('Jobs list')" :previousRouteName="route('admin.jobs.index')" />
        <div class="section-body row">
            <div class=" offset-md-0"></div>

            <div class="col-md-12 offset-md-0 col-lg-12 offset-lg-2   ">
                <div class="container-fluid">
                    <div class="col-12 col-lg-8 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">@lang('Subscription')</h5>
                                <hr>
                                <p style="mt-15" class="text-center">There,we write a small description</p>
                            </div>
                            <div class="card-body">
                                <br>

                                <div class="form-group">
                                    <label> @lang('Name')</label>
                                    <input type="text" class="form-control" value="Rizal Fakhri" required="">
                                    <div class="valid-feedback">
                                        Good job!
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>@lang('Duration in month(s)') </label>
                                            <input type="number" class="form-control" min="0" placeholder=" 4 "
                                                required="">
                                            <div class="invalid-feedback">
                                                Oh no! Email is invalid.
                                            </div>

                                        </div>
                                        <div class="col-lg-6">
                                            <label>@lang('Amount') (Fcfa)</label>
                                            <input type="number" class="form-control" min="0" placeholder=" 5000 "
                                                required="">
                                            <div class="invalid-feedback">
                                                Oh no! Email is invalid.
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <br> <br>
                                <div class="card-header">
                                    <h5 class="card-title ">@lang('Offer')</h5>
                                    <hr>
                                    <p style="mt-15" class="text-center">There,we write a small description</p>
                                </div>
                               @livewire('admin.subscription.store')

                            </div>
                            <div class="card-footer text-right">
                                <hr style="background-color:rgb(61, 126, 217);">
                                <button class="btn btn-success btn-lg mt-7 mr-3" type="submit">Submit</button>
                                <button class="btn btn-danger btn-lg" type="reset">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" offset-lg-2"></div>

        </div>

    </div>


@endsection
@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteCategory').modal('hide');
        });
    </script>
    @livewireScripts()
@endpush
