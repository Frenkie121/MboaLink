@php
    $currentRouteName = Route::currentRouteName();
    $fr_locale = app()->getLocale() === 'fr';
@endphp

<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('front.home') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-1 px-lg-2">
        {{-- <h1 class="m-0 text-primary">{{ config('app.name', 'MboaLink') }}</h1> --}}
        <img src="{{ asset('assets/logo.png')}}" alt="{{ config('app.name', 'MboaLink') }} logo" width="100" class="shadow-light rounded-circle mt-2" id="logo-nav">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div id="navbar-nav" class="navbar-nav p-4 p-lg-0 px-5">
            <a href="{{ route('front.home') }}" class="nav-item nav-link @if (Str::endsWith($currentRouteName, 'home')) active @endif">@lang('Home')</a>
            <a href="{{ route('front.about') }}" class="nav-item nav-link @if (Str::endsWith($currentRouteName, 'about')) active @endif">@lang('About')</a>
            <a href="{{ route('front.subscriptions.index') }}" class="nav-item nav-link @if (Str::contains($currentRouteName, 'subscriptions.index') || (Str::endsWith($currentRouteName, 'subscribe'))) active @endif">@lang('Pricing')</a>
            <div class="nav-item dropdown">
                <a href="#" 
                    class="nav-link dropdown-toggle 
                    @if (Str::contains($currentRouteName, 'categories') 
                    || (Str::contains($currentRouteName, 'jobs.'))) active 
                    @endif" 
                    data-bs-toggle="dropdown">@lang('Jobs')</a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="{{ route('front.categories') }}" class="dropdown-item 
                        @if (Str::endsWith($currentRouteName, 'categories')) active @endif"
                    >@lang('Categories')</a>
                    <a href="{{ route('front.jobs.index') }}" class="dropdown-item
                        @if (Str::endsWith($currentRouteName, 'jobs.index')) active @endif"
                    >@lang('Job List')</a>
                    @if (auth()->check() && auth()->user()->userable_type === 'App\Models\Company')
                        <a href="{{ route('front.jobs.create') }}" class="dropdown-item
                            @if (Str::endsWith($currentRouteName, 'create')) active @endif"
                        >@lang('Post A Job')</a>
                    @endif
                </div>
            </div>
            <a href="{{ route('front.contact') }}" class="nav-item nav-link @if (Str::endsWith($currentRouteName, 'contact')) active @endif">Contact</a>
        </div>
        @auth
            <div class="nav-item dropdown auth">
                <button id="auth-btn" class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</button>
                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="dropdownMenuButton1">
                    @if (auth()->user()->role_id === 1)
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">@lang('Go to dashboard')</a></li>
                    @elseif (in_array(auth()->user()->role_id, [2, 3, 4, 5]))
                        <li><a class="dropdown-item" href="{{ route('front.subscriber.profile') }}">@lang('My dashboard')</a></li>
                        @if (auth()->user()->role_id === 2)
                            <li><a class="dropdown-item" href="{{ route('front.jobs.create') }}">@lang('Post A Job')</a></li>
                        @endif
                    @elseif (auth()->user()->subscriptions->isNotEmpty() && auth()->user()->subscriptions->first()->pivot->starts_at)
                        <li><a class="dropdown-item" href="{{ route('front.subscriptions.renew') }}">@lang('Upgrade my subscription')</a></li>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            this.closest('form').submit();"
                            class="dropdown-item"> @lang('Log Out')
                            </a>
                        </li>
                    </form>
                </ul>
            </div>
        @else
            <div class="nav-item nav-link auth">
                <a href="{{ route('login') }}" type="button" class="btn btn-primary mt-2 me-2">@lang('Log in')</a>
            </div>
        @endauth
        
        {{-- <a href="#" class="py-4 px-lg-3 d-none d-lg-block text-white">@lang('Post A Job')<i class="fa fa-arrow-right ms-3"></i></a> --}}
    </div>
</nav>