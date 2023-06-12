@extends('errors::layout')

@section('title', __('Unauthenticated'))
@section('code', '401')
@section('message', __('You must be authenticated to access the requested page.'))
