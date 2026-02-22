<div class="page-container">
    @livewire('header')

    <section class="fp-section main-content">
        <div class="fp-card">
            <div class="fp-header">
                <p class="fp-comment">// auth --reset-password</p>
                <p class="fp-subtitle">enter your email to receive a password reset link</p>
            </div>

            @if ($emailSentMessage)
                <div class="fp-success">
                    <span class="fp-ok-badge">[OK]</span> reset link sent — please check your inbox
                </div>
            @else
                <form wire:submit.prevent="sendResetLink" class="fp-form">
                    <div class="fp-form-group">
                        <label class="fp-label" for="email">email</label>
                        <input type="email" id="email" wire:model="email"
                            class="tm-input fp-input @error('email') fp-input-error @enderror"
                            autofocus autocomplete="username">
                        @error('email')
                            <div class="fp-field-error"><span class="fp-error-badge">[ERROR]</span> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="fp-form-group">
                        <button type="submit" class="fp-btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>$ send --reset-link</span>
                            <span wire:loading>// sending...</span>
                        </button>
                    </div>
                </form>
            @endif

            <div class="fp-divider"></div>

            <div class="fp-links">
                <a href="{{ route('login') }}" class="fp-link">$ back --to-login</a>
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

        .fp-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-12) var(--spacing-4);
        }

        .fp-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 4px;
            padding: var(--spacing-8);
            width: 100%;
            max-width: 480px;
        }

        .fp-header {
            margin-bottom: var(--spacing-8);
        }

        .fp-comment {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 1.1rem;
            color: var(--tm-muted);
            margin: 0 0 var(--spacing-2);
        }

        .fp-subtitle {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-muted);
            margin: 0;
            opacity: 0.7;
        }

        .fp-success {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.88rem;
            color: #4ade80;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.25);
            border-radius: 2px;
            padding: var(--spacing-4);
            margin-bottom: var(--spacing-6);
        }

        .fp-ok-badge {
            font-weight: 700;
        }

        .fp-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-5);
        }

        .fp-form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-1);
        }

        .fp-label {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-text);
            text-transform: lowercase;
        }

        .fp-input {
            width: 100%;
        }

        .fp-input-error {
            border-color: #ff6b6b !important;
        }

        .fp-field-error {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.78rem;
            color: #ff6b6b;
            margin-top: var(--spacing-1);
        }

        .fp-error-badge {
            font-weight: 700;
        }

        .fp-btn {
            width: 100%;
            padding: var(--spacing-3) var(--spacing-4);
            background: transparent;
            border: 1px solid var(--tm-yellow);
            color: var(--tm-yellow);
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.9rem;
            cursor: pointer;
            border-radius: 2px;
            transition: background 0.15s ease, color 0.15s ease;
            text-align: center;
        }

        .fp-btn:hover:not(:disabled) {
            background: var(--tm-yellow);
            color: var(--tm-bg);
        }

        .fp-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .fp-divider {
            border: none;
            border-top: 1px solid var(--tm-border);
            margin: var(--spacing-6) 0;
        }

        .fp-links {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
            align-items: flex-start;
        }

        .fp-link {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.82rem;
            color: var(--tm-blue);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .fp-link:hover {
            color: var(--tm-yellow);
        }

        @media (max-width: 480px) {
            .fp-card {
                padding: var(--spacing-6) var(--spacing-4);
            }
        }
    </style>
</div>
