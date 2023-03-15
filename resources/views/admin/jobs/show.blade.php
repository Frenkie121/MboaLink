@extends('layouts.back')

@section('subtitle', __('Show Job'))

@push('css')
    @livewireStyles()
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
    <div>
        <x-admin.section-header :title="__('Job show')" :previousTitle="__('Jobs list')" :previousRouteName="route('admin.jobs.index')" />
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @livewire('admin.delete-modal-publish', ['job' => $job])
                           
                        </div>

                    </div>
                </div>
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
