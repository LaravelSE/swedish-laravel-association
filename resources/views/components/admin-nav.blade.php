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
    .admin-subnav {
        background: white;
        border-bottom: 1px solid var(--gray-200);
    }

    .admin-subnav-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 var(--spacing-6);
        display: flex;
        gap: 0;
        overflow-x: auto;
    }

    .admin-subnav-link {
        display: inline-block;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-600);
        text-decoration: none;
        border-bottom: 2px solid transparent;
        white-space: nowrap;
        transition: color 0.15s, border-color 0.15s;
    }

    .admin-subnav-link:hover {
        color: var(--laravel-red);
    }

    .admin-subnav-link.active {
        color: var(--laravel-red);
        border-bottom-color: var(--laravel-red);
        font-weight: 600;
    }
</style>
