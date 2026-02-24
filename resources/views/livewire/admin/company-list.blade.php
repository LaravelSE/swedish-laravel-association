<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Companies</h1>
            <p class="admin-page-desc">Review and manage company submissions.</p>
        </div>

        <div class="card">
            <div class="filter-bar">
                <label for="statusFilter">Filter by status:</label>
                <select id="statusFilter" wire:model.live="statusFilter" class="filter-select">
                    <option value="">All</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            @if($companies->isEmpty())
                <div class="empty-state">
                    <p>No companies found{{ $statusFilter ? ' with status "'.$statusFilter.'"' : '' }}.</p>
                </div>
            @else
                <div class="companies-table-wrapper">
                    <table class="companies-table">
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
                                    <td class="company-name">{{ $company->name }}</td>
                                    <td>{{ $company->city }}</td>
                                    <td>{{ $company->user->name }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $company->status }}">{{ ucfirst($company->status) }}</span>
                                    </td>
                                    <td>{{ $company->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.companies.review', $company) }}" class="review-link">Review</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $companies->links() }}
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

        .companies-table-wrapper {
            overflow-x: auto;
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
        }

        .companies-table th {
            font-weight: 600;
            color: var(--gray-700);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .companies-table tbody tr:hover {
            background-color: var(--gray-50, #f9fafb);
        }

        .company-name {
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

        .status-approved {
            background-color: #d4edda;
            color: #155724;
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
    </style>
</div>
