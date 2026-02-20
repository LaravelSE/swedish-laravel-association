<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <a href="{{ route('admin.companies') }}" class="admin-back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
                        Back to companies
                    </a>
                    <h1 class="admin-page-title">{{ $company->name }}</h1>
                    <div class="admin-page-meta">
                        <span class="admin-badge admin-badge-{{ $company->status }}">{{ ucfirst($company->status) }}</span>
                        <span class="admin-meta-sep">Submitted {{ $company->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="review-layout">
                <div class="review-main">
                    <div class="admin-card">
                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Company Details</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Name</span>
                                    <span class="detail-value">{{ $company->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">City</span>
                                    <span class="detail-value">{{ $company->city }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Industry</span>
                                    <span class="detail-value">{{ $company->industry ?? '—' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Size</span>
                                    <span class="detail-value">{{ $company->size ? $company->size.' employees' : '—' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Website</span>
                                    <span class="detail-value">
                                        @if($company->website)
                                            <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer">{{ $company->website }}</a>
                                        @else
                                            —
                                        @endif
                                    </span>
                                </div>
                            </div>

                            @if($company->description)
                                <div class="detail-item" style="margin-top: 1.25rem;">
                                    <span class="detail-label">Description</span>
                                    <span class="detail-value detail-value-block">{{ $company->description }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Contact Information</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Email</span>
                                    <span class="detail-value">{{ $company->contact_email ?? '—' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Phone</span>
                                    <span class="detail-value">{{ $company->phone ?? '—' }}</span>
                                </div>
                                <div class="detail-item detail-item-full">
                                    <span class="detail-label">Address</span>
                                    <span class="detail-value">{{ $company->address ?? '—' }}</span>
                                </div>
                            </div>
                        </div>

                        @if($company->logo_path || $company->linkedin || $company->github || $company->twitter)
                            <div class="admin-card-section">
                                <h3 class="admin-card-section-title">Logo & Social</h3>
                                @if($company->logo_path)
                                    <div class="detail-item" style="margin-bottom: 1.25rem;">
                                        <span class="detail-label">Logo</span>
                                        <img src="{{ asset('storage/'.$company->logo_path) }}" alt="{{ $company->name }} logo" class="logo-preview">
                                    </div>
                                @endif
                                <div class="detail-grid">
                                    @if($company->linkedin)
                                        <div class="detail-item">
                                            <span class="detail-label">LinkedIn</span>
                                            <span class="detail-value"><a href="{{ $company->linkedin }}" target="_blank" rel="noopener noreferrer">{{ $company->linkedin }}</a></span>
                                        </div>
                                    @endif
                                    @if($company->github)
                                        <div class="detail-item">
                                            <span class="detail-label">GitHub</span>
                                            <span class="detail-value"><a href="{{ $company->github }}" target="_blank" rel="noopener noreferrer">{{ $company->github }}</a></span>
                                        </div>
                                    @endif
                                    @if($company->twitter)
                                        <div class="detail-item">
                                            <span class="detail-label">Twitter</span>
                                            <span class="detail-value"><a href="{{ $company->twitter }}" target="_blank" rel="noopener noreferrer">{{ $company->twitter }}</a></span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="admin-card-section" style="border-bottom: none;">
                            <h3 class="admin-card-section-title">Submitter Information</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Submitted By</span>
                                    <span class="detail-value">{{ $company->user->name }} ({{ $company->user->email }})</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Relationship</span>
                                    <span class="detail-value">{{ $company->submitter_relationship }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-sidebar">
                    <div class="admin-card">
                        <div class="admin-card-section" style="border-bottom: none;">
                            <h3 class="admin-card-section-title">Admin Notes</h3>
                            <textarea wire:model="adminNotes" class="admin-textarea" rows="4" placeholder="Internal notes about this submission..."></textarea>

                            <div class="review-actions">
                                <button wire:click="approve" wire:confirm="Approve this company?" class="admin-btn admin-btn-approve" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="approve">Approve</span>
                                    <span wire:loading wire:target="approve">Approving...</span>
                                </button>
                                <button wire:click="reject" wire:confirm="Reject this company? This cannot be undone." class="admin-btn admin-btn-reject" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="reject">Reject</span>
                                    <span wire:loading wire:target="reject">Rejecting...</span>
                                </button>
                            </div>
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

        .admin-badge-pending { background: #fef3cd; color: #92400e; }
        .admin-badge-approved { background: #d1fae5; color: #065f46; }
        .admin-badge-rejected { background: #fee2e2; color: #991b1b; }

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

        .review-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 1.5rem;
            align-items: start;
        }

        @media (max-width: 900px) {
            .review-layout { grid-template-columns: 1fr; }
        }

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

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 600px) {
            .detail-grid { grid-template-columns: 1fr; }
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .detail-item-full { grid-column: span 2; }

        @media (max-width: 600px) {
            .detail-item-full { grid-column: span 1; }
        }

        .detail-label {
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-400);
        }

        .detail-value {
            color: var(--gray-900);
            font-size: 0.95rem;
        }

        .detail-value-block {
            line-height: 1.6;
        }

        .detail-value a {
            color: var(--laravel-red);
            text-decoration: none;
            word-break: break-all;
        }

        .detail-value a:hover { text-decoration: underline; }

        .logo-preview {
            max-width: 120px;
            max-height: 120px;
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-200);
        }

        .admin-textarea {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            font-family: inherit;
            line-height: 1.6;
            color: var(--gray-700);
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            resize: vertical;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .admin-textarea:focus {
            border-color: var(--laravel-red);
            box-shadow: 0 0 0 3px rgba(255, 45, 32, 0.1);
            outline: none;
            background: white;
        }

        .review-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 1.25rem;
        }

        .admin-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
        }

        .admin-btn:hover:not(:disabled) { opacity: 0.9; transform: translateY(-1px); }
        .admin-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        .admin-btn-approve {
            background: #059669;
            color: white;
        }

        .admin-btn-reject {
            background: white;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .admin-btn-reject:hover:not(:disabled) {
            background: #fef2f2;
        }
    </style>
</div>
