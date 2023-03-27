@php
    $links = [
        [
            'href' => 'dashboard',
            'text' => 'Dashboard',
            'is_multi' => false,
            // 'role' => ['Guru'],
        ],
        [
            'href' => [
                [
                    'section_text' => 'SKP',
                    'section_icon' => 'fa-book',
                    'section_list' => [
                        ['href' => 'skp.index', 'text' => 'Daftar SKP'],
                        // ['href' => 'user.show', 'text' => '']
                    ],
                ],
            ],
            'text' => 'SKP',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Penilaian Perilaku',
                    'section_icon' => 'fa-file-lines',
                    'section_list' => [
                        ['href' => 'penilaian-perilaku.index', 'text' => 'Daftar Penilaian Perilaku'],
                        // ['href' => 'user.show', 'text' => '']
                    ],
                ],
            ],
            'text' => 'Penilaian Perilaku',
            'is_multi' => true,
        ],
        [
            'href' => [
                [
                    'section_text' => 'Pengguna',
                    'section_icon' => 'fa-user',
                    'section_list' => [
                        ['href' => 'users.index', 'text' => 'Daftar Pengguna'],
                    ],
                ],
                [
                    'section_text' => 'Pejabat Penilai',
                    'section_icon' => 'fa-user-tie',
                    'section_list' => [
                        ['href' => 'pejabat-penilai.index', 'text' => 'Daftar Pejabat Penilai'],
                    ],
                ],
            ],
            'text' => 'Menu',
            'is_multi' => true,
            'role' => ['Operator'],
        ],
    ];
    $navigation_links = array_to_object($links);
@endphp

<!-- Sidebar outter -->
<div class="main-sidebar">
    <!-- sidebar wrapper -->
    <aside id="sidebar-wrapper">
        <!-- sidebar brand -->
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}">SMA NEGERI 2 SIDRAP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/app_logobg.png') }}" alt="" srcset="">
            </a>
        </div>
        @foreach ($navigation_links as $link)
            @if (isset($link->role))
                @canany($link->role)
                    <ul class="sidebar-menu">
                        <li class="menu-header">{{ $link->text }}</li>
                        @if (!$link->is_multi)
                            @if (isset($link->role))
                                @canany($link->role)
                                    <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route($link->href) }}"><i
                                                class="fas fa-fire"></i><span>{{ $link->text }}</span></a>
                                    </li>
                                @endcan
                            @else
                                <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route($link->href) }}"><i
                                            class="fas fa-fire"></i><span>{{ $link->text }}</span></a>
                                </li>
                            @endif
                        @else
                            @foreach ($link->href as $section)
                                @php
                                    $routes = collect($section->section_list)
                                        ->map(function ($child) {
                                            return Request::routeIs($child->href);
                                        })
                                        ->toArray();
                                    
                                    $is_active = in_array(true, $routes);
                                @endphp
                                @if (isset($section->role))
                                    @canany($section->role)
                                        <li class="dropdown {{ $is_active ? 'active' : '' }}">
                                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                                    class="fas {{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                                            <ul class="dropdown-menu">
                                                @foreach ($section->section_list as $child)
                                                    @if (isset($child->role))
                                                        @canany($child->role)
                                                            <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                                    class="nav-link"
                                                                    href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                        @endcan
                                                    @else
                                                        <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                                class="nav-link"
                                                                href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endcan
                                @else
                                    <li class="dropdown {{ $is_active ? 'active' : '' }}">
                                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                                class="fas {{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                                        <ul class="dropdown-menu">
                                            @foreach ($section->section_list as $child)
                                                @if (isset($child->role))
                                                    @canany($child->role)
                                                        <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                                class="nav-link"
                                                                href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                    @endcan
                                                @else
                                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                            class="nav-link"
                                                            href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                @endcan
            @else
                <ul class="sidebar-menu">
                    <li class="menu-header">{{ $link->text }}</li>
                    @if (!$link->is_multi)
                        @if (isset($link->role))
                            @canany($link->role)
                                <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route($link->href) }}"><i
                                            class="fas fa-fire"></i><span>{{ $link->text }}</span></a>
                                </li>
                            @endcan
                        @else
                            <li class="{{ Request::routeIs($link->href) ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route($link->href) }}"><i
                                        class="fas fa-fire"></i><span>{{ $link->text }}</span></a>
                            </li>
                        @endif
                    @else
                        @foreach ($link->href as $section)
                            @php
                                $routes = collect($section->section_list)
                                    ->map(function ($child) {
                                        return Request::routeIs($child->href);
                                    })
                                    ->toArray();
                                
                                $is_active = in_array(true, $routes);
                            @endphp
                            @if (isset($section->role))
                                @canany($section->role)
                                    <li class="dropdown {{ $is_active ? 'active' : '' }}">
                                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                                class="fas {{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                                        <ul class="dropdown-menu">
                                            @foreach ($section->section_list as $child)
                                                @if (isset($child->role))
                                                    @canany($child->role)
                                                        <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                                class="nav-link"
                                                                href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                    @endcan
                                                @else
                                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                            class="nav-link"
                                                            href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endcan
                            @else
                                <li class="dropdown {{ $is_active ? 'active' : '' }}">
                                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                            class="fas {{ $section->section_icon }}"></i> <span>{{ $section->section_text }}</span></a>
                                    <ul class="dropdown-menu">
                                        @foreach ($section->section_list as $child)
                                            @if (isset($child->role))
                                                @canany($child->role)
                                                    <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                            class="nav-link"
                                                            href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                                @endcan
                                            @else
                                                <li class="{{ Request::routeIs($child->href) ? 'active' : '' }}"><a
                                                        class="nav-link"
                                                        href="{{ route($child->href) }}">{{ $child->text }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    @endif
                </ul>
            @endif
        @endforeach
    </aside>
</div>
