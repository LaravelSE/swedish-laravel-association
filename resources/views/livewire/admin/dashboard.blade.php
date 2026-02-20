<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <h1 class="admin-page-title">Dashboard</h1>
                    <p class="admin-page-desc">Overview of the site.</p>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="stats-grid">
                <a href="{{ route('admin.companies') }}?status=pending" class="stat-card stat-card-warning">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $pendingCompaniesCount }}</span>
                        <span class="stat-label">Pending Companies</span>
                    </div>
                </a>
                <a href="{{ route('admin.companies') }}?status=approved" class="stat-card stat-card-success">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $approvedCount }}</span>
                        <span class="stat-label">Approved Companies</span>
                    </div>
                </a>
                <a href="{{ route('admin.talks') }}?status=pending" class="stat-card stat-card-purple">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $pendingTalksCount }}</span>
                        <span class="stat-label">Pending Talks</span>
                    </div>
                </a>
                <a href="{{ route('admin.users') }}" class="stat-card stat-card-blue">
                    <div class="stat-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $totalUsers }}</span>
                        <span class="stat-label">Users</span>
                    </div>
                </a>
            </div>

            @if($recentPendingCompanies->isNotEmpty())
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h3 class="admin-card-title">Companies: needs review</h3>
                        <a href="{{ route('admin.companies') }}" class="admin-card-action">View all &rarr;</a>
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
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
                                        <td class="cell-primary">{{ $company->name }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td>{{ $company->user->name }}</td>
                                        <td class="cell-muted">{{ $company->created_at->format('Y-m-d') }}</td>
                                        <td class="cell-action">
                                            <a href="{{ route('admin.companies.review', $company) }}" class="admin-link-btn">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($recentPendingTalks->isNotEmpty())
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h3 class="admin-card-title">Talks: needs review</h3>
                        <a href="{{ route('admin.talks') }}" class="admin-card-action">View all &rarr;</a>
                    </div>
                    <div class="admin-table-wrap">
                        <table class="admin-table">
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
                                        <td class="cell-primary">{{ $talk->title }}</td>
                                        <td>{{ $talk->user->name }}</td>
                                        <td>{{ implode(', ', $talk->cities) }}</td>
                                        <td class="cell-muted">{{ $talk->created_at->format('Y-m-d') }}</td>
                                        <td class="cell-action">
                                            <a href="{{ route('admin.talks.review', $talk) }}" class="admin-link-btn">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @livewire('footer')

    <style>
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 900px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            border-radius: var(--border-radius-xl);
            text-decoration: none;
            transition: transform 0.15s, box-shadow 0.15s;
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--border-radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-card-warning { background: #fffbeb; border-color: #fde68a; }
        .stat-card-warning .stat-icon { background: #fef3c7; color: #d97706; }
        .stat-card-warning .stat-number { color: #92400e; }
        .stat-card-warning .stat-label { color: #a16207; }

        .stat-card-success { background: #ecfdf5; border-color: #a7f3d0; }
        .stat-card-success .stat-icon { background: #d1fae5; color: #059669; }
        .stat-card-success .stat-number { color: #065f46; }
        .stat-card-success .stat-label { color: #047857; }

        .stat-card-purple { background: #faf5ff; border-color: #e9d5ff; }
        .stat-card-purple .stat-icon { background: #f3e8ff; color: #7c3aed; }
        .stat-card-purple .stat-number { color: #5b21b6; }
        .stat-card-purple .stat-label { color: #6d28d9; }

        .stat-card-blue { background: #eff6ff; border-color: #bfdbfe; }
        .stat-card-blue .stat-icon { background: #dbeafe; color: #2563eb; }
        .stat-card-blue .stat-number { color: #1e40af; }
        .stat-card-blue .stat-label { color: #1d4ed8; }

        .stat-info {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.025em;
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-top: 0.25rem;
        }

        .admin-card {
            background: white;
            border-radius: var(--border-radius-xl);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .admin-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .admin-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: 0;
        }

        .admin-card-action {
            color: var(--laravel-red);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: opacity 0.15s;
        }

        .admin-card-action:hover {
            opacity: 0.8;
        }

        .admin-table-wrap {
            overflow-x: auto;
        }

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

        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        .admin-table tbody tr {
            transition: background-color 0.1s;
        }

        .admin-table tbody tr:hover {
            background-color: var(--gray-50);
        }

        .cell-primary {
            font-weight: 600;
            color: var(--gray-900);
        }

        .cell-muted {
            color: var(--gray-400);
        }

        .cell-action {
            text-align: right;
        }

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

        .admin-link-btn:hover {
            background: rgba(255, 45, 32, 0.12);
        }
    </style>
</div>
