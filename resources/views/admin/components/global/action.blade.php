<?php
use Illuminate\Support\Str;
?>
<div class="d-flex justify-content-between mb-3">
    @component('admin.components.breadcrumb')
        @slot('title')
            {{ ucfirst($module) }} {{ Str::contains(request()->url(), 'create') ? 'Create' : '' }} {{ Str::contains(request()->url(), 'edit') ? 'Edit' : '' }}
        @endslot
    @endcomponent
    @component('admin.components.button.back')
        @slot('url')
            {{ $module }}
        @endslot
    @endcomponent
</div>
