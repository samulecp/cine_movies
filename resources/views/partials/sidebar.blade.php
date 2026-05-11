@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@php
    $dashboardUrl = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home');
    $dashboardUrl = config('adminlte.use_route_url', false)
        ? ($dashboardUrl ? route($dashboardUrl) : '')
        : ($dashboardUrl ? url($dashboardUrl) : '');
    $currentRole = optional(auth()->user())->role;
    $hiddenRoutesForCashier = ['admin.dashboard', 'usuario.index', 'bitacora.index', 'clienteVirtual.index', 'cajero.index'];
    $hiddenHrefSegmentsForCashier = ['/admin/dashboard', '/usuario', '/bitacora', '/clienteVirtual', '/cajero'];

    $filterMenuItems = function (array $items) use (&$filterMenuItems, $currentRole, $hiddenRoutesForCashier, $hiddenHrefSegmentsForCashier) {
        $filtered = [];

        foreach ($items as $item) {
            if (is_string($item)) {
                $filtered[] = $item;
                continue;
            }

            if (!is_array($item)) {
                continue;
            }

            if ($currentRole === 'tra') {
                $routeName = $item['route'] ?? null;
                $href = $item['href'] ?? null;

                $isHiddenByRoute = is_string($routeName) && in_array($routeName, $hiddenRoutesForCashier, true);
                $isHiddenByHref = is_string($href) && collect($hiddenHrefSegmentsForCashier)->contains(fn ($segment) => str_contains($href, $segment));

                if ($isHiddenByRoute || $isHiddenByHref) {
                    continue;
                }
            }

            if (isset($item['submenu']) && is_array($item['submenu'])) {
                $item['submenu'] = $filterMenuItems($item['submenu']);

                if (empty($item['submenu'])) {
                    continue;
                }
            }

            $filtered[] = $item;
        }

        return $filtered;
    };

    $menuItems = $filterMenuItems($adminlte->menu('sidebar'));
@endphp

<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    <a href="{{ $dashboardUrl }}"
       @if($layoutHelper->isLayoutTopnavEnabled())
           class="navbar-brand {{ config('adminlte.logo_img_xl') ? 'logo-switch ' : '' }}{{ config('adminlte.classes_brand') }}"
       @else
           class="brand-link {{ config('adminlte.logo_img_xl') ? 'logo-switch ' : '' }}{{ config('adminlte.classes_brand') }}"
       @endif>

        @if(config('adminlte.logo_img_xl'))
            <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
                 alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
                 class="{{ config('adminlte.logo_img_class', 'brand-image-xl') }} logo-xs">

            <img src="{{ asset(config('adminlte.logo_img_xl')) }}"
                 alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
                 class="{{ config('adminlte.logo_img_xl_class', 'brand-image-xs') }} logo-xl">
        @else
            <img src="{{ asset(config('adminlte.logo_img', 'vendor/adminlte/dist/img/AdminLTELogo.png')) }}"
                 alt="{{ config('adminlte.logo_img_alt', 'AdminLTE') }}"
                 class="{{ config('adminlte.logo_img_class', 'brand-image img-circle elevation-3') }}"
                 style="opacity:.8">

            <span class="brand-text font-weight-light {{ config('adminlte.classes_brand_text') }}">
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
            </span>
        @endif

    </a>

    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>

                @foreach($menuItems as $item)
                    @if(is_string($item) || isset($item['header']))
                        <li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-header {{ $item['class'] ?? '' }}">
                            {{ is_string($item) ? $item : $item['header'] }}
                        </li>
                    @elseif(($item['type'] ?? null) === 'sidebar-menu-search')
                        <li>
                            <div class="form-inline my-2">
                                <div class="input-group" data-widget="sidebar-search" data-arrow-sign="&raquo;">
                                    <input class="form-control form-control-sidebar" type="search"
                                        @isset($item['id']) id="{{ $item['id'] }}" @endisset
                                        placeholder="{{ $item['text'] ?? 'Search' }}"
                                        aria-label="{{ $item['text'] ?? 'Search' }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar">
                                            <i class="fas fa-fw fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @elseif(isset($item['submenu']) && is_array($item['submenu']))
                        <li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item has-treeview {{ $item['submenu_class'] ?? '' }}">
                            <a class="nav-link {{ $item['class'] ?? '' }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
                               href="" {!! $item['data-compiled'] ?? '' !!}>
                                <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-'.$item['icon_color'] : '' }}"></i>
                                <p>
                                    {{ $item['text'] ?? '' }}
                                    <i class="fas fa-angle-left right"></i>
                                    @isset($item['label'])
                                        <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">{{ $item['label'] }}</span>
                                    @endisset
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @foreach($item['submenu'] as $subitem)
                                    @if(is_string($subitem) || isset($subitem['header']))
                                        <li @isset($subitem['id']) id="{{ $subitem['id'] }}" @endisset class="nav-header {{ $subitem['class'] ?? '' }}">
                                            {{ is_string($subitem) ? $subitem : $subitem['header'] }}
                                        </li>
                                    @else
                                        <li @isset($subitem['id']) id="{{ $subitem['id'] }}" @endisset class="nav-item">
                                            <a class="nav-link {{ $subitem['class'] ?? '' }} @isset($subitem['shift']) {{ $subitem['shift'] }} @endisset"
                                               href="{{ $subitem['href'] ?? '#' }}"
                                               @isset($subitem['target']) target="{{ $subitem['target'] }}" @endisset
                                               {!! $subitem['data-compiled'] ?? '' !!}>
                                                <i class="{{ $subitem['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($subitem['icon_color']) ? 'text-'.$subitem['icon_color'] : '' }}"></i>
                                                <p>
                                                    {{ $subitem['text'] ?? '' }}
                                                    @isset($subitem['label'])
                                                        <span class="badge badge-{{ $subitem['label_color'] ?? 'primary' }} right">{{ $subitem['label'] }}</span>
                                                    @endisset
                                                </p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">
                            <a class="nav-link {{ $item['class'] ?? '' }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
                               href="{{ $item['href'] ?? '#' }}"
                               @isset($item['target']) target="{{ $item['target'] }}" @endisset
                               {!! $item['data-compiled'] ?? '' !!}>
                                <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{ isset($item['icon_color']) ? 'text-'.$item['icon_color'] : '' }}"></i>
                                <p>
                                    {{ $item['text'] ?? '' }}
                                    @isset($item['label'])
                                        <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">{{ $item['label'] }}</span>
                                    @endisset
                                </p>
                            </a>
                        </li>

                        
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>

</aside>
