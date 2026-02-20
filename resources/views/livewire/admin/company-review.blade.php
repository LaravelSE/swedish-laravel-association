<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Review: {{ $company->name }}</h2>
            <p class="section-subtitle">
                <a href="{{ route('admin.companies') }}">&larr; Back to list</a>
            </p>
        </div>

        @if(session('message'))
            <div class="flash-message" style="max-width: 800px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="card" style="max-width: 800px; margin: 0 auto;">
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

        .logo-preview {
            max-width: 150px;
            max-height: 150px;
            border-radius: 0.5rem;
            border: 1px solid var(--gray-200);
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

        .status-pending {
            background-color: #fef3cd;
            color: #856404;
        }

        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

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
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.25rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-approve:hover {
            background-color: #218838;
        }

        .btn-reject {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.25rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-reject:hover {
            background-color: #c82333;
        }

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
