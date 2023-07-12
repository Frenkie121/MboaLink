@extends('layouts.back')

@section('subtitle', __('Applicants list'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <x-admin.section-header :title="__('Applicants list for job ') . $job->reduce_title" :previousTitle="__('Jobs list')" :previousRouteName="route('admin.jobs.index')" />
    
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
                                            <th scope="col">@lang('Type')</th>
                                            <th scope="col">@lang('Name')</th>
                                            <th scope="col">@lang('Email')</th>
                                            <th scope="col">@lang('Phone Number')</th>
                                            <th scope="col">@lang('Applied on')</th>
                                            <th scope="col" class="text-center">@lang('Details')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($talents as $talent)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ __($talent->user->getFreeSubscriptionType()->name) }}</td>
                                                <td>{{ $talent->user->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $talent->user->email }}" target="_blank">{{ $talent->user->email }}</a>    
                                                </td>
                                                <td>
                                                    <a href="https://wa.me/{{ $talent->user->phone_number }}" title="@lang('Chat on WhatsApp')" target="_blank">{{ $talent->user->phone_number }}</a>    
                                                </td>
                                                <td>{{ formatedLocaleDate($talent->pivot->created_at) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.subscribers.profile', $talent->user->slug) }}" class="btn btn-primary"><i class="fas fa-eye"></i></a>
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