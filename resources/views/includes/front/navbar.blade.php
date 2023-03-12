@php
    $currentRouteName = Route::currentRouteName();
@endphp

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('front.home') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">{{ config('app.name', 'MboaLink') }}</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('front.home') }}" class="nav-item nav-link @if (Str::endsWith($currentRouteName, 'home')) active @endif">@lang('Home')</a>
            <a href="{{ route('front.about') }}" class="nav-item nav-link @if (Str::endsWith($currentRouteName, 'about')) active @endif">@lang('About')</a>
            <div class="nav-item dropdown">
                <a href="#" 
                    class="nav-link dropdown-toggle 
                    @if (Str::contains($currentRouteName, 'categories') 
                    || (Str::contains($currentRouteName, 'jobs'))) active 
                    @endif" 
                    data-bs-toggle="dropdown">Jobs</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{ route('front.categories') }}" class="dropdown-item 
                        @if (Str::endsWith($currentRouteName, 'categories')) active @endif"
                    >@lang('Categories')</a>
                    <a href="{{ route('front.jobs.index') }}" class="dropdown-item
                        @if (Str::endsWith($currentRouteName, 'index')) active @endif"
                    >@lang('Job List')</a>
                    <a href="{{ route('front.jobs.create') }}" class="dropdown-item
                        @if (Str::endsWith($currentRouteName, 'create')) active @endif"
                    >@lang('Post A Job')</a>
                </div>
            </div>
            <a href="#" class="nav-item nav-link">Contact</a>
        </div>
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if (app()->getLocale() === 'fr') Fr @else En @endif
            </a>
            <div class="dropdown-menu rounded-0 m-0">
                <a href="{{ route('lang', 'fr') }}" class="dropdown-item">Fr</a>
                <a href="{{ route('lang', 'en') }}" class="dropdown-item">En</a>
            </div>
        </div>
        <a href="{{ route('front.jobs.create') }}" class="btn btn-primary rounded-0 py-4 px-lg-3 d-none d-lg-block">@lang('Post A Job')<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>