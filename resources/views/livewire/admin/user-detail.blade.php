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

    
</div>
