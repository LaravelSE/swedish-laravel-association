<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Admin: Dashboard</h2>
            <p class="section-subtitle">Overview of the site.</p>
        </div>

        @if(session('message'))
            <div class="flash-message" style="max-width: 1000px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="dashboard-grid" style="max-width: 1000px; margin: 0 auto;">
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
            <div class="card" style="max-width: 1000px; margin: 1.5rem auto 0;">
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
            <div class="card" style="max-width: 1000px; margin: 1.5rem auto 0;">
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
    </section>

    @livewire('footer')

    <style>
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
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

        .stat-card-pending {
            background-color: #fef3cd;
            color: #856404;
        }

        .stat-card-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .stat-card-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .stat-card-talks {
            background-color: #fce8ff;
            color: #7c3aed;
        }

        .stat-card-users {
            background-color: #e8f0fe;
            color: #1a56db;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.85;
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
