@php
    $currentUri = Route::current()->uri;
@endphp

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img alt="image" src="{{ asset('assets/logo.png') }}" class="rounded-circle mr-1" width="60">
                {{ config('app.name', 'MboaLink') }}
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Mb</a>
        </div>
        <ul class="sidebar-menu">
            <li class="@if (Str::contains($currentUri, 'dashboard')) active @endif">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                    <span>@lang('Dashboard')</span></a>
            </li>
            <li class="@if (Str::contains($currentUri, 'users')) active @endif">
                <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>
                    <span>@lang('Users')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'admin/categories')) active @endif">
                <a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fas fa-th"></i>
                    <span>@lang('Categories')</span></a>
            </li>
            
            <li class="@if (Str::contains($currentUri, 'sub-categories')) active @endif">
                <a class="nav-link" href="{{ route('admin.sub-categories.index') }}"><i class="fas fa-layer-group"></i>
                    <span>@lang('Sub-categories')</span></a>
            </li>
            <li class="@if (Str::contains($currentUri, 'tags')) active @endif">
                <a class="nav-link" href="{{ route('admin.tags.index') }}"><i class="fas fa-tags"></i>
                    <span>@lang('Tags')</span></a>
            </li>
            
            <li class="@if (Str::contains($currentUri, 'subscription')) active @endif">
                <a class="nav-link" href="{{ route('admin.subscription.index') }}"><i class="fas fa-plug"></i>
                    <span>@lang('Subscriptions')</span></a>
            </li>
            
            <li class="@if (Str::contains($currentUri, 'jobs')) active @endif">
                <a class="nav-link" href="{{ route('admin.jobs.index') }}"><i class="fa fa-briefcase"></i>
                    <span>@lang('Jobs')</span></a>
            </li>

            <li class="dropdown @if (Str::contains($currentUri, 'subscribers')) active @endif">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-user-check"></i>
                    <span>@lang('Subscribers')</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="@if (Str::contains($currentUri, 'talents')) active @endif">
                        <a class="nav-link" href="{{ route('admin.subscribers.talent.index') }}">  
                            <span>@lang('Job seekers')</span>
                        </a>
                    </li>
                    <li class="@if (Str::contains($currentUri, 'companies')) active @endif">
                        <a class="nav-link" href="{{ route('admin.subscribers.company.index') }}">
                            <span>@lang('Companies')</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="@if (Str::contains($currentUri, 'contacts')) active @endif">
                <a class="nav-link" href="{{ route('admin.contacts.index') }}"><i class="fa fa-comment"></i>
                    <span>@lang('Contacts')</span></a>
            </li>

            <li class="@if (Str::contains($currentUri, 'newsletter')) active @endif">
                <a class="nav-link" href="{{ route('admin.newsletters.add') }}"><i class="fas fa-fire"></i>
                    <span>@lang('Newsletters')</span></a>
            </li>

        </ul>
    </aside>
</div>
