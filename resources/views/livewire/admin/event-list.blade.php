<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Events</h1>
                    <p class="admin-page-desc">Manage meetup events.</p>
                </div>
                <a href="{{ route('admin.events.create') }}" class="admin-btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14m-7-7h14"/></svg>
                    New Event
                </a>
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
                        <label for="timeFilter" class="admin-filter-label">Show</label>
                        <select id="timeFilter" wire:model.live="timeFilter" class="admin-select">
                            <option value="upcoming">Upcoming</option>
                            <option value="past">Past</option>
                            <option value="">All</option>
                        </select>
                    </div>
                </div>

                @if($events->isEmpty())
                    <div class="admin-empty">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p>No {{ $timeFilter ?: '' }} events found.</p>
                    </div>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
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
                                        <td class="cell-primary">{{ $event->title }}</td>
                                        <td>{{ $event->datetime->format('Y-m-d H:i') }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td class="cell-action">
                                            <a href="{{ route('admin.events.edit', $event) }}" class="admin-link-btn">Edit</a>
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
        .cell-action { text-align: right; }

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
