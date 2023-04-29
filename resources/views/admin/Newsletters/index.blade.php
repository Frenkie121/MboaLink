@extends('layouts.back')

@section('subtitle', __('Contacts list'))

@section('content')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <x-admin.section-header :title="__('Contacts list')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />

    <div class="section-body">
        <div class="container">

            <div class="row">
                <div class="col-offset-2">

                </div>
                <div class="card">
                    <form action="">

                        <div class="card-header">
                            <h2 class="text-center"> @lang('Send Email')</h2>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="file">@lang('Attachment')</label>
                                <input type="text" name="" id="">

                            </div>
                            <div class="form-group">
                                <label for="file">@lang('Attachment')</label>
                                {{-- <textarea type="text" name="" id=""> --}}
                                <textarea name="" id="" cols="30" rows="10"></textarea>

                            </div>
                            <div class="form-group">
                                <label for="file">@lang('Attachment')</label>
                                <input type="file" name="" id="">

                            </div>
                        </div>
                    </form>
                </div>
            </div>

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
