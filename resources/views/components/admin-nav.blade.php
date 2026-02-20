@php
    $links = [
        ['label' => 'Dashboard',     'route' => 'admin.dashboard',     'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0h4'],
        ['label' => 'Companies',     'route' => 'admin.companies',     'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
        ['label' => 'Talks',         'route' => 'admin.talks',         'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z'],
        ['label' => 'Events',        'route' => 'admin.events',        'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['label' => 'Board Members', 'route' => 'admin.board-members', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
        ['label' => 'Users',         'route' => 'admin.users',         'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
    ];
    $current = request()->route()?->getName() ?? '';
@endphp

<nav class="admin-nav">
    <div class="admin-nav-inner">
        <div class="admin-nav-brand">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            <span>Admin</span>
        </div>
        <div class="admin-nav-links">
            @foreach($links as $link)
                <a href="{{ route($link['route']) }}"
                   class="admin-nav-link {{ str_starts_with($current, $link['route']) ? 'active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $link['icon'] }}"/></svg>
                    <span>{{ $link['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</nav>

<style>
    .admin-nav {
        background: var(--gray-900);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        position: sticky;
        top: 80px;
        z-index: 40;
    }

    .admin-nav-inner {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 var(--spacing-6);
        display: flex;
        align-items: center;
        gap: var(--spacing-8);
    }

    .admin-nav-brand {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        padding: 0.875rem 0;
        flex-shrink: 0;
        opacity: 0.7;
    }

    .admin-nav-links {
        display: flex;
        gap: 0;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }

    .admin-nav-links::-webkit-scrollbar {
        display: none;
    }

    .admin-nav-link {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.875rem 1rem;
        font-size: 0.85rem;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.55);
        text-decoration: none;
        border-bottom: 2px solid transparent;
        white-space: nowrap;
        transition: color 0.15s, border-color 0.15s, background-color 0.15s;
    }

    .admin-nav-link:hover {
        color: rgba(255, 255, 255, 0.9);
        background: rgba(255, 255, 255, 0.05);
    }

    .admin-nav-link.active {
        color: white;
        border-bottom-color: var(--laravel-red);
    }

    .admin-nav-link svg {
        flex-shrink: 0;
        opacity: 0.8;
    }

    .admin-nav-link.active svg {
        opacity: 1;
    }

    @media (max-width: 768px) {
        .admin-nav-inner {
            gap: var(--spacing-4);
        }

        .admin-nav-brand span {
            display: none;
        }

        .admin-nav-link span {
            display: none;
        }

        .admin-nav-link {
            padding: 0.875rem 0.75rem;
        }

        .admin-nav-link svg {
            width: 18px;
            height: 18px;
        }
    }
</style>
