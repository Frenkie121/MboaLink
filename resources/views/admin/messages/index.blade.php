@extends('layouts.back')

@section('subtitle', __('Sub-categories list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <x-admin.section-header :title="__('Messasges list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

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
        //show modal details
        window.livewire.on('openModal', () => {
            $('#MessageModal').modal('show');
        });
        // Close Input Reply
        window.livewire.on('closeFormReply', () => {
           document.getElementById('InputRepyForm').style.display = 'none';
        });
        // Show input reply
        window.livewire.on('showFormReply', () => {
           document.getElementById('InputRepyForm').style.display = 'block';
        });
    </script>
@endpush
