@extends('layouts.back')

@php
    $company = $user->role_id === 2;
    $title = $company ? __('Jobs list') : __('Applications');
@endphp

@section('subtitle', $title)

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <x-admin.section-header :title="$title . __(' from ') . $user->name" :previousTitle="__('Subscriber profile')" :previousRouteName="url()->previous()" />
    
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('Title')</th>
                                            <th scope="col">@lang('Category')</th>
                                            <th scope="col">@lang('Type')</th>
                                            @if ($company)
                                                <th scope="col">@lang('Submitted at')</th>
                                                <th scope="col">@lang('Published at')</th>
                                            @else
                                                <th scope="col">@lang('Salary')</th>
                                                <th scope="col">@lang('Applied on')</th>
                                            @endif
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jobs as $job)
                                            @php
                                                $hasTalent = $company ? $job->talents->isNotEmpty() : null;
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td class="fw-bold" title="{{ $job->title }}">{{ $job->reduce_title }}</td>
                                                <td title="{{ $job->subCategory->category->name }}">{{ $job->subCategory->category->short_name }}</td>
                                                <td>{{ $job->type }}</td>
                                                @if ($company)
                                                    <td>{{ $job->created_at }}</td>
                                                    <td>
                                                        @if ($job->published_at)
                                                            {{ $job->published_at }}
                                                        @else
                                                            <span class="badge bg-info">@lang('Pending')</span>
                                                        @endif
                                                    </td>
                                                @else
                                                    <td>{{ $job->salary }} XAF</td>
                                                    <td>{{ formatedLocaleDate($job->pivot->created_at) }}</td>
                                                @endif
                                                <td class="text-center">
                                                    <a href="{{ route('admin.job.show', $job->slug) }}" class="btn btn-primary" title="@lang('Job Details')"><i class="fas fa-eye"></i></a>
                                                    @if ($company)
                                                        <a 
                                                            href="@if($hasTalent){{ route('admin.job.applicants', $job->slug) }} @else # @endif"
                                                            class="btn btn-{{ $hasTalent ? 'info' : 'secondary' }}"
                                                            title="@if($hasTalent)@lang('Applicants list')@else @lang('No applicant yet')@endif">
                                                            <i class="fas fa-users"></i>@if($hasTalent)<sup>{{ $job->talents->count() }}</sup> @endif
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@push('js')
    <script src="{{ asset('assets/back/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/back/js/page/modules-datatables.js') }}"></script>
@endpush