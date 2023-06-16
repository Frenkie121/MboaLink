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
        <x-admin.section-header :title="__('Job Details')" :previousTitle="__('Jobs list')" :previousRouteName="route('admin.jobs.index')" />
        <div class="section-body">
            <div class="row">
                <div class="col-12 mb-2">
                    @livewire('admin.delete-modal-publish', ['job' => $job])
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card card-primary">
                                <div class="card-body">
                                    <h4 class="card-title">@lang('General Informations')</h4>
                                    <div class="row">
                                        <div class="card border-success col-md-6">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <p>@lang('Title') : <strong>{{ $job->title }}</strong></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Salary') : <strong>{{ $job->salary }} XAF</strong></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Category') : <strong>{{ $job->subCategory->category->name }}</strong></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Sub-category') : <strong>{{ $job->subCategory->name }}</strong></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Job Type') : <strong>{{ __($job->type) }}</strong></p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Dateline') : <strong>{{ $job->dateline }}</strong></p>
                                                    </li>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Submitted at') : <strong>{{ $job->created_at }}</strong></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card border-danger col-md-6">
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <p>@lang('Published at') : <strong>{{ $job->published_at ?? trans('Not published yet') }}</strong></p>
                                                    </li>
                                                    {{-- <li class="list-group-item d-inline">
                                                        <p>@lang('Tags') : <strong>{{ $job->tags->isNotEmpty() ? implode(', ', $job->tags->pluck('name')->toArray()) : trans('No tag') }}</strong></p>
                                                    </li> --}}
                                                    <li class="list-group-item">
                                                        <p>@lang('File') : 
                                                            <strong>
                                                                @if ($job->file)
                                                                    <a href="{{ route('admin.job.download', $job) }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-download"></i></a>
                                                                @else
                                                                    @lang('No file')
                                                                @endif
                                                            </strong>
                                                        </p>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <p>@lang('Description') : <strong>{{ $job->description }}</strong></p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="card border-warning col-md-6">
                                            <div class="card-body">
                                                <h4 class="card-title">@lang('Requirements')</h4>
                                                <hr>
                                                <ul>
                                                    @foreach ($job->requirements as $requirement)
                                                        <li class="mb-0">
                                                            <p>{{ $requirement->content }}</p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card border-success col-md-6">
                                            <div class="card-body">
                                                <h4 class="card-title">@lang('Qualifications')</h4>
                                                <hr>
                                                <ul>
                                                    @foreach ($job->qualifications as $qualification)
                                                        <li>
                                                            <p>{{ $qualification->content }}</p>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="row">
                                    <div class="card border-danger col-md-6">
                                        <div class="card-body">
                                            <h4 class="card-title">@lang('Company Details')</h4>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <p>@lang('Nom') : <strong>{{ $job->company->user->name }}</strong></p>
                                                </li>
                                                <li class="list-group-item">
                                                    <p>@lang('Email') : <strong>{{ $job->company->user->email }}</strong></p>
                                                </li>
                                                <li class="list-group-item">
                                                    <p>@lang('Location') : <strong>{{ $job->company->location }}</strong></p>
                                                </li>
                                                <li class="list-group-item">
                                                    <p>@lang('Website') : 
                                                        @if ($url = $job->company->url)
                                                            <a href="{{ $url }}">{{ $url }}</a>
                                                        @else
                                                            @lang('No website address')
                                                        @endif
                                                    </p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card border-warning col-md-6">
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <p>@lang('Description') : <strong>{{ $job->company->description }}</strong></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
