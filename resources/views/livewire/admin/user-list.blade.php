<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Users</h1>
            <p class="admin-page-desc">Manage user roles and access.</p>
        </div>

        @if(session('message'))
            <div class="flash-message flash-success">
                {{ session('message') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message flash-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
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

                {{ $users->links() }}
            @endif
        </div>
    </div>

    
</div>
