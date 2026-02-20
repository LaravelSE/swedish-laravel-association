<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Admin: Users</h2>
            <p class="section-subtitle">Manage user roles and access.</p>
        </div>

        @if(session('message'))
            <div class="flash-message flash-success" style="max-width: 1000px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message flash-error" style="max-width: 1000px; margin: 0 auto 1rem;">
                {{ session('error') }}
            </div>
        @endif

        <div class="card" style="max-width: 1000px; margin: 0 auto;">
            <div class="filter-bar">
                <label for="roleFilter">Filter by role:</label>
                <select id="roleFilter" wire:model.live="roleFilter" class="filter-select">
                    <option value="">All</option>
                    <option value="admin">Admins</option>
                    <option value="regular">Regular users</option>
                </select>
            </div>

            @if($users->isEmpty())
                <div class="empty-state">
                    <p>No users found{{ $roleFilter ? ' with this role' : '' }}.</p>
                </div>
            @else
                <div class="users-table-wrapper">
                    <table class="users-table">
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
                                    <td class="user-name">
                                        <a href="{{ route('admin.users.show', $user) }}" class="user-name-link">{{ $user->name }}</a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->isAdmin())
                                            <span class="role-badge role-admin">Admin</span>
                                        @else
                                            <span class="role-badge role-user">User</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="action-cell">
                                        @if($user->isAdmin())
                                            @if($user->id !== auth()->id())
                                                <button
                                                    wire:click="demoteFromAdmin({{ $user->id }})"
                                                    wire:confirm="Remove admin access from {{ $user->name }}?"
                                                    wire:loading.attr="disabled"
                                                    wire:target="demoteFromAdmin({{ $user->id }})"
                                                    class="action-btn action-btn-demote"
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
                                                class="action-btn action-btn-promote"
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
    </section>

    @livewire('footer')

    <style>
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .filter-bar {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .filter-bar label {
            font-weight: 500;
            white-space: nowrap;
            margin-bottom: 0;
        }

        .filter-select {
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            appearance: auto;
        }

        .filter-select:focus {
            border-color: #FF2D20;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 32, 0.25);
        }

        .users-table-wrapper {
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th,
        .users-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .users-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .users-table tbody tr:hover {
            background-color: var(--gray-50, #f9fafb);
        }

        .user-name {
            font-weight: 600;
            color: var(--gray-900);
        }

        .user-name-link {
            color: inherit;
            text-decoration: none;
        }

        .user-name-link:hover { text-decoration: underline; color: #FF2D20; }

        .role-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .role-admin {
            background-color: #e8f0fe;
            color: #1a56db;
        }

        .role-user {
            background-color: var(--gray-100, #f3f4f6);
            color: var(--gray-600, #4b5563);
        }

        .action-cell {
            white-space: nowrap;
        }

        .action-btn {
            padding: 0.375rem 0.875rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background-color 0.15s;
        }

        .action-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .action-btn-promote {
            background-color: #e8f0fe;
            color: #1a56db;
        }

        .action-btn-promote:hover:not(:disabled) {
            background-color: #d0e0fd;
        }

        .action-btn-demote {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-btn-demote:hover:not(:disabled) {
            background-color: #f1c0c5;
        }

        .you-badge {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--gray-400, #9ca3af);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray-600);
        }

        .flash-message {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .flash-success {
            background-color: #d4edda;
            color: #155724;
        }

        .flash-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</div>
