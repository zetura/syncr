@extends('layouts.base')
    @section('page')
        <div class="container">
            <dl class="sub-nav">
                <dt>Administration:</dt>
                <dd class="{{ \App\Helpers\ActiveRoute::is_active('admin/') }}"><a href="{{ route('admin') }}"><span class="fi-cogs" title="parameters" aria-hidden="true"></span> Parameters</a></dd>
                @if(\Auth::user()->hasRight(\App\Right::CLIENT_MODIFY))
                <dd class="{{ \App\Helpers\ActiveRoute::is_active('admin/clients') }}"><a href="{{ route('admin.clients') }}"><span class="fi-briefcase" title="clients" aria-hidden="true"></span> Manage clients</a></dd>
                @endif
{{--                <dd class="{{ \App\Helpers\ActiveRoute::is_active('admin/projects') }}"><a href="{{ route('admin.projects') }}"><span class="fi-grid-three-up" title="projects" aria-hidden="true"></span> Manage projects</a></dd>--}}
                @if(\Auth::user()->hasRight(\App\Right::USER_MODIFY))
                <dd class="{{ \App\Helpers\ActiveRoute::is_active('admin/users') }}"><a href="{{ route('admin.users') }}"><span class="fi-people" title="users" aria-hidden="true"></span> Manage users</a></dd>
                @endif
                @if(\Auth::user()->hasRight(\App\Right::ROLE_MODIFY))
                <dd class="{{ \App\Helpers\ActiveRoute::is_active('admin/roles') }}"><a href="{{ route('admin.roles') }}"><span class="fi-brain" title="roles" aria-hidden="true"></span> Manage roles</a></dd>
                @endif
                @if(\Auth::user()->hasRight(\App\Right::RIGHT_CREATE))
                <dd class="{{ \App\Helpers\ActiveRoute::is_active('admin/rights') }}"><a href="{{ route('admin.rights') }}"><span class="fi-lock-locked" title="rights" aria-hidden="true"></span> Manage rights</a></dd>
                @endif
            </dl>
            @yield('content')
        </div>
    @stop