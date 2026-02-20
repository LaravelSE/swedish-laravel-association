<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Talks</h1>
                    <p class="admin-page-desc">Review and manage talk submissions.</p>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-filter-bar">
                        <label for="statusFilter" class="admin-filter-label">Status</label>
                        <select id="statusFilter" wire:model.live="statusFilter" class="admin-select">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="interested">Interested</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="done">Done</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                @if($talks->isEmpty())
                    <div class="admin-empty">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        <p>No talks found{{ $statusFilter ? ' with status "'.$statusFilter.'"' : '' }}.</p>
                    </div>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Speaker</th>
                                    <th>Cities</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($talks as $talk)
                                    <tr wire:key="admin-talk-{{ $talk->id }}">
                                        <td class="cell-primary">{{ $talk->title }}</td>
                                        <td>{{ $talk->user->name }}</td>
                                        <td>{{ implode(', ', $talk->cities) }}</td>
                                        <td>
                                            <span class="admin-badge admin-badge-{{ $talk->status }}">{{ ucfirst($talk->status) }}</span>
                                        </td>
                                        <td class="cell-muted">{{ $talk->created_at->format('Y-m-d') }}</td>
                                        <td class="cell-action">
                                            <a href="{{ route('admin.talks.review', $talk) }}" class="admin-link-btn">Review</a>
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
        .cell-action { text-align: right; }

        .admin-badge {
            display: inline-flex;
            padding: 0.2rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .admin-badge-pending { background: #fef3cd; color: #92400e; }
        .admin-badge-interested { background: #dbeafe; color: #1e40af; }
        .admin-badge-scheduled { background: #d1fae5; color: #065f46; }
        .admin-badge-done { background: var(--gray-100); color: var(--gray-600); }
        .admin-badge-rejected { background: #fee2e2; color: #991b1b; }

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
