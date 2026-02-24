<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">Review: {{ $company->name }}</h1>
            <p class="admin-page-desc">
                <a href="{{ route('admin.companies') }}">&larr; Back to list</a>
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
                <h3 class="review-section-title">Company Details</h3>
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
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">
                            <span class="status-badge status-{{ $company->status }}">{{ ucfirst($company->status) }}</span>
                        </span>
                    </div>
                </div>

                @if($company->description)
                    <div class="detail-item" style="margin-top: 1rem;">
                        <span class="detail-label">Description</span>
                        <span class="detail-value">{{ $company->description }}</span>
                    </div>
                @endif
            </div>

            <div class="review-section">
                <h3 class="review-section-title">Contact Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $company->contact_email ?? '—' }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Phone</span>
                        <span class="detail-value">{{ $company->phone ?? '—' }}</span>
                    </div>
                    <div class="detail-item" style="grid-column: span 2;">
                        <span class="detail-label">Address</span>
                        <span class="detail-value">{{ $company->address ?? '—' }}</span>
                    </div>
                </div>
            </div>

            @if($company->logo_path || $company->linkedin || $company->github || $company->twitter)
                <div class="review-section">
                    <h3 class="review-section-title">Logo & Social</h3>
                    @if($company->logo_path)
                        <div class="detail-item" style="margin-bottom: 1rem;">
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

            <div class="review-section">
                <h3 class="review-section-title">Submitter Information</h3>
                <div class="detail-grid">
                    <div class="detail-item">
                        <span class="detail-label">Submitted By</span>
                        <span class="detail-value">{{ $company->user->name }} ({{ $company->user->email }})</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Relationship</span>
                        <span class="detail-value">{{ $company->submitter_relationship }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Submitted</span>
                        <span class="detail-value">{{ $company->created_at->format('Y-m-d H:i') }}</span>
                    </div>
                </div>
            </div>

            <div class="review-section" style="border-bottom: none;">
                <h3 class="review-section-title">Admin Notes</h3>
                <div class="form-group">
                    <textarea wire:model="adminNotes" class="admin-notes-textarea" rows="3" placeholder="Internal notes about this submission..."></textarea>
                </div>

                <div class="action-buttons">
                    <button wire:click="approve" wire:confirm="Approve this company?" class="btn btn-approve" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="approve">Approve</span>
                        <span wire:loading wire:target="approve">Approving...</span>
                    </button>
                    <button wire:click="reject" wire:confirm="Reject this company? This cannot be undone." class="btn btn-reject" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="reject">Reject</span>
                        <span wire:loading wire:target="reject">Rejecting...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    
</div>
