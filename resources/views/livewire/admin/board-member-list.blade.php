<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Admin: Board Members</h2>
            <p class="section-subtitle">Manage the board members displayed on the site.</p>
        </div>

        @if(session('message'))
            <div class="flash-message" style="max-width: 1000px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="card" style="max-width: 1000px; margin: 0 auto;">
            <div class="toolbar">
                <a href="{{ route('admin.board-members.create') }}" class="btn-create">+ New Member</a>
            </div>

            @if($boardMembers->isEmpty())
                <div class="empty-state">
                    <p>No board members yet.</p>
                </div>
            @else
                <div class="members-table-wrapper">
                    <table class="members-table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Company</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($boardMembers as $member)
                                <tr wire:key="member-{{ $member->id }}">
                                    <td class="order-cell">{{ $member->sort_order }}</td>
                                    <td class="photo-cell">
                                        @if($member->imageUrl())
                                            <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" width="40" height="40" class="member-thumb">
                                        @else
                                            <div class="member-thumb-placeholder"></div>
                                        @endif
                                    </td>
                                    <td class="member-name">{{ $member->name }}</td>
                                    <td>{{ $member->role }}</td>
                                    <td>{{ $member->company }}</td>
                                    <td class="action-cell">
                                        <a href="{{ route('admin.board-members.edit', $member) }}" class="review-link">Edit</a>
                                        <button wire:click="delete({{ $member->id }})"
                                            wire:confirm="Remove {{ $member->name }} from the board?"
                                            wire:loading.attr="disabled"
                                            wire:target="delete({{ $member->id }})"
                                            class="delete-btn">Delete</button>
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
        .page-container { display: flex; flex-direction: column; min-height: 100vh; }
        .main-content { flex: 1; }

        .toolbar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 1.5rem;
        }

        .btn-create {
            padding: 0.5rem 1rem;
            background-color: #FF2D20;
            color: white;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .btn-create:hover { background-color: #e0261b; }

        .members-table-wrapper { overflow-x: auto; }

        .members-table {
            width: 100%;
            border-collapse: collapse;
        }

        .members-table th,
        .members-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .members-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .members-table tbody tr:hover { background-color: var(--gray-50, #f9fafb); }
        .member-name { font-weight: 600; color: var(--gray-900); }
        .order-cell { color: var(--gray-500); font-size: 0.875rem; width: 60px; }
        .photo-cell { width: 60px; }
        .action-cell { white-space: nowrap; display: flex; gap: 0.75rem; align-items: center; }

        .member-thumb {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .member-thumb-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--gray-200);
        }

        .review-link {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }

        .review-link:hover { text-decoration: underline; }

        .delete-btn {
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            font-size: 0.875rem;
            padding: 0;
        }

        .delete-btn:hover { color: #dc3545; }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray-600);
        }

        .flash-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }
    </style>
</div>
