@extends('layouts.back')

@section('subtitle', __('Contacts list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <x-admin.section-header :title="__('Contacts list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-messages')
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
            // close message  modal
        window.livewire.on('closeModal', () => {
            $('#MessageModal').modal('hide');
            $('#InputRepyForm').modal('hide');
        });
        window.livewire.on('openModal', () => {
            //show modal details
            $('#MessageModal').modal('show');
        });
    </script>
@endpush
