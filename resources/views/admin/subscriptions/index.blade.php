@extends('layouts.back')

@section('subtitle', __('Subscription list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <x-admin.section-header :title="__('Subscription list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        {{-- <div class="row"> --}}
            @livewire('admin.manage-subscription')
        {{-- </div> --}}
    </div>
@endsection

@push('js')
    <script type="text/javascript">
            // close message  modal
        window.livewire.on('closeModal', () => {
            // $('#MessageModal').modal('hide');
            $('#deleteSubscription').modal('hide');
        });
        window.livewire.on('openModalDelete', () => {
            //show modal details
            $('#deleteSubscription').modal('show');
        });
    </script>
@endpush
