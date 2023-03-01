@extends('layouts.back')

@section('subtitle', __('Sub-categories list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    
    <x-admin.section-header :title="__('Sub-categories list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="row">
            @livewire('admin.manage-sub-categories')
        </div>
    </div>
@endsection
    
@push('js')
    
    <script type="text/javascript">
        window.livewire.on('closeModal', () => {
            $('#categoryModal').modal('hide');
        });
    </script>
    
    <script type="text/javascript">
        window.livewire.on('openModal', () => {
            $('#categoryModal').modal('show');
        });
    </script>
@endpush