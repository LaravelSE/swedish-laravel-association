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

<style>
    .admin-header {
        background: var(--gray-950);
        border-bottom: 1px solid var(--gray-800);
    }

    .admin-header-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 var(--spacing-6);
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 56px;
    }

    .admin-header-left {
        display: flex;
        align-items: center;
        gap: var(--spacing-3);
    }

    .admin-logo {
        display: flex;
        align-items: center;
        gap: var(--spacing-2);
        text-decoration: none;
    }

    .admin-logo img {
        width: 28px;
        height: 28px;
        border-radius: 6px;
    }

    .admin-logo-text {
        font-family: 'Syne', sans-serif;
        font-size: 0.95rem;
        font-weight: 700;
        color: white;
        letter-spacing: -0.02em;
    }

    .admin-badge {
        font-family: 'Syne', sans-serif;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: white;
        background: var(--laravel-red);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }

    .admin-header-right {
        display: flex;
        align-items: center;
    }

    .admin-back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        color: var(--gray-400);
        text-decoration: none;
        font-size: 0.8125rem;
        font-weight: 500;
        transition: color 0.15s;
    }

    .admin-back-link:hover {
        color: white;
    }

    .admin-subnav {
        background: var(--gray-900);
        border-bottom: 1px solid var(--gray-800);
    }

    .admin-subnav-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 var(--spacing-6);
        display: flex;
        align-items: center;
        gap: 0;
        overflow-x: auto;
    }

    .admin-subnav-link {
        display: inline-block;
        padding: 0.75rem 1rem;
        font-size: 0.8125rem;
        font-weight: 500;
        color: var(--gray-400);
        text-decoration: none;
        border-bottom: 2px solid transparent;
        white-space: nowrap;
        transition: color 0.15s, border-color 0.15s;
    }

    .admin-subnav-link:hover {
        color: white;
    }

    .admin-subnav-link.active {
        color: white;
        border-bottom-color: var(--laravel-red);
        font-weight: 600;
    }
</style>
