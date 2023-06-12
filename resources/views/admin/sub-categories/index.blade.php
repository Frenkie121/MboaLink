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
        // Add/Update category modal
        window.livewire.on('closeModal', () => {
            $('#subCategoryModal').modal('hide');
        });
        window.livewire.on('openModal', () => {
            $('#subCategoryModal').modal('show');
        });

        // Delete category modal
        window.livewire.on('openDeleteModal', () => {
            $('#deleteSubCategoryModal').modal('show');
        });
    </script>
@endpush
