<div class="page-container">
    <livewire:header />

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Edit Profile</h2>
            <p class="section-subtitle">Update your profile information</p>
        </div>

        <div class="card" style="max-width: 800px; margin: 0 auto;">
            <div class="edit-profile">
                <form wire:submit.prevent="save">
                    <h3>Profile Information</h3>

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

                    <div class="section-divider"></div>

                    <div class="password-section">
                        <h3>Password</h3>
                        <button type="button" class="btn btn-secondary" wire:click="toggleChangePassword">
                            {{ $change_password ? 'Cancel Password Change' : 'Change Password' }}
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

                    <div class="section-divider"></div>

                    <div class="form-actions">
                        <a href="{{ route('member') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
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

        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--gray-600);
        }

        .card {
            min-width: 600px;
        }

        .edit-profile {
            padding: 2rem;
        }

        .edit-profile h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--laravel-red);
            box-shadow: 0 0 0 3px rgba(255, 45, 32, 0.2);
        }

        .is-invalid {
            border-color: #dc2626;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .section-divider {
            height: 1px;
            background-color: var(--gray-200);
            margin: 2rem 0;
        }

        .password-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background-color: var(--laravel-red);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--laravel-red-dark);
        }

        .btn-secondary {
            background-color: var(--gray-200);
            color: var(--gray-700);
        }

        .btn-secondary:hover {
            background-color: var(--gray-300);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card {
                min-width: auto;
            }
        }
    </style>
</div>
