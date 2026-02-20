<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Companies</h1>
                    <p class="admin-page-desc">Review and manage company submissions.</p>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">
                    <div class="admin-filter-bar">
                        <label for="statusFilter" class="admin-filter-label">Status</label>
                        <select id="statusFilter" wire:model.live="statusFilter" class="admin-select">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                </div>

                @if($companies->isEmpty())
                    <div class="admin-empty">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        <p>No companies found{{ $statusFilter ? ' with status "'.$statusFilter.'"' : '' }}.</p>
                    </div>
                @else
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>City</th>
                                    <th>Submitted By</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                    <tr wire:key="admin-company-{{ $company->id }}">
                                        <td class="cell-primary">{{ $company->name }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td>{{ $company->user->name }}</td>
                                        <td>
                                            <span class="admin-badge admin-badge-{{ $company->status }}">{{ ucfirst($company->status) }}</span>
                                        </td>
                                        <td class="cell-muted">{{ $company->created_at->format('Y-m-d') }}</td>
                                        <td class="cell-action">
                                            <a href="{{ route('admin.companies.review', $company) }}" class="admin-link-btn">Review</a>
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

        .admin-content-inner {
            max-width: 1400px;
            margin: 0 auto;
        }

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

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

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

        .admin-table tbody tr {
            transition: background-color 0.1s;
        }

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
        .admin-badge-approved { background: #d1fae5; color: #065f46; }
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
