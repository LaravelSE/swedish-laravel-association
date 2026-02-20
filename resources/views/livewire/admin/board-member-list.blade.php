<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Board Members</h1>
                    <p class="admin-page-desc">Manage the board members displayed on the site.</p>
                </div>
                <a href="{{ route('admin.board-members.create') }}" class="admin-btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14m-7-7h14"/></svg>
                    New Member
                </a>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="admin-card">
                @if($boardMembers->isEmpty())
                    <div class="admin-empty">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <p>No board members yet.</p>
                    </div>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th class="col-order">Order</th>
                                    <th class="col-photo">Photo</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Company</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($boardMembers as $member)
                                    <tr wire:key="member-{{ $member->id }}">
                                        <td class="cell-muted">{{ $member->sort_order }}</td>
                                        <td class="col-photo">
                                            @if($member->imageUrl())
                                                <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" width="36" height="36" class="member-thumb">
                                            @else
                                                <div class="member-thumb-placeholder">
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="cell-primary">{{ $member->name }}</td>
                                        <td>{{ $member->role }}</td>
                                        <td>{{ $member->company }}</td>
                                        <td class="cell-action">
                                            <div class="action-group">
                                                <a href="{{ route('admin.board-members.edit', $member) }}" class="admin-link-btn">Edit</a>
                                                <button wire:click="delete({{ $member->id }})"
                                                    wire:confirm="Remove {{ $member->name }} from the board?"
                                                    wire:loading.attr="disabled"
                                                    wire:target="delete({{ $member->id }})"
                                                    class="admin-delete-btn">Delete</button>
                                            </div>
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
            gap: 1rem;
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

        .admin-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.625rem 1.25rem;
            background: var(--laravel-red);
            color: white;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: var(--border-radius);
            text-decoration: none;
            transition: background-color 0.15s, transform 0.1s;
            flex-shrink: 0;
        }

        .admin-btn-primary:hover {
            background: var(--laravel-red-dark);
            transform: translateY(-1px);
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

        .admin-flash-success { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }

        .admin-card {
            background: white;
            border-radius: var(--border-radius-xl);
            border: 1px solid var(--gray-200);
            overflow: hidden;
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
            vertical-align: middle;
        }

        .admin-table tbody tr:last-child td { border-bottom: none; }
        .admin-table tbody tr { transition: background-color 0.1s; }
        .admin-table tbody tr:hover { background-color: var(--gray-50); }

        .col-order { width: 60px; }
        .col-photo { width: 60px; }
        .cell-primary { font-weight: 600; color: var(--gray-900); }
        .cell-muted { color: var(--gray-400); font-size: 0.875rem; }
        .cell-action { text-align: right; }

        .member-thumb {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .member-thumb-placeholder {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--gray-100);
            color: var(--gray-400);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .admin-link-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--laravel-red);
            background: rgba(255, 45, 32, 0.06);
            border-radius: var(--border-radius-sm);
            text-decoration: none;
            transition: background-color 0.15s;
        }

        .admin-link-btn:hover { background: rgba(255, 45, 32, 0.12); }

        .admin-delete-btn {
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 0.375rem 0.5rem;
            transition: color 0.15s;
        }

        .admin-delete-btn:hover { color: #dc2626; }

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
