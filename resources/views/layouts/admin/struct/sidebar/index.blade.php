@php
    $listItem = [
        [ 'title' => 'Home',        'url' => '',            'icon'  => 'home'       ],
    ];
    if(checkRoleAdmin()){
        $listItem[] = [ 'title' => 'Banner',      'url' => 'banners',     'icon'  => 'image'      ];
        $listItem[] = [ 'title' => 'Category',    'url' => 'categories',  'icon'  => 'aperture'   ];
        $listItem[] = [ 'title' => 'Product',     'url' => 'products',    'icon'  => 'box'        ];
        $listItem[] = [ 'title' => 'User',        'url' => 'users',       'icon'  => 'user'       ];
        $listItem[] = [ 'title' => 'Promotion',   'url' => 'promotions',  'icon'  => 'briefcase'  ];
    }
    $listItem[] = [ 'title' => 'Orders',      'url' => 'orders',      'icon'  => 'list'       ];
@endphp
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('home') }}">
            <span class="align-middle">Coza Admin</span>
        </a>
        <ul class="sidebar-nav">
            @foreach($listItem as $item)
                @component('layouts.admin.struct.sidebar.item')
                    @slot('url') {{ $item['url'] }} @endslot
                    @slot('icon') {{ $item['icon'] }} @endslot
                    @slot('title') {{ $item['title'] }} @endslot
                @endcomponent
            @endforeach
        </ul>
    </div>
</nav>
