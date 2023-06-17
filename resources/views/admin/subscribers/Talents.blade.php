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
    <x-admin.section-header :title="__('Subscribers list') . ' - ' . __('Job seekers')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

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
                                        <th>@lang('Subscriptions')</th>
                                        <th>@lang('Active until')</th>
                                        <th>@lang('Email')</th>
                                        <th>@lang('Phone Number')</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscribers as $subscriber)
                                        @php
                                            $last_subscription = $subscriber->subscriptions->last()->pivot;
                                        @endphp
                                        <tr class="{{ $last_subscription->created_at > now()->addMonth() ? 'text-danger font-weight-bold' : '' }}">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $subscriber->name }}</td>
                                            <td>
                                                <span class="badge badge-info">
                                                    {{ $subscriber->role->name }} <span class="badge badge-light">{{ $subscriber->subscriptions->count() }}</span>
                                                    <span class="sr-only">unread messages</span>
                                                </span>
                                            </td>
                                            <td>
                                                @if (! $last_subscription->ends_at)
                                                    <span class="badge badge-dark">@lang('Inactive')</span>
                                                @elseif ($last_subscription->ends_at >= now())
                                                    <span class="text-success font-weight-bold">{{ formatedLocaleDate($last_subscription->ends_at) }}</span>
                                                @else
                                                    <span class="text-danger">{{ formatedLocaleDate($last_subscription->ends_at) }}</span>
                                                @endif
                                            </td>
                                            <td> 
                                                <a href="mailto:{{ $subscriber->email }}" target="_blank">{{ $subscriber->email }}</a>
                                            </td>
                                            <td> 
                                                <a href="https://wa.me/{{ $subscriber->phone_number }}" title="@lang('Chat on WhatsApp')" target="_blank">{{ $subscriber->phone_number }}</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary"
                                                    href="{{ route('admin.subscribers.profile', $subscriber) }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if (! $last_subscription->starts_at)
                                                    <a  class="btn btn-success" title="{{ $subscriber->subscriptions_count > 1 ? __('Validate the renewal') : __('Validate Subscription') }}"
                                                        onclick="loadDeleteModal({{ $subscriber->id }}, `{{ $subscriber->name }}`)">
                                                        <i style="color: white;" class="fas fa-check"></i></a>
                                                @else
                                                    <a class="btn btn-secondary" role="link" title="@lang('Subscription activated')">
                                                    <i style="color: white;" class="fas fa-check"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @include('includes.back.subscribers.confirmationValidateModal', ['subscriptions_count' => $subscriber->subscriptions->count()])
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
