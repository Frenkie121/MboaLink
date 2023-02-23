@php
  $currentUri = Route::current()->uri;
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">{{ config('app.name', 'MboaLink') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Mb</a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if(Str::contains($currentUri, 'dashboard')) active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> <span>@lang('Dashboard')</span></a>
            </li>
        </ul>
    </aside>
</div>