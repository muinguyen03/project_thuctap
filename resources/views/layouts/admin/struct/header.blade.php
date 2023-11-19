<?php
    use Illuminate\Support\Facades\Auth;
    $name = Auth::user()->name;
    $image = Auth::user()->image;
?>
<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle" style="margin-left: 10px"><i class="hamburger align-self-center"></i></a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                   data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>
                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                   data-bs-toggle="dropdown">
                    <img src="{{ $image }}" class="avatar img-fluid me-1" style="border-radius: 50%" alt="User image" /> <span class="text-dark">Hi, {{$name}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
{{--                    <a class="dropdown-item" href="{{route('client.profile')}}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>--}}
                    <a class="dropdown-item" href="{{ url('') }}"><i class="align-middle me-1" data-feather="arrow-left"></i> Return Home</a>
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>--}}
{{--                    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>--}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('auth.logout') }}"><i class="align-middle me-1" data-feather="log-out"></i> Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
