<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Dashboard</h1>
            <p class="admin-page-desc">Overview of the site.</p>
        </div>

        @if(session('message'))
            <div class="flash-message" class="admin-flash">
                {{ session('message') }}
            </div>
        @endif

        <div class="dashboard-grid">
            <a href="{{ route('admin.companies') }}?status=pending" class="stat-card stat-card-pending">
                <span class="stat-number">{{ $pendingCompaniesCount }}</span>
                <span class="stat-label">Pending Companies</span>
            </a>
            <a href="{{ route('admin.companies') }}?status=approved" class="stat-card stat-card-approved">
                <span class="stat-number">{{ $approvedCount }}</span>
                <span class="stat-label">Approved Companies</span>
            </a>
            <a href="{{ route('admin.talks') }}?status=pending" class="stat-card stat-card-talks">
                <span class="stat-number">{{ $pendingTalksCount }}</span>
                <span class="stat-label">Pending Talks</span>
            </a>
            <a href="{{ route('admin.users') }}" class="stat-card stat-card-users">
                <span class="stat-number">{{ $totalUsers }}</span>
                <span class="stat-label">Users</span>
            </a>
        </div>

        @if($recentPendingCompanies->isNotEmpty())
            <div class="card" class="admin-card">
                <div class="pending-header">
                    <h3 class="pending-title">Companies: needs review</h3>
                    <a href="{{ route('admin.companies') }}" class="view-all-link">View all &rarr;</a>
                </div>
                <div class="companies-table-wrapper">
                    <table class="companies-table">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>City</th>
                                <th>Submitted By</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPendingCompanies as $company)
                                <tr wire:key="pending-company-{{ $company->id }}">
                                    <td class="company-name">{{ $company->name }}</td>
                                    <td>{{ $company->city }}</td>
                                    <td>{{ $company->user->name }}</td>
                                    <td>{{ $company->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.companies.review', $company) }}" class="review-link">Review</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if($recentPendingTalks->isNotEmpty())
            <div class="card" class="admin-card">
                <div class="pending-header">
                    <h3 class="pending-title">Talks: needs review</h3>
                    <a href="{{ route('admin.talks') }}" class="view-all-link">View all &rarr;</a>
                </div>
                <div class="companies-table-wrapper">
                    <table class="companies-table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Speaker</th>
                                <th>Cities</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPendingTalks as $talk)
                                <tr wire:key="pending-talk-{{ $talk->id }}">
                                    <td class="company-name">{{ $talk->title }}</td>
                                    <td>{{ $talk->user->name }}</td>
                                    <td>{{ implode(', ', $talk->cities) }}</td>
                                    <td>{{ $talk->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <a href="{{ route('admin.talks.review', $talk) }}" class="review-link">Review</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
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

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            border-radius: var(--border-radius-xl, 0.75rem);
            text-decoration: none;
            gap: 0.25rem;
            transition: transform 0.15s, box-shadow 0.15s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .stat-card-pending,
        .stat-card-approved,
        .stat-card-rejected,
        .stat-card-talks,
        .stat-card-users {
            background: white;
            color: var(--gray-950);
            border: 1px solid var(--gray-200);
        }

        .stat-number {
            font-family: 'Syne', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1;
            color: var(--gray-950);
        }

        .stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--gray-500);
        }

        .admin-flash {
            margin-bottom: 1rem;
        }

        .admin-card {
            margin-top: 1.5rem;
        }

        .pending-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .pending-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
        }

        .view-all-link {
            color: #FF2D20;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .view-all-link:hover {
            text-decoration: underline;
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

        .companies-table tbody tr:last-child td {
            border-bottom: none;
        }

        .companies-table tbody tr:hover {
            background-color: var(--gray-50, #f9fafb);
        }

        .company-name {
            font-weight: 600;
            color: var(--gray-900);
        }

        .review-link {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 500;
        }

        .review-link:hover {
            text-decoration: underline;
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
