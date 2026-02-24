<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Talks</h1>
            <p class="admin-page-desc">Review and manage talk submissions.</p>
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
                <label for="statusFilter">Filter by status:</label>
                <select id="statusFilter" wire:model.live="statusFilter" class="filter-select">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="interested">Interested</option>
                    <option value="scheduled">Scheduled</option>
                    <option value="done">Done</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            @if($talks->isEmpty())
                <div class="empty-state">
                    <p>No talks found{{ $statusFilter ? ' with status "'.$statusFilter.'"' : '' }}.</p>
                </div>
            @else
                <div class="talks-table-wrapper">
                    <table class="talks-table">
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
                                    <td class="talk-title">{{ $talk->title }}</td>
                                    <td>{{ $talk->user->name }}</td>
                                    <td>{{ implode(', ', $talk->cities) }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $talk->status }}">{{ ucfirst($talk->status) }}</span>
                                    </td>
                                    <td>{{ $talk->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.talks.review', $talk) }}" class="review-link">Review</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $talks->links() }}
            @endif
        </div>
    </div>

    <style>
        .admin-page {
            min-height: 100vh;
            background: var(--gray-50);
        }

        .admin-body {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-8) var(--spacing-6);
        }

        .admin-page-header {
            margin-bottom: var(--spacing-8);
        }

        .admin-page-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-950);
            letter-spacing: -0.03em;
            margin-bottom: 0.25rem;
        }

        .admin-page-desc {
            color: var(--gray-500);
            font-size: 0.9375rem;
        }

        .admin-page-desc a {
            color: var(--laravel-red);
            text-decoration: none;
        }

        .admin-page-desc a:hover {
            text-decoration: underline;
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

        .talks-table-wrapper {
            overflow-x: auto;
        }

        .talks-table {
            width: 100%;
            border-collapse: collapse;
        }

        .talks-table th,
        .talks-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .talks-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .talks-table tbody tr:hover {
            background-color: var(--gray-50, #f9fafb);
        }

        .talk-title {
            font-weight: 600;
            color: var(--gray-900);
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .status-pending {
            background-color: #fef3cd;
            color: #856404;
        }

        .status-interested {
            background-color: #e8f0fe;
            color: #1a56db;
        }

        .status-scheduled {
            background-color: #d4edda;
            color: #155724;
        }

        .status-done {
            background-color: var(--gray-100, #f3f4f6);
            color: var(--gray-600, #4b5563);
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .review-link {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }

        .review-link:hover {
            text-decoration: underline;
        }

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
