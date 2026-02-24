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

    
</div>
