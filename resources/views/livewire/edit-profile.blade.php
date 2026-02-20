<div class="page-container">
    <livewire:header />

    <section class="section main-content" style="padding-top: var(--spacing-12);">
        <div class="section-header">
            <h2 class="section-title">Edit Profile</h2>
            <p class="section-subtitle">Update your profile information</p>
        </div>

        <div class="form-card">
            <form wire:submit.prevent="save" class="edit-form">
                <div class="form-section">
                    <div class="form-section-header">
                        <h3 class="form-section-title">Profile Information</h3>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone (optional)</label>
                        <input type="text" id="phone" wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="city">City (optional)</label>
                        <input type="text" id="city" wire:model="city" class="form-control @error('city') is-invalid @enderror">
                        @error('city') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="company">Company (optional)</label>
                        <input type="text" id="company" wire:model="company" class="form-control @error('company') is-invalid @enderror">
                        @error('company') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-section">
                    <div class="password-section-header">
                        <h3 class="form-section-title">Password</h3>
                        <button type="button" class="btn btn-secondary btn-sm-toggle" wire:click="toggleChangePassword">
                            {{ $change_password ? 'Cancel' : 'Change Password' }}
                        </button>
                    </div>

                    @if($change_password)
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" id="current_password" wire:model="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                            @error('password') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control">
                        </div>
                    @endif
                </div>

                <div class="form-actions">
                    <a href="{{ route('member') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </section>

    <livewire:footer />

    <style>
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
        }

        .form-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-10);
            max-width: 640px;
            margin: 0 auto;
        }

        .edit-form {
            display: flex;
            flex-direction: column;
        }

        .form-section {
            margin-bottom: var(--spacing-8);
            padding-bottom: var(--spacing-8);
            border-bottom: 1px solid var(--gray-100);
        }

        .form-section:last-of-type {
            border-bottom: none;
        }

        .form-section-header {
            margin-bottom: var(--spacing-6);
        }

        .form-section-title {
            font-size: 1.0625rem;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.02em;
        }

        .password-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-5);
        }

        .btn-sm-toggle {
            padding: 0.375rem 0.875rem;
            font-size: 0.8125rem;
        }

        .form-group {
            margin-bottom: var(--spacing-5);
        }

        label {
            display: block;
            margin-bottom: var(--spacing-2);
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--gray-700);
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.625rem 0.875rem;
            font-size: 0.9375rem;
            font-family: inherit;
            line-height: 1.5;
            color: var(--gray-900);
            background-color: white;
            border: 1px solid var(--gray-300);
            border-radius: var(--border-radius-lg);
            transition: border-color var(--transition-fast), box-shadow var(--transition-fast);
        }

        .form-control:focus {
            border-color: var(--gray-900);
            outline: none;
            box-shadow: 0 0 0 3px rgba(24, 24, 27, 0.08);
        }

        .is-invalid {
            border-color: #ef4444;
        }

        .is-invalid:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .error-message {
            color: #ef4444;
            font-size: 0.8125rem;
            margin-top: var(--spacing-1);
        }

        .form-actions {
            display: flex;
            gap: var(--spacing-3);
            justify-content: flex-end;
            padding-top: var(--spacing-4);
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border: none;
            border-radius: var(--border-radius-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--gray-900);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--gray-800);
        }

        .btn-secondary {
            background-color: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-secondary:hover {
            background-color: var(--gray-50);
            border-color: var(--gray-400);
        }

        @media (max-width: 768px) {
            .form-card {
                padding: var(--spacing-6);
            }
        }
    </style>
</div>
