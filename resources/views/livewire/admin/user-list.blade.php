<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Users</h1>
                    <p class="admin-page-desc">Manage user roles and access.</p>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            @if(session('error'))
                <div class="admin-flash admin-flash-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-filter-bar">
                        <label for="roleFilter" class="admin-filter-label">Role</label>
                        <select id="roleFilter" wire:model.live="roleFilter" class="admin-select">
                            <option value="">All</option>
                            <option value="admin">Admins</option>
                            <option value="regular">Regular users</option>
                        </select>
                    </div>
                </div>

                @if($users->isEmpty())
                    <div class="admin-empty">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        <p>No users found{{ $roleFilter ? ' with this role' : '' }}.</p>
                    </div>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr wire:key="user-{{ $user->id }}">
                                        <td class="cell-primary">
                                            <a href="{{ route('admin.users.show', $user) }}" class="user-name-link">{{ $user->name }}</a>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->isAdmin())
                                                <span class="admin-badge admin-badge-admin">Admin</span>
                                            @else
                                                <span class="admin-badge admin-badge-user">User</span>
                                            @endif
                                        </td>
                                        <td class="cell-muted">{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td class="cell-action">
                                            @if($user->isAdmin())
                                                @if($user->id !== auth()->id())
                                                    <button
                                                        wire:click="demoteFromAdmin({{ $user->id }})"
                                                        wire:confirm="Remove admin access from {{ $user->name }}?"
                                                        wire:loading.attr="disabled"
                                                        wire:target="demoteFromAdmin({{ $user->id }})"
                                                        class="admin-action-btn admin-action-btn-demote"
                                                    >
                                                        <span wire:loading.remove wire:target="demoteFromAdmin({{ $user->id }})">Remove admin</span>
                                                        <span wire:loading wire:target="demoteFromAdmin({{ $user->id }})">Saving...</span>
                                                    </button>
                                                @else
                                                    <span class="you-badge">You</span>
                                                @endif
                                            @else
                                                <button
                                                    wire:click="promoteToAdmin({{ $user->id }})"
                                                    wire:confirm="Grant admin access to {{ $user->name }}?"
                                                    wire:loading.attr="disabled"
                                                    wire:target="promoteToAdmin({{ $user->id }})"
                                                    class="admin-action-btn admin-action-btn-promote"
                                                >
                                                    <span wire:loading.remove wire:target="promoteToAdmin({{ $user->id }})">Make admin</span>
                                                    <span wire:loading wire:target="promoteToAdmin({{ $user->id }})">Saving...</span>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @livewire('footer')

    <style>
        .page-container { display: flex; flex-direction: column; min-height: 100vh; }

        .admin-content {
            flex: 1;
            background: var(--gray-50);
            padding: 2rem 1.5rem 4rem;
        }

        .admin-content-inner { max-width: 1400px; margin: 0 auto; }

        .admin-page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .admin-page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-900);
            margin: 0 0 0.25rem;
            letter-spacing: -0.025em;
        }

        .admin-page-desc {
            font-size: 0.95rem;
            color: var(--gray-500);
            margin: 0;
        }

        .admin-flash {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.25rem;
            border-radius: var(--border-radius-lg);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .admin-flash-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .admin-flash-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .admin-card {
            background: white;
            border-radius: var(--border-radius-xl);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .admin-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .admin-filter-bar {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-filter-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .admin-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-sm);
            background: white;
            color: var(--gray-700);
            font-weight: 500;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .admin-select:focus {
            border-color: var(--laravel-red);
            box-shadow: 0 0 0 3px rgba(255, 45, 32, 0.1);
        }

        .admin-table-wrap { overflow-x: auto; }

        .admin-table { width: 100%; border-collapse: collapse; }

        .admin-table th {
            padding: 0.75rem 1.5rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        .admin-table td {
            padding: 0.875rem 1.5rem;
            text-align: left;
            font-size: 0.9rem;
            color: var(--gray-600);
            border-bottom: 1px solid var(--gray-100);
        }

        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr { transition: background-color 0.1s; }
        .admin-table tbody tr:hover { background-color: var(--gray-50); }

        .cell-primary { font-weight: 600; color: var(--gray-900); }
        .cell-muted { color: var(--gray-400); }
        .cell-action { text-align: right; white-space: nowrap; }

        .user-name-link {
            color: inherit;
            text-decoration: none;
            transition: color 0.15s;
        }

        .user-name-link:hover { color: var(--laravel-red); text-decoration: underline; }

        .admin-badge {
            display: inline-flex;
            padding: 0.2rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .admin-badge-admin { background: #dbeafe; color: #1e40af; }
        .admin-badge-user { background: var(--gray-100); color: var(--gray-600); }

        .admin-action-btn {
            padding: 0.375rem 0.875rem;
            border-radius: var(--border-radius-sm);
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }

        .admin-action-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        .admin-action-btn-promote {
            background: rgba(37, 99, 235, 0.08);
            color: #1e40af;
        }

        .admin-action-btn-promote:hover:not(:disabled) { background: rgba(37, 99, 235, 0.15); }

        .admin-action-btn-demote {
            background: rgba(220, 38, 38, 0.06);
            color: #dc2626;
        }

        .admin-action-btn-demote:hover:not(:disabled) { background: rgba(220, 38, 38, 0.12); }

        .you-badge {
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .admin-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            padding: 4rem 1rem;
            color: var(--gray-400);
        }

        .admin-empty p { margin: 0; font-size: 0.95rem; }
    </style>
</div>
