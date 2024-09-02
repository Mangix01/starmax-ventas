<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="" class="brand-link">
        <img src="{{ asset('img/logo2.png') }}"
             alt="Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

     <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
            @endif
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
                <a href="#" class="d-block">
                    @if(auth()->user()->roles->isNotEmpty())
                        {{ auth()->user()->roles->first()->name }}
                    @else
                        {{ __('No Role Assigned') }}
                    @endif
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
