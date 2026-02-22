<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">{{ $user->name }}</h1>
            <p class="admin-page-desc">
                <a href="{{ route('admin.users') }}">&larr; Back to users</a>
            </p>
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

        <div class="detail-layout">

            {{-- Profile card --}}
            <div class="card profile-card">
                <div class="profile-header">
                    <div class="profile-initials">{{ mb_substr($user->name, 0, 1) }}</div>
                    <div>
                        <h3 class="profile-name">{{ $user->name }}</h3>
                        @if($user->isAdmin())
                            <span class="role-badge role-admin">Admin</span>
                        @else
                            <span class="role-badge role-user">User</span>
                        @endif
                    </div>
                </div>

                <dl class="profile-details">
                    <div class="detail-row">
                        <dt>Email</dt>
                        <dd>{{ $user->email }}</dd>
                    </div>
                    @if($user->phone)
                        <div class="detail-row">
                            <dt>Phone</dt>
                            <dd>{{ $user->phone }}</dd>
                        </div>
                    @endif
                    @if($user->city)
                        <div class="detail-row">
                            <dt>City</dt>
                            <dd>{{ $user->city }}</dd>
                        </div>
                    @endif
                    @if($user->company)
                        <div class="detail-row">
                            <dt>Company</dt>
                            <dd>{{ $user->company }}</dd>
                        </div>
                    @endif
                    <div class="detail-row">
                        <dt>Joined</dt>
                        <dd>{{ $user->created_at->format('Y-m-d') }}</dd>
                    </div>
                </dl>

                <div class="profile-actions">
                    @if($user->isAdmin())
                        @if($user->id !== auth()->id())
                            <button
                                wire:click="demoteFromAdmin"
                                wire:confirm="Remove admin access from {{ $user->name }}?"
                                wire:loading.attr="disabled"
                                wire:target="demoteFromAdmin"
                                class="action-btn action-btn-demote"
                            >
                                <span wire:loading.remove wire:target="demoteFromAdmin">Remove admin</span>
                                <span wire:loading wire:target="demoteFromAdmin">Saving...</span>
                            </button>
                        @else
                            <span class="you-note">This is you</span>
                        @endif
                    @else
                        <button
                            wire:click="promoteToAdmin"
                            wire:confirm="Grant admin access to {{ $user->name }}?"
                            wire:loading.attr="disabled"
                            wire:target="promoteToAdmin"
                            class="action-btn action-btn-promote"
                        >
                            <span wire:loading.remove wire:target="promoteToAdmin">Make admin</span>
                            <span wire:loading wire:target="promoteToAdmin">Saving...</span>
                        </button>
                    @endif
                </div>
            </div>

            <div class="activity-column">

                {{-- Talks --}}
                <div class="card">
                    <h3 class="card-section-title">Talk Submissions <span class="count-badge">{{ $talks->count() }}</span></h3>

                    @if($talks->isEmpty())
                        <p class="empty-text">No talk submissions.</p>
                    @else
                        <div class="submissions-list">
                            @foreach($talks as $talk)
                                <div class="submission-item" wire:key="talk-{{ $talk->id }}">
                                    <div class="submission-info">
                                        <span class="submission-title">{{ $talk->title }}</span>
                                        <span class="submission-date">{{ $talk->created_at->format('Y-m-d') }}</span>
                                    </div>
                                    <div class="submission-meta">
                                        <span class="status-badge status-{{ $talk->status ?? 'pending' }}">{{ $talk->status ?? 'pending' }}</span>
                                        <a href="{{ route('admin.talks.review', $talk) }}" class="review-link">Review &rarr;</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Companies --}}
                <div class="card">
                    <h3 class="card-section-title">Company Submissions <span class="count-badge">{{ $companies->count() }}</span></h3>

                    @if($companies->isEmpty())
                        <p class="empty-text">No company submissions.</p>
                    @else
                        <div class="submissions-list">
                            @foreach($companies as $company)
                                <div class="submission-item" wire:key="company-{{ $company->id }}">
                                    <div class="submission-info">
                                        <span class="submission-title">{{ $company->name }}</span>
                                        <span class="submission-date">{{ $company->created_at->format('Y-m-d') }}</span>
                                    </div>
                                    <div class="submission-meta">
                                        <span class="status-badge status-{{ $company->status }}">{{ $company->status }}</span>
                                        <a href="{{ route('admin.companies.review', $company) }}" class="review-link">Review &rarr;</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
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

        .detail-layout {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 1.5rem;
            max-width: 900px;
            margin: 0 auto;
            align-items: start;
        }

        @media (max-width: 700px) {
            .detail-layout { grid-template-columns: 1fr; }
        }

        .activity-column { display: flex; flex-direction: column; gap: 1.5rem; }

        .profile-card { padding: 1.5rem; }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .profile-initials {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: var(--laravel-red, #FF2D20);
            color: white;
            font-size: 1.5rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-name {
            margin: 0 0 0.25rem;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .role-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .role-admin { background-color: #e8f0fe; color: #1a56db; }
        .role-user { background-color: var(--gray-100, #f3f4f6); color: var(--gray-600, #4b5563); }

        .profile-details { margin: 0 0 1.5rem; }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-100, #f3f4f6);
            font-size: 0.9rem;
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-row dt {
            color: var(--gray-500);
            font-weight: 500;
            flex-shrink: 0;
        }

        .detail-row dd {
            margin: 0;
            text-align: right;
            word-break: break-all;
        }

        .profile-actions { padding-top: 1rem; }

        .action-btn {
            width: 100%;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
        }

        .action-btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .action-btn-promote { background-color: #e8f0fe; color: #1a56db; }
        .action-btn-promote:hover:not(:disabled) { background-color: #d0e0fd; }

        .action-btn-demote { background-color: #f8d7da; color: #721c24; }
        .action-btn-demote:hover:not(:disabled) { background-color: #f1c0c5; }

        .you-note { font-size: 0.8rem; color: var(--gray-400); }

        .card-section-title {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: var(--gray-100, #f3f4f6);
            color: var(--gray-600);
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 9999px;
            padding: 0.1rem 0.5rem;
        }

        .empty-text {
            color: var(--gray-400);
            font-size: 0.9rem;
            margin: 0;
        }

        .submissions-list { display: flex; flex-direction: column; gap: 0.75rem; }

        .submission-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem;
            background: var(--gray-50, #f9fafb);
            border-radius: 0.25rem;
        }

        .submission-info {
            display: flex;
            flex-direction: column;
            gap: 0.1rem;
            min-width: 0;
        }

        .submission-title {
            font-weight: 500;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .submission-date {
            font-size: 0.8rem;
            color: var(--gray-500);
        }

        .submission-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .status-badge {
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-approved, .status-done, .status-scheduled { background-color: #d4edda; color: #155724; }
        .status-rejected { background-color: #f8d7da; color: #721c24; }
        .status-interested { background-color: #d1ecf1; color: #0c5460; }

        .review-link {
            color: #FF2D20;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .review-link:hover { text-decoration: underline; }

        .flash-message {
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .flash-success { background-color: #d4edda; color: #155724; }
        .flash-error { background-color: #f8d7da; color: #721c24; }

    </style>
</div>
