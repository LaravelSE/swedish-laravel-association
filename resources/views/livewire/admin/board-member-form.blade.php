<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">{{ $boardMember?->exists ? 'Edit: '.$boardMember->name : 'New Board Member' }}</h1>
            <p class="admin-page-desc">
                <a href="{{ route('admin.board-members') }}">&larr; Back to list</a>
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
    </div>

    
</div>
