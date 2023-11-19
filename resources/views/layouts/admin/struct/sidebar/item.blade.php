@if(isset($url) && isset($icon) && isset($title))
    <li class="sidebar-item {{ request()->is('admin/'.$url) || request()->is('admin/'.$url.'/create') || request()->is('admin/'.$url.'/edit') ? 'active' : ''}}">
        <a class="sidebar-link" href="{{ url('admin/'.$url) }}">
            <i class="align-middle" data-feather="{{ $icon }}"></i> <span class="align-middle">{{ $title }}</span>
        </a>
    </li>
@endif
