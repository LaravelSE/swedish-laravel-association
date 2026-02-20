<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <a href="{{ route('admin.users') }}" class="admin-back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
                        Back to users
                    </a>
                    <h1 class="admin-page-title">{{ $user->name }}</h1>
                    <div class="admin-page-meta">
                        @if($user->isAdmin())
                            <span class="admin-badge admin-badge-admin">Admin</span>
                        @else
                            <span class="admin-badge admin-badge-user">User</span>
                        @endif
                        <span class="admin-meta-sep">Joined {{ $user->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            @if(session('error'))
                <div class="admin-flash admin-flash-error">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="detail-layout">
                <div class="profile-sidebar">
                    <div class="admin-card">
                        <div class="admin-card-section" style="border-bottom: none;">
                            <div class="profile-header">
                                <div class="profile-initials">{{ mb_substr($user->name, 0, 1) }}</div>
                                <div>
                                    <h3 class="profile-name">{{ $user->name }}</h3>
                                    <span class="profile-email">{{ $user->email }}</span>
                                </div>
                            </div>

                            <dl class="profile-details">
                                @if($user->phone)
                                    <div class="profile-detail-row">
                                        <dt>Phone</dt>
                                        <dd>{{ $user->phone }}</dd>
                                    </div>
                                @endif
                                @if($user->city)
                                    <div class="profile-detail-row">
                                        <dt>City</dt>
                                        <dd>{{ $user->city }}</dd>
                                    </div>
                                @endif
                                @if($user->company)
                                    <div class="profile-detail-row">
                                        <dt>Company</dt>
                                        <dd>{{ $user->company }}</dd>
                                    </div>
                                @endif
                                <div class="profile-detail-row">
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
                                            class="admin-action-btn admin-action-btn-demote"
                                        >
                                            <span wire:loading.remove wire:target="demoteFromAdmin">Remove admin</span>
                                            <span wire:loading wire:target="demoteFromAdmin">Saving...</span>
                                        </button>
                                    @else
                                        <span class="you-note">This is your account</span>
                                    @endif
                                @else
                                    <button
                                        wire:click="promoteToAdmin"
                                        wire:confirm="Grant admin access to {{ $user->name }}?"
                                        wire:loading.attr="disabled"
                                        wire:target="promoteToAdmin"
                                        class="admin-action-btn admin-action-btn-promote"
                                    >
                                        <span wire:loading.remove wire:target="promoteToAdmin">Make admin</span>
                                        <span wire:loading wire:target="promoteToAdmin">Saving...</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="activity-column">
                    <div class="admin-card">
                        <div class="admin-card-section" style="border-bottom: none;">
                            <div class="activity-header">
                                <h3 class="admin-card-section-title" style="margin-bottom: 0;">Talk Submissions</h3>
                                <span class="count-badge">{{ $talks->count() }}</span>
                            </div>

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
                                                <span class="admin-badge admin-badge-{{ $talk->status ?? 'pending' }}">{{ $talk->status ?? 'pending' }}</span>
                                                <a href="{{ route('admin.talks.review', $talk) }}" class="admin-link-btn-sm">Review</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="admin-card">
                        <div class="admin-card-section" style="border-bottom: none;">
                            <div class="activity-header">
                                <h3 class="admin-card-section-title" style="margin-bottom: 0;">Company Submissions</h3>
                                <span class="count-badge">{{ $companies->count() }}</span>
                            </div>

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
                                                <span class="admin-badge admin-badge-{{ $company->status }}">{{ $company->status }}</span>
                                                <a href="{{ route('admin.companies.review', $company) }}" class="admin-link-btn-sm">Review</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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

        .admin-content-inner { max-width: 1400px; margin: 0 auto; }

        .admin-page-header { margin-bottom: 2rem; }

        .admin-back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--gray-500);
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: color 0.15s;
        }

        .admin-back-link:hover { color: var(--laravel-red); }

        .admin-page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-900);
            margin: 0 0 0.5rem;
            letter-spacing: -0.025em;
        }

        .admin-page-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .admin-meta-sep {
            font-size: 0.85rem;
            color: var(--gray-400);
        }

        .admin-badge {
            display: inline-flex;
            padding: 0.2rem 0.65rem;
            border-radius: 9999px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .admin-badge-admin { background: #dbeafe; color: #1e40af; }
        .admin-badge-user { background: var(--gray-100); color: var(--gray-600); }
        .admin-badge-pending { background: #fef3cd; color: #92400e; }
        .admin-badge-approved, .admin-badge-done, .admin-badge-scheduled { background: #d1fae5; color: #065f46; }
        .admin-badge-rejected { background: #fee2e2; color: #991b1b; }
        .admin-badge-interested { background: #dbeafe; color: #1e40af; }

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

        .admin-flash-success { background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
        .admin-flash-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        .detail-layout {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 1.5rem;
            align-items: start;
        }

        @media (max-width: 800px) {
            .detail-layout { grid-template-columns: 1fr; }
        }

        .activity-column { display: flex; flex-direction: column; gap: 1.5rem; }

        .admin-card {
            background: white;
            border-radius: var(--border-radius-xl);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .admin-card-section {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .admin-card-section-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--gray-400);
            margin: 0 0 1.25rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .profile-initials {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            background: var(--gray-900);
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-name {
            margin: 0 0 0.15rem;
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .profile-email {
            font-size: 0.85rem;
            color: var(--gray-500);
        }

        .profile-details { margin: 0 0 1.5rem; }

        .profile-detail-row {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.625rem 0;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.875rem;
        }

        .profile-detail-row:last-child { border-bottom: none; }

        .profile-detail-row dt {
            color: var(--gray-400);
            font-weight: 500;
            flex-shrink: 0;
        }

        .profile-detail-row dd {
            margin: 0;
            text-align: right;
            word-break: break-all;
            color: var(--gray-900);
        }

        .profile-actions { padding-top: 0.5rem; }

        .admin-action-btn {
            width: 100%;
            padding: 0.625rem 1rem;
            border-radius: var(--border-radius);
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.15s;
        }

        .admin-action-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        .admin-action-btn-promote {
            background: rgba(37, 99, 235, 0.08);
            color: #1e40af;
        }

        .admin-action-btn-promote:hover:not(:disabled) { background: rgba(37, 99, 235, 0.15); }

        .admin-action-btn-demote {
            background: rgba(220, 38, 38, 0.06);
            color: #dc2626;
        }

        .admin-action-btn-demote:hover:not(:disabled) { background: rgba(220, 38, 38, 0.12); }

        .you-note {
            font-size: 0.8rem;
            color: var(--gray-400);
        }

        .activity-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .count-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: var(--gray-100);
            color: var(--gray-500);
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 9999px;
            padding: 0.1rem 0.5rem;
        }

        .empty-text {
            color: var(--gray-400);
            font-size: 0.9rem;
            margin: 0;
        }

        .submissions-list { display: flex; flex-direction: column; gap: 0.5rem; }

        .submission-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1rem;
            background: var(--gray-50);
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-100);
            transition: border-color 0.15s;
        }

        .submission-item:hover { border-color: var(--gray-200); }

        .submission-info {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            min-width: 0;
        }

        .submission-title {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--gray-900);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .submission-date {
            font-size: 0.8rem;
            color: var(--gray-400);
        }

        .submission-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-shrink: 0;
        }

        .admin-link-btn-sm {
            color: var(--laravel-red);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            transition: opacity 0.15s;
        }

        .admin-link-btn-sm:hover { opacity: 0.7; }
    </style>
</div>
