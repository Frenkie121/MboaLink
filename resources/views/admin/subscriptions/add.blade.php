@extends('layouts.back')

@section('subtitle', __('Add new subscription'))

@push('css')
    {{-- @livewireStyles() --}}
    <style>
        .list-group-item p {
            margin-bottom: -10px;
        }
    </style>
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <x-admin.section-header :title="__('Add new subscription')" :previousTitle="__('Subscription list')" :previousRouteName="route('admin.subscription.index')" />
    <div class="container mt-4 col-10">
        <div class="offset-md-0" style="background-color: red;">
            <div style="background-color: white;">
                @livewire('admin.subscription.store')
            </div>
        </div>
        <div class="offset-lg-2 offset-md-0"></div>
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
