<div class="page-container">
    @livewire('header')

    <section class="rp-section main-content">
        <div class="rp-card">
            <div class="rp-header">
                <p class="rp-comment">$ set --new-password</p>
                <p class="rp-subtitle">enter a new password for your account</p>
            </div>

            <form wire:submit.prevent="resetPassword" class="rp-form">
                <input type="hidden" wire:model="token">

                <div class="rp-form-group">
                    <label class="rp-label" for="email">email</label>
                    <input type="email" id="email" wire:model="email"
                        class="tm-input rp-input @error('email') rp-input-error @enderror"
                        autofocus autocomplete="username">
                    @error('email')
                        <div class="rp-field-error"><span class="rp-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rp-form-group">
                    <label class="rp-label" for="password">new password</label>
                    <input type="password" id="password" wire:model="password"
                        class="tm-input rp-input @error('password') rp-input-error @enderror"
                        autocomplete="new-password">
                    @error('password')
                        <div class="rp-field-error"><span class="rp-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rp-form-group">
                    <label class="rp-label" for="password_confirmation">confirm new password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                        class="tm-input rp-input"
                        autocomplete="new-password">
                </div>

                <div class="rp-form-group">
                    <button type="submit" class="btn btn-primary rp-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>$ reset --password</span>
                        <span wire:loading>// resetting...</span>
                    </button>
                </div>
            </form>

            <div class="rp-divider"></div>

            <div class="rp-links">
                <a href="{{ route('login') }}" class="rp-link">$ back --to-login</a>
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

        .rp-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-12) var(--spacing-4);
            width: 100%;
        }

        .rp-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 4px;
            padding: var(--spacing-8);
            width: 100%;
            max-width: 480px;
        }

        .rp-header {
            margin-bottom: var(--spacing-8);
        }

        .rp-comment {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--tm-yellow);
            margin: 0 0 var(--spacing-2);
        }

        .rp-subtitle {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-muted);
            margin: 0;
        }

        .rp-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-5);
        }

        .rp-form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-1);
        }

        .rp-label {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-text);
            text-transform: lowercase;
        }

        .rp-input {
            width: 100%;
        }

        .rp-input-error {
            border-color: #ff6b6b !important;
        }

        .rp-field-error {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.78rem;
            color: #ff6b6b;
            margin-top: var(--spacing-1);
        }

        .rp-error-badge {
            font-weight: 700;
        }

        .rp-btn {
            width: 100%;
            justify-content: center;
        }

        .rp-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .rp-divider {
            border: none;
            border-top: 1px solid var(--tm-border);
            margin: var(--spacing-6) 0;
        }

        .rp-links {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
            align-items: flex-start;
        }

        .rp-link {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.82rem;
            color: var(--tm-blue);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .rp-link:hover {
            color: var(--tm-yellow);
        }

        @media (max-width: 480px) {
            .rp-card {
                padding: var(--spacing-6) var(--spacing-4);
            }
        }
    </style>
</div>
