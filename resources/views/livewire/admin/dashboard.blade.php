<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Dashboard</h1>
            <p class="admin-page-desc">Overview of the site.</p>
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

    
</div>
