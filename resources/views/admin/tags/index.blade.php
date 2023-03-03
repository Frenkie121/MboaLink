@extends('layouts.back')

@section('subtitle', __('Tags list'))

@push('css')
    @livewireStyles()
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @livewire('tags-manage')
@endsection


@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#AddCategory').modal('hide');
            $('#deleteCategory').modal('hide');
            $('#EditCategory').modal('hide');
        });
    </script>
    @livewireScripts()
@endpush
