@extends('layouts.back')

@section('subtitle', __('Jobs list'))

@push('css')
    @livewireStyles()
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <div>
        <x-admin.section-header :title="__('Job show')" :previousTitle="__('Jobs list')" :previousRouteName="route('admin.jobs.index')" />

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                             <!-- Button trigger modal -->
                             <button style="float: right;" type="button" class="btn btn-lg btn btn-success">
                             <i class="fa fa-check btn-sm"></i> @lang('Published') </button>
                         <br><br><br>
                            <div class="table-responsive  table-bordered">

                                <table class="table table-striped" id="table-1">

                                    <tr>
                                        <td style="font-weight:bold;">@lang('Title')</td>
                                        <td>{{ $job->title }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Slug')</td>
                                        <td>{{ $job->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Description')</td>
                                        <td>{{ $job->description }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Location')</td>
                                        <td>{{ $job->location }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;"> @lang('Salary')</td>
                                        <td>{{ $job->salary }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Dateline')</td>
                                        <td>{{ $job->dateline }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Company')</td>
                                        <td>{{ $job->company->location }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Sub-category')</td>
                                        <td>{{ $job->subCategory->name }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Tag')</td>
                                        <td>
                                            @forelse ($job->tags as $item)
                                                {{ $item->name }},
                                            @empty
                                                ---
                                            @endforelse
                                        </td>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Type')</td>
                                        <td>{{ $job->type }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('File')</td>
                                        <td>
                                            @if ($job->file)
                                                {{ $job->file }}
                                            @else
                                                Any
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Created at')</td>
                                        <td>{{ $job->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">@lang('Updated at')</td>
                                        <td>{{ $job->updated_at }}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    @endsection
