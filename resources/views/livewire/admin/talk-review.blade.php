<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <a href="{{ route('admin.talks') }}" class="admin-back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
                        Back to talks
                    </a>
                    <h1 class="admin-page-title">{{ $talk->title }}</h1>
                    <div class="admin-page-meta">
                        <span class="admin-badge admin-badge-{{ $talk->status }}">{{ ucfirst($talk->status) }}</span>
                        <span class="admin-meta-sep">Submitted {{ $talk->created_at->format('Y-m-d H:i') }}</span>
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
                            <h3 class="admin-card-section-title">Talk Details</h3>
                            <div class="detail-grid">
                                <div class="detail-item detail-item-full">
                                    <span class="detail-label">Title</span>
                                    <span class="detail-value">{{ $talk->title }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Cities</span>
                                    <span class="detail-value">{{ implode(', ', $talk->cities) }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Status</span>
                                    <span class="detail-value">
                                        <span class="admin-badge admin-badge-{{ $talk->status }}">{{ ucfirst($talk->status) }}</span>
                                    </span>
                                </div>
                                <div class="detail-item detail-item-full">
                                    <span class="detail-label">Description</span>
                                    <span class="detail-value detail-value-block">{{ $talk->description }}</span>
                                </div>
                                @if($talk->notes)
                                    <div class="detail-item detail-item-full">
                                        <span class="detail-label">Speaker Notes</span>
                                        <span class="detail-value detail-value-block">{{ $talk->notes }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Speaker</h3>
                            <div class="detail-grid">
                                <div class="detail-item">
                                    <span class="detail-label">Name</span>
                                    <span class="detail-value">{{ $talk->user->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Email</span>
                                    <span class="detail-value">
                                        <a href="mailto:{{ $talk->user->email }}">{{ $talk->user->email }}</a>
                                    </span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Position</span>
                                    <span class="detail-value">{{ $talk->position }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Company</span>
                                    <span class="detail-value">{{ $talk->company ?? '—' }}</span>
                                </div>
                            </div>
                        </div>

                        @if($talk->twitter || $talk->linkedin || $talk->github || $talk->bluesky || $talk->facebook || $talk->instagram)
                            <div class="admin-card-section" style="border-bottom: none;">
                                <h3 class="admin-card-section-title">Social Links</h3>
                                <div class="detail-grid">
                                    @foreach(['twitter' => 'Twitter/X', 'linkedin' => 'LinkedIn', 'github' => 'GitHub', 'bluesky' => 'Bluesky', 'facebook' => 'Facebook', 'instagram' => 'Instagram'] as $field => $label)
                                        @if($talk->$field)
                                            <div class="detail-item">
                                                <span class="detail-label">{{ $label }}</span>
                                                <span class="detail-value">
                                                    <a href="{{ $talk->$field }}" target="_blank" rel="noopener noreferrer">{{ $talk->$field }}</a>
                                                </span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="review-sidebar">
                    <div class="admin-card">
                        <div class="admin-card-section" style="border-bottom: none;">
                            <h3 class="admin-card-section-title">Admin Notes</h3>
                            <textarea wire:model="adminNotes" class="admin-textarea" rows="4" placeholder="Internal notes about this talk submission..."></textarea>

                            <div class="review-actions">
                                @if($talk->status !== 'interested')
                                    <button wire:click="markInterested" class="admin-btn admin-btn-interested" wire:loading.attr="disabled" wire:target="markInterested">
                                        <span wire:loading.remove wire:target="markInterested">Interested</span>
                                        <span wire:loading wire:target="markInterested">Saving...</span>
                                    </button>
                                @endif

                                @if($talk->status !== 'scheduled')
                                    <button wire:click="schedule" wire:confirm="Mark this talk as scheduled?" class="admin-btn admin-btn-schedule" wire:loading.attr="disabled" wire:target="schedule">
                                        <span wire:loading.remove wire:target="schedule">Schedule</span>
                                        <span wire:loading wire:target="schedule">Saving...</span>
                                    </button>
                                @endif

                                @if($talk->status === 'scheduled')
                                    <button wire:click="markDone" wire:confirm="Mark this talk as done?" class="admin-btn admin-btn-done" wire:loading.attr="disabled" wire:target="markDone">
                                        <span wire:loading.remove wire:target="markDone">Mark Done</span>
                                        <span wire:loading wire:target="markDone">Saving...</span>
                                    </button>
                                @endif

                                @if($talk->status !== 'rejected')
                                    <button wire:click="reject" wire:confirm="Reject this talk submission?" class="admin-btn admin-btn-reject" wire:loading.attr="disabled" wire:target="reject">
                                        <span wire:loading.remove wire:target="reject">Reject</span>
                                        <span wire:loading wire:target="reject">Saving...</span>
                                    </button>
                                @endif

                                <button wire:click="saveNotes" class="admin-btn admin-btn-secondary" wire:loading.attr="disabled" wire:target="saveNotes">
                                    <span wire:loading.remove wire:target="saveNotes">Save Notes</span>
                                    <span wire:loading wire:target="saveNotes">Saving...</span>
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
        .admin-badge-interested { background: #dbeafe; color: #1e40af; }
        .admin-badge-scheduled { background: #d1fae5; color: #065f46; }
        .admin-badge-done { background: var(--gray-100); color: var(--gray-600); }
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

        .detail-value-block { line-height: 1.6; }

        .detail-value a {
            color: var(--laravel-red);
            text-decoration: none;
            word-break: break-all;
        }

        .detail-value a:hover { text-decoration: underline; }

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
            gap: 0.625rem;
            margin-top: 1.25rem;
        }

        .admin-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.625rem 1.25rem;
            border-radius: var(--border-radius);
            font-size: 0.85rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: opacity 0.15s, transform 0.1s;
        }

        .admin-btn:hover:not(:disabled) { opacity: 0.9; transform: translateY(-1px); }
        .admin-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        .admin-btn-interested {
            background: #dbeafe;
            color: #1e40af;
        }

        .admin-btn-schedule {
            background: #059669;
            color: white;
        }

        .admin-btn-done {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .admin-btn-reject {
            background: white;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .admin-btn-reject:hover:not(:disabled) { background: #fef2f2; }

        .admin-btn-secondary {
            background: white;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }

        .admin-btn-secondary:hover:not(:disabled) { background: var(--gray-50); }
    </style>
</div>
