@extends('layouts.back')

@section('subtitle', __('Subscriber profile'))

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/back/modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <x-admin.section-header :title="__('Subscriber profile')" :previousTitle="__('Subscribers List')" :previousRouteName="route('admin.subscribers.index')" />

    <div class="section-body">
        <div class="row mt-sm-4">
            <div class="col-12 col-md-12 col-lg-5">
                <div class="card profile-widget">
                    <div class="profile-widget-header">
                        <img alt="image" src=" {{ asset('assets/back/img/avatar/avatar-2.png') }}"
                            class="rounded-circle profile-widget-picture">
                        {{-- <div class="profile-widget-items">
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Posts</div>
                                <div class="profile-widget-item-value">187</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Followers</div>
                                <div class="profile-widget-item-value">6,8K</div>
                            </div>
                            <div class="profile-widget-item">
                                <div class="profile-widget-item-label">Following</div>
                                <div class="profile-widget-item-value">2,1K</div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="profile-widget-description">
                        <div class="profile-widget-name"> {{ $user->name }} <div
                                class="text-muted d-inline font-weight-normal">
                                <div class="slash"></div>{{ $user->subscriptions->last()->name }}
                            </div>
                        </div>

                        @if ($user->role->id === 3)
                            {{-- Student --}}
                            I am {{ $user->subscriptions->last()->name }} at <b>{{ $user->last()->name }}</b>, especially in
                            my family. He is not a fictional
                            character but an original hero in my family, a hero for his children and for his wife. So, I use
                            the
                            name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                        @elseif ($user->role->id === 4)
                            {{-- Pupil --}}
                            I am {{ $user->subscriptions->last()->name }} at <b>{{ $user->userable->school }}</b>, especially in
                            my family. He is not a fictional
                            character but an original hero in my family, a hero for his children and for his wife. So, I use
                            the
                            name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                        @elseif ($user->role->id === 5)
                            {{-- Unemployment --}}
                            I am {{ $user->subscriptions->last()->name }} in <b>{{ $user->last()->name }}</b>, especially
                            in my family. He is not a fictional
                            character but an original hero in my family, a hero for his children and for his wife. So, I use
                            the
                            name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.
                        @endif

                    </div>
                    <div class="card-footer text-center">
                        <div class="font-weight-bold mb-2">Follow Ujang On</div>
                        <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-social-icon btn-github mr-1">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="btn btn-social-icon btn-instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <div class="card">
                        <form method="post" class="needs-validation" novalidate="">
                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" value="Ujang" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the first name
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" value="Maman" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the last name
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-7 col-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="ujang@maman.com" required="">
                                        <div class="invalid-feedback">
                                            Please fill in the email
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5 col-12">
                                        <label>Phone</label>
                                        <input type="tel" class="form-control" value="">
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="form-group col-12">
                                        <label>Bio</label>
                                        <textarea class="form-control summernote-simple">Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a fictional character but an original hero in my family, a hero for his children and for his wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with <b>'John Doe'</b>.</textarea>
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <div class="form-group mb-0 col-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="remember" class="custom-control-input"
                                                id="newsletter">
                                            <label class="custom-control-label" for="newsletter">Subscribe to
                                                newsletter</label>
                                            <div class="text-muted form-text">
                                                You will get new information about products, offers and promotions
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>


            {{-- </div> --}}

            {{-- ----------------------- --}}
            <div class="col-12 col-md-12 col-lg-7 row">

                <div class="card ">

                    <div class="row p-4">
                        @livewire('admin.profile-subscriber.suscription-list')
                    </div>

                </div>
            </div>

            {{-- ------------------------ --}}


        </div>
    </div>

    {{-- </section> --}}

@endsection

@push('js')
    {{-- <script src="{{ asset('assets/back/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/back/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/back/js/page/modules-datatables.js') }}"></script> --}}
@endpush
