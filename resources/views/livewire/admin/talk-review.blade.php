<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Review: {{ $talk->title }}</h2>
            <p class="section-subtitle">
                <a href="{{ route('admin.talks') }}">&larr; Back to list</a>
            </p>
        </div>

        @if(session('message'))
            <div class="flash-message" style="max-width: 800px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="card" style="max-width: 800px; margin: 0 auto;">
            <div class="review-section">
                <h3 class="review-section-title">Talk Details</h3>
                <div class="detail-grid">
                    <div class="detail-item" style="grid-column: span 2;">
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
                            <span class="status-badge status-{{ $talk->status }}">{{ ucfirst($talk->status) }}</span>
                        </span>
                    </div>
                    <div class="detail-item" style="grid-column: span 2;">
                        <span class="detail-label">Description</span>
                        <span class="detail-value">{{ $talk->description }}</span>
                    </div>
                    @if($talk->notes)
                        <div class="detail-item" style="grid-column: span 2;">
                            <span class="detail-label">Speaker Notes</span>
                            <span class="detail-value">{{ $talk->notes }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="review-section">
                <h3 class="review-section-title">Speaker</h3>
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
                    <div class="detail-item">
                        <span class="detail-label">Submitted</span>
                        <span class="detail-value">{{ $talk->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>

            @if($talk->twitter || $talk->linkedin || $talk->github || $talk->bluesky || $talk->facebook || $talk->instagram)
                <div class="review-section">
                    <h3 class="review-section-title">Social Links</h3>
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

            <div class="review-section" style="border-bottom: none;">
                <h3 class="review-section-title">Admin Notes</h3>
                <div class="form-group">
                    <textarea wire:model="adminNotes" class="admin-notes-textarea" rows="3" placeholder="Internal notes about this talk submission..."></textarea>
                </div>

                <div class="action-buttons">
                    @if($talk->status !== 'interested')
                        <button wire:click="markInterested" class="btn btn-interested" wire:loading.attr="disabled" wire:target="markInterested">
                            <span wire:loading.remove wire:target="markInterested">Interested</span>
                            <span wire:loading wire:target="markInterested">Saving...</span>
                        </button>
                    @endif

                    @if($talk->status !== 'scheduled')
                        <button wire:click="schedule" wire:confirm="Mark this talk as scheduled?" class="btn btn-scheduled" wire:loading.attr="disabled" wire:target="schedule">
                            <span wire:loading.remove wire:target="schedule">Schedule</span>
                            <span wire:loading wire:target="schedule">Saving...</span>
                        </button>
                    @endif

                    @if($talk->status === 'scheduled')
                        <button wire:click="markDone" wire:confirm="Mark this talk as done?" class="btn btn-done" wire:loading.attr="disabled" wire:target="markDone">
                            <span wire:loading.remove wire:target="markDone">Mark Done</span>
                            <span wire:loading wire:target="markDone">Saving...</span>
                        </button>
                    @endif

                    @if($talk->status !== 'rejected')
                        <button wire:click="reject" wire:confirm="Reject this talk submission?" class="btn btn-reject" wire:loading.attr="disabled" wire:target="reject">
                            <span wire:loading.remove wire:target="reject">Reject</span>
                            <span wire:loading wire:target="reject">Saving...</span>
                        </button>
                    @endif

                    <button wire:click="saveNotes" class="btn btn-save" wire:loading.attr="disabled" wire:target="saveNotes">
                        <span wire:loading.remove wire:target="saveNotes">Save Notes</span>
                        <span wire:loading wire:target="saveNotes">Saving...</span>
                    </button>
                </div>
            </div>
        </div>
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

        .review-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .review-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--gray-900);
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 600px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
        }

        .detail-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--gray-500);
        }

        .detail-value {
            color: var(--gray-900);
        }

        .detail-value a {
            color: #FF2D20;
            text-decoration: none;
            word-break: break-all;
        }

        .detail-value a:hover {
            text-decoration: underline;
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

        .status-pending { background-color: #fef3cd; color: #856404; }
        .status-interested { background-color: #e8f0fe; color: #1a56db; }
        .status-scheduled { background-color: #d4edda; color: #155724; }
        .status-done { background-color: var(--gray-100, #f3f4f6); color: var(--gray-600, #4b5563); }
        .status-rejected { background-color: #f8d7da; color: #721c24; }

        .admin-notes-textarea {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            resize: vertical;
        }

        .admin-notes-textarea:focus {
            border-color: #FF2D20;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 32, 0.25);
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .btn-interested { background-color: #e8f0fe; color: #1a56db; }
        .btn-interested:hover:not(:disabled) { background-color: #d0e0fd; }

        .btn-scheduled { background-color: #28a745; color: white; }
        .btn-scheduled:hover:not(:disabled) { background-color: #218838; }

        .btn-done { background-color: var(--gray-200, #e5e7eb); color: var(--gray-700, #374151); }
        .btn-done:hover:not(:disabled) { background-color: var(--gray-300, #d1d5db); }

        .btn-reject { background-color: #dc3545; color: white; }
        .btn-reject:hover:not(:disabled) { background-color: #c82333; }

        .btn-save { background-color: var(--gray-100, #f3f4f6); color: var(--gray-700, #374151); }
        .btn-save:hover:not(:disabled) { background-color: var(--gray-200, #e5e7eb); }

        .flash-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .section-subtitle a {
            color: #FF2D20;
            text-decoration: none;
        }

        .section-subtitle a:hover {
            text-decoration: underline;
        }
    </style>
</div>
