<?php
    use Illuminate\Support\Str;
?>
<style>
    #tab_content {
        background: transparent !important;
    }
</style>
<div class="row mb-3">
    <div class="col-12 col-lg-4">@component('admin.components.breadcrumb')
            @slot('title')
                {{ ucfirst($module) }} {{ Str::contains(request()->url(), 'trash') ? 'Trash' : '' }}
            @endslot
        @endcomponent</div>
    <div class="col-12 col-lg-4"></div>
    <div class="col-12 col-lg-4 d-flex justify-content-start justify-content-lg-end">
        @if(!request()->is('admin/banners') && !request()->is('admin/trash/banners'))
            <form action="{{ request()->url() }}" class="w-100 d-flex align-items-center justify-content-between">
                <input type="text" class="form-control" name="q" placeholder="search ..." value="{{ request()->query('q') != null ? request()->query('q')  : ''}}">&nbsp;
                @if(request()->query('q'))
                    @if(request()->query('q') != null || request()->query('q') != '')
                        <a href="{{ route($module.'.index') }}" class="btn btn-secondary"><i class="fa-solid fa-x"></i></a>
                    @endif
                @else
                    <button class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                @endif
            </form>
        @endif
    </div>
</div>
<div class="row align-items-center mb-4">
    <div class="col-12 col-lg-4 ">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Str::contains(request()->url(), 'trash') ? '' : 'active' }}" id="tab_content" href="{{ route($module.'.index') }}">List ({{ $countList }})</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Str::contains(request()->url(), 'trash') ? 'active' : '' }}" id="tab_content" href="{{ route($module.'.trash') }}">Trash ({{ $countTrash }})</a>
            </li>
        </ul>
    </div>
    <div class="col-12 col-lg-4">

    </div>
    <div class="col-12 col-lg-4 mt-4 d-flex justify-content-start justify-content-lg-end">
        @if ($countTrash > 0)
            @if(Str::contains(request()->url(), 'trash'))
                @component('admin.components.button.delete-all')
                    @slot('url')
                        {{ route($module.'.delete.all') }}
                    @endslot
                @endcomponent
            @endif
            &emsp;
        @endif
        @component('admin.components.button.add')
            @slot('url')
                {{ route($module.'.create') }}
            @endslot
            @slot('module')
                {{ $module }}
            @endslot
        @endcomponent
    </div>
</div>
