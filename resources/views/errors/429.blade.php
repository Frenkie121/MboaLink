@extends('errors::layout')

@section('subtitle', __('Too Many Requests'))
@section('code', '429')
@section('message', __('You have made too many requests, retry later.'))
