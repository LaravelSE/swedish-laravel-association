<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Review: {{ $talk->title }}</h1>
            <p class="admin-page-desc">
                <a href="{{ route('admin.talks') }}">&larr; Back to list</a>
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

        <div class="card">
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
    </div>

    
</div>
