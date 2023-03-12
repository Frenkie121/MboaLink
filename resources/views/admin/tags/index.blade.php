@extends('layouts.back')

@section('subtitle', __('Tags list'))

@push('css')
    @livewireStyles()
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    @livewire('admin.tags-manage')
@endsection


@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#AddTag').modal('hide');
            $('#deleteTag').modal('hide');
            $('#EditTag').modal('hide');
        });
    </script>
    @livewireScripts()
@endpush
