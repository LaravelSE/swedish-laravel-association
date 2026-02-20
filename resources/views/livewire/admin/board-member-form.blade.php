<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">{{ $boardMember?->exists ? 'Edit: '.$boardMember->name : 'New Board Member' }}</h2>
            <p class="section-subtitle">
                <a href="{{ route('admin.board-members') }}">&larr; Back to list</a>
            </p>
        </div>

        @if(session('message'))
            <div class="flash-message" style="max-width: 600px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="card" style="max-width: 600px; margin: 0 auto;">

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Name <span class="required">*</span></label>
                    <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Role <span class="required">*</span></label>
                    <input type="text" wire:model="role" class="form-control @error('role') is-invalid @enderror" placeholder="Ordförande">
                    @error('role') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Company</label>
                    <input type="text" wire:model="company" class="form-control @error('company') is-invalid @enderror" placeholder="Company name">
                    @error('company') <div class="error-message">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Sort Order <span class="required">*</span></label>
                    <input type="number" wire:model="sortOrder" class="form-control @error('sortOrder') is-invalid @enderror" min="0">
                    @error('sortOrder') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Photo</label>

                @if($boardMember?->exists && $boardMember->imageUrl() && !$photo)
                    <div class="current-photo">
                        <img src="{{ $boardMember->imageUrl() }}" alt="{{ $boardMember->name }}" width="80" height="80" class="photo-preview">
                        <span class="current-photo-label">Current photo</span>
                    </div>
                @endif

                @if($photo)
                    <img src="{{ $photo->temporaryUrl() }}" alt="Preview" width="80" height="80" class="photo-preview">
                @endif

                <input type="file" wire:model="photo" accept="image/jpeg,image/png,image/webp" class="form-control @error('photo') is-invalid @enderror">
                @error('photo') <div class="error-message">{{ $message }}</div> @enderror
                <p class="field-hint">JPEG, PNG or WebP. Max 2 MB.</p>
            </div>

            <div class="action-buttons">
                <button wire:click="save" wire:loading.attr="disabled" class="btn btn-save">
                    <span wire:loading.remove wire:target="save">{{ $boardMember?->exists ? 'Save Changes' : 'Add Member' }}</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
                <a href="{{ route('admin.board-members') }}" class="btn btn-cancel">Cancel</a>
            </div>

        </div>
    </section>

    @livewire('footer')

    <style>
        .page-container { display: flex; flex-direction: column; min-height: 100vh; }
        .main-content { flex: 1; }

        .form-group { margin-bottom: 1rem; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            color: var(--gray-700);
        }

        .required { color: #FF2D20; }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #FF2D20;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 32, 0.25);
        }

        .form-control.is-invalid { border-color: #dc3545; }
        .error-message { color: #dc3545; font-size: 0.85rem; margin-top: 0.25rem; }

        .current-photo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .current-photo-label {
            font-size: 0.85rem;
            color: var(--gray-500);
        }

        .photo-preview {
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin-bottom: 0.75rem;
        }

        .field-hint {
            font-size: 0.8rem;
            color: var(--gray-500);
            margin-top: 0.25rem;
            margin-bottom: 0;
        }

        .action-buttons { display: flex; gap: 1rem; margin-top: 1.5rem; align-items: center; }

        .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .btn-save { background-color: #FF2D20; color: white; }
        .btn-save:hover:not(:disabled) { background-color: #e0261b; }

        .btn-cancel { background-color: var(--gray-100, #f3f4f6); color: var(--gray-700); }
        .btn-cancel:hover { background-color: var(--gray-200, #e5e7eb); }

        .flash-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .section-subtitle a { color: #FF2D20; text-decoration: none; }
        .section-subtitle a:hover { text-decoration: underline; }
    </style>
</div>
