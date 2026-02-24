@php
    $links = [
        ['label' => 'Dashboard',     'route' => 'admin.dashboard'],
        ['label' => 'Companies',     'route' => 'admin.companies'],
        ['label' => 'Talks',         'route' => 'admin.talks'],
        ['label' => 'Events',        'route' => 'admin.events'],
        ['label' => 'Board Members', 'route' => 'admin.board-members'],
        ['label' => 'Users',         'route' => 'admin.users'],
    ];
    $current = request()->route()?->getName() ?? '';
@endphp

<header class="admin-header">
    <div class="admin-header-inner">
        <div class="admin-header-left">
            <a href="{{ route('home') }}" class="admin-logo">
                <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" width="28" height="28">
                <span class="admin-logo-text">Laravel Sweden</span>
            </a>
            <span class="admin-badge">Admin</span>
        </div>
        <div class="admin-header-right">
            <a href="{{ route('home') }}" class="admin-back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to site
            </a>
        </div>
    </div>
</header>

<nav class="admin-subnav">
    <div class="admin-subnav-inner">
        @foreach($links as $link)
            <a href="{{ route($link['route']) }}"
               class="admin-subnav-link {{ str_starts_with($current, $link['route']) ? 'active' : '' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>
</nav>
