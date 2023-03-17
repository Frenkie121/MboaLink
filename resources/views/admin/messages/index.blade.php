@extends('layouts.back')

@section('subtitle', __('Sub-categories list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <x-admin.section-header :title="__('Message list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

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
        window.livewire.on('closeFormReply', () => {
            // Close Input Reply and replyButton
           document.getElementById('InputRepyForm').style.display = 'none';
        });
        window.livewire.on('showFormReply', () => {
            // Show input reply
            document.getElementById('InputRepyForm').style.display = 'block';
            // document.getElementById('buttonReply').style.display = 'none';
        });


    </script>
@endpush
