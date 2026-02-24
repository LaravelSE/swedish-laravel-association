<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Events</h1>
            <p class="admin-page-desc">Manage meetup events.</p>
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
                <label for="timeFilter">Show:</label>
                <select id="timeFilter" wire:model.live="timeFilter" class="filter-select">
                    <option value="upcoming">Upcoming</option>
                    <option value="past">Past</option>
                    <option value="">All</option>
                </select>

                <a href="{{ route('admin.events.create') }}" class="btn-create">+ New Event</a>
            </div>

            @if($events->isEmpty())
                <div class="empty-state">
                    <p>No {{ $timeFilter ?: '' }} events found.</p>
                </div>
            @else
                <div class="events-table-wrapper">
                    <table class="events-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr wire:key="admin-event-{{ $event->id }}">
                                    <td class="event-title">{{ $event->title }}</td>
                                    <td>{{ $event->datetime->format('Y-m-d H:i') }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td class="action-cell">
                                        <a href="{{ route('admin.events.edit', $event) }}" class="review-link">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $events->links() }}
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

        .btn-create {
            margin-left: auto;
            padding: 0.5rem 1rem;
            background-color: #FF2D20;
            color: white;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .btn-create:hover { background-color: #e0261b; }

        .events-table-wrapper { overflow-x: auto; }

        .events-table {
            width: 100%;
            border-collapse: collapse;
        }

        .events-table th,
        .events-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
        }

        .events-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .events-table tbody tr:hover { background-color: var(--gray-50, #f9fafb); }
        .event-title { font-weight: 600; color: var(--gray-900); }
        .action-cell { white-space: nowrap; }

        .review-link {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }

        .review-link:hover { text-decoration: underline; }

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
