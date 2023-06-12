@extends('errors::layout')

@section('subtitle', __('Server Error'))
@section('code', '500')
@section('message', __('Something went wrong, please retry later or contact admin.'))
