@extends('layouts.back')

@section('subtitle', __('Job Details'))

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
    <div>
        <x-admin.section-header :title="__('Add Subscription')" :previousTitle="__('Subscription list')" :previousRouteName="route('admin.subscription.index')" />
        <div class="section-body row">
            <div class=" offset-md-0"></div>

            <div class="col-md-12 offset-md-0 col-lg-12 offset-lg-2   ">
                <div class="container-fluid">
                    <div class="col-12 col-lg-8 col-lg-8">
                        @livewire('admin.subscription.store')

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
