@extends('layouts.back')

@section('subtitle', __('Profile'))

@section('content')
    
    <x-admin.section-header :title="__('Profile')" :previousTitle="__('Dashboard')" :previousRouteName="route('admin.dashboard')" />
    <div class="section-body">
        <h2 class="section-title">@lang('Hi'), {{ auth()->user()->name }}!</h2>
        <p class="section-lead">
            @lang('Change information about yourself on this page.')
        </p>
        
        <div class="row mt-sm-4">
            <div class="row col-12 col-md-12 col-lg-12">
                <div class="card col-md-5">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')
                        <div class="card-header">
                            <h4>@lang('Profile Information')</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group col-md-12 col-12">
                                <label>@lang('Name')</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label>@lang('Email')</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">@lang('Save')</button>
                        </div>
                    </form>
                </div>
                <div class="card col-md-7">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>@lang('Update Password')</h4>
                        </div>
                        <div class="card-body">                           
                            <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>@lang('Current password')</label>
                                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>@lang('New password')</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="form-group row col-md-12 col-12">
                                <label>@lang('Confirm password')</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">@lang('Save')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection