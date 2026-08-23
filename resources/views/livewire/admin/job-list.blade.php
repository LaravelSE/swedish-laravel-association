<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Jobs</h1>
            <p class="admin-page-desc">Review LinkedIn job postings. Approving posts the job to Slack. {{ $pendingCount }} pending.</p>
        </div>

        @if (session('message'))
            <div class="flash-banner">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="filter-bar">
                <label for="statusFilter">Filter by status:</label>
                <select id="statusFilter" wire:model.live="statusFilter" class="filter-select" wire:loading.attr="disabled">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                <span class="muted" wire:loading>Updating…</span>
            </div>

            @if($jobs->isEmpty())
                <div class="empty-state">
                    <p>No jobs found{{ $statusFilter ? ' with status "'.$statusFilter.'"' : '' }}.</p>
                </div>
            @else
                <div class="companies-table-wrapper">
                    <table class="companies-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Company</th>
                                <th>Location</th>
                                <th>Search</th>
                                <th>Posted</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr wire:key="admin-job-{{ $job->id }}">
                                    <td class="company-name">
                                        <a href="{{ $job->url }}" target="_blank" rel="noopener" class="review-link">{{ $job->title }}</a>
                                    </td>
                                    <td>{{ $job->company_name }}</td>
                                    <td>{{ $job->short_location }}</td>
                                    <td class="muted">{{ $job->keyword }}</td>
                                    <td class="muted">{{ optional($job->posted_date)->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $job->status }}">{{ ucfirst($job->status) }}</span>
                                        @if($job->company_id)
                                            <span class="status-badge status-approved" title="Linked to company listing">In listing</span>
                                        @endif
                                        @if($job->status !== 'pending' && $job->last_reviewer)
                                            <div class="muted reviewer-note">by {{ $job->last_reviewer }}</div>
                                        @endif
                                    </td>
                                    <td class="actions-cell">
                                        <div class="row-actions" x-data="{ open: false }" @click.outside="open = false">
                                            <button type="button" class="btn-dots" @click="open = !open" aria-haspopup="true" :aria-expanded="open" aria-label="Actions">&hellip;</button>
                                            <div class="actions-menu" x-show="open" x-cloak @click="open = false">
                                                @if($job->status !== 'approved')
                                                    <button type="button" class="menu-item" wire:click="approve({{ $job->id }})" wire:loading.attr="disabled">Approve &amp; post to Slack</button>
                                                @endif
                                                @if($job->status !== 'rejected')
                                                    <button type="button" class="menu-item menu-item-danger" wire:click="reject({{ $job->id }})" wire:loading.attr="disabled">Reject</button>
                                                @endif
                                                @unless($job->company_id)
                                                    <button type="button" class="menu-item" wire:click="addToCompanies({{ $job->id }})" wire:loading.attr="disabled">Add to companies</button>
                                                @endunless
                                                <a href="{{ $job->url }}" target="_blank" rel="noopener" class="menu-item">View on LinkedIn</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-bar">
                    {{ $jobs->links() }}
                </div>
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
            font-family: var(--font);
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

        .flash-banner {
            background: rgba(74, 222, 128, 0.12);
            color: var(--tm-green);
            border: 1px solid rgba(74, 222, 128, 0.35);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9375rem;
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
            border: 1px solid var(--tm-border);
            border-radius: 0.25rem;
            background-color: var(--tm-surface);
            color: var(--tm-text);
            appearance: auto;
        }

        .filter-select:focus {
            border-color: var(--tm-yellow);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(245, 213, 99, 0.25);
        }

        .companies-table-wrapper {
            /* visible so the row-actions dropdown isn't clipped */
            overflow: visible;
        }

        [x-cloak] {
            display: none !important;
        }

        .companies-table {
            width: 100%;
            border-collapse: collapse;
        }

        .companies-table th,
        .companies-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--gray-200);
            vertical-align: top;
        }

        .companies-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .companies-table tbody tr:hover {
            background-color: var(--tm-surface-hover);
        }

        .company-name {
            font-weight: 600;
            color: var(--gray-900);
        }

        .muted {
            color: var(--gray-500);
            font-size: 0.875rem;
        }

        .reviewer-note {
            margin-top: 0.25rem;
            font-size: 0.75rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-right: 0.25rem;
        }

        .status-pending {
            background-color: rgba(245, 213, 99, 0.12);
            color: var(--tm-yellow);
        }

        .status-approved {
            background-color: rgba(74, 222, 128, 0.12);
            color: var(--tm-green);
        }

        .status-rejected {
            background-color: rgba(255, 107, 107, 0.12);
            color: var(--tm-red);
        }

        .review-link {
            color: var(--tm-yellow);
            text-decoration: none;
            font-weight: 500;
        }

        .review-link:hover {
            text-decoration: underline;
        }

        .actions-cell {
            white-space: nowrap;
            text-align: right;
        }

        .row-actions {
            position: relative;
            display: inline-block;
        }

        .btn-dots {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            font-size: 1.25rem;
            line-height: 1;
            font-weight: 700;
            color: var(--tm-muted);
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 0.375rem;
            cursor: pointer;
        }

        .btn-dots:hover {
            background: var(--tm-surface-hover);
            color: var(--tm-text);
        }

        .actions-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 0.25rem);
            z-index: 20;
            min-width: 12rem;
            background: var(--tm-surface-2);
            border: 1px solid var(--tm-border);
            border-radius: 0.5rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            padding: 0.25rem;
            display: flex;
            flex-direction: column;
        }

        .menu-item {
            display: block;
            width: 100%;
            text-align: left;
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--tm-text);
            background: transparent;
            border: 0;
            border-radius: 0.375rem;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
        }

        .menu-item:hover {
            background: var(--tm-surface-hover);
            color: var(--gray-950);
        }

        .menu-item-danger {
            color: var(--tm-red);
        }

        .menu-item-danger:hover {
            background: rgba(255, 107, 107, 0.12);
            color: var(--tm-red);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--gray-600);
        }

        .pagination-bar {
            margin-top: 1.25rem;
        }
    </style>
</div>
