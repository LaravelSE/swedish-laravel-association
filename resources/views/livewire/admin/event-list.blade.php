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

    
</div>
