@extends('layouts.back')

@section('subtitle', __('Subscribers list'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <x-admin.section-header :title="__('Subscribers list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('active')</th>
                                        <th>@lang('Phone Number')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                        @if ($subscriber->role_id === 2)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $subscriber->name }}</td>
                                                <td>
                                                    <a href="mailto:{{ $subscriber->email }}">{{ $subscriber->email }}</a>
                                                </td>
                                                <td>
                                                    @foreach ($subscriber->subscriptions->last()->users()->with(['role', 'subscriptions'])->get() as $user)
                                                        @if ($user->id === $subscriber->id)
                                                            @if ($user->pivot->starts_at)
                                                                {{ formatedLocaleDate($user->pivot->starts_at) }}
                                                            @else
                                                                @lang('Any')
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>{{ $subscriber->phone_number }}</td>

                                                <td>
                                                    <a class="btn btn-primary"
                                                        href="{{ route('admin.subscribers.profile', $subscriber) }}"> <i
                                                            class="fa fa-eye"></i></a>
                                                    <a class="btn btn-success" href="#"> <i
                                                            class="fas fa-check"></i></a>
                                                </td>
                                            </tr>
                                        @endif
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
