@extends('layouts.back')

@section('subtitle', __('Edit subscription'))

@push('css')
    {{-- @livewireStyles() --}}
    <style>
        .list-group-item p {
            margin-bottom: -10px;
        }
    </style>
@endpush

@section('content')
   
@endsection
@push('js')
    <script>
        window.addEventListener('close-modal', event => {
            $('#deleteCategory').modal('hide');
        });
    </script>
    @livewireScripts()
@endpush
