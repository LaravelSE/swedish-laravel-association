<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <a href="{{ route('admin.board-members') }}" class="admin-back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
                        Back to board members
                    </a>
                    <h1 class="admin-page-title">{{ $boardMember?->exists ? 'Edit: '.$boardMember->name : 'New Board Member' }}</h1>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-layout">
                <div class="admin-card">
                    <div class="admin-card-section">
                        <h3 class="admin-card-section-title">Member Details</h3>

                        <div class="admin-form-row">
                            <div class="admin-form-group">
                                <label class="admin-form-label">Name <span class="admin-required">*</span></label>
                                <input type="text" wire:model="name" class="admin-input @error('name') admin-input-error @enderror" placeholder="Full name">
                                @error('name') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="admin-form-group">
                                <label class="admin-form-label">Role <span class="admin-required">*</span></label>
                                <input type="text" wire:model="role" class="admin-input @error('role') admin-input-error @enderror" placeholder="Ordforande">
                                @error('role') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="admin-form-row">
                            <div class="admin-form-group">
                                <label class="admin-form-label">Company</label>
                                <input type="text" wire:model="company" class="admin-input @error('company') admin-input-error @enderror" placeholder="Company name">
                                @error('company') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>
                            <div class="admin-form-group">
                                <label class="admin-form-label">Sort Order <span class="admin-required">*</span></label>
                                <input type="number" wire:model="sortOrder" class="admin-input @error('sortOrder') admin-input-error @enderror" min="0">
                                @error('sortOrder') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="admin-card-section" style="border-bottom: none;">
                        <h3 class="admin-card-section-title">Photo</h3>

                        @if($boardMember?->exists && $boardMember->imageUrl() && !$photo)
                            <div class="current-photo">
                                <img src="{{ $boardMember->imageUrl() }}" alt="{{ $boardMember->name }}" width="72" height="72" class="photo-preview">
                                <span class="current-photo-label">Current photo</span>
                            </div>
                        @endif

                        @if($photo)
                            <div class="current-photo">
                                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" width="72" height="72" class="photo-preview">
                                <span class="current-photo-label">New photo preview</span>
                            </div>
                        @endif

                        <div class="admin-form-group">
                            <input type="file" wire:model="photo" accept="image/jpeg,image/png,image/webp" class="admin-input admin-input-file @error('photo') admin-input-error @enderror">
                            @error('photo') <div class="admin-error">{{ $message }}</div> @enderror
                            <p class="admin-form-hint">JPEG, PNG or WebP. Max 2 MB.</p>
                        </div>

                        <div class="admin-form-actions">
                            <button wire:click="save" wire:loading.attr="disabled" class="admin-btn admin-btn-save">
                                <span wire:loading.remove wire:target="save">{{ $boardMember?->exists ? 'Save Changes' : 'Add Member' }}</span>
                                <span wire:loading wire:target="save">Saving...</span>
                            </button>
                            <a href="{{ route('admin.board-members') }}" class="admin-btn admin-btn-cancel">Cancel</a>
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
            margin: 0;
            letter-spacing: -0.025em;
        }

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

        .form-layout { max-width: 700px; }

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

        .admin-form-group { margin-bottom: 1.25rem; }

        .admin-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        @media (max-width: 600px) {
            .admin-form-row { grid-template-columns: 1fr; }
        }

        .admin-form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.375rem;
            font-size: 0.875rem;
            color: var(--gray-700);
        }

        .admin-required { color: var(--laravel-red); }

        .admin-input {
            display: block;
            width: 100%;
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
            font-family: inherit;
            line-height: 1.5;
            color: var(--gray-700);
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            box-sizing: border-box;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .admin-input:focus {
            border-color: var(--laravel-red);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(255, 45, 32, 0.1);
        }

        .admin-input-file {
            padding: 0.5rem;
            font-size: 0.85rem;
        }

        .admin-input-error { border-color: #dc2626; }
        .admin-error { color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem; }

        .admin-form-hint {
            font-size: 0.8rem;
            color: var(--gray-400);
            margin: 0.35rem 0 0;
        }

        .current-photo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .current-photo-label {
            font-size: 0.85rem;
            color: var(--gray-400);
        }

        .photo-preview {
            border-radius: 50%;
            object-fit: cover;
            display: block;
            border: 2px solid var(--gray-100);
        }

        .admin-form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            align-items: center;
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.75rem;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s, transform 0.1s;
        }

        .admin-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        .admin-btn-save {
            background: var(--laravel-red);
            color: white;
        }

        .admin-btn-save:hover:not(:disabled) {
            background: var(--laravel-red-dark);
            transform: translateY(-1px);
        }

        .admin-btn-cancel {
            background: white;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }

        .admin-btn-cancel:hover { background: var(--gray-50); }
    </style>
</div>
