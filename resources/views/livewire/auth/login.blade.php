<div class="page-container">
    @livewire('header')

    <section class="lg-section main-content">
        <div class="lg-card">
            <div class="lg-header">
                <p class="lg-comment">// auth --login</p>
                <p class="lg-subtitle">authenticate to access your member account</p>
            </div>

            <form wire:submit.prevent="login" class="lg-form">
                <div class="lg-form-group">
                    <label class="lg-label" for="email">email</label>
                    <input type="email" id="email" wire:model="email"
                        class="tm-input lg-input @error('email') lg-input-error @enderror"
                        autofocus autocomplete="username">
                    @error('email')
                        <div class="lg-field-error"><span class="lg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="lg-form-group">
                    <label class="lg-label" for="password">password</label>
                    <input type="password" id="password" wire:model="password"
                        class="tm-input lg-input @error('password') lg-input-error @enderror"
                        autocomplete="current-password">
                    @error('password')
                        <div class="lg-field-error"><span class="lg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="lg-form-group lg-remember">
                    <label class="lg-checkbox-label">
                        <input type="checkbox" wire:model="remember" style="accent-color: var(--tm-yellow);">
                        <span class="lg-remember-text">// remember-session</span>
                    </label>
                </div>

                <div class="lg-form-group">
                    <button type="submit" class="lg-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>$ login --user</span>
                        <span wire:loading>// authenticating...</span>
                    </button>
                </div>
            </form>

            <div class="lg-divider"></div>

            <div class="lg-links">
                <a href="{{ route('password.request') }}" class="lg-link">$ forgot --password</a>
                <a href="{{ route('register') }}" class="lg-link">$ register --new-user</a>
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

        .lg-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-12) var(--spacing-4);
        }

        .lg-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 4px;
            padding: var(--spacing-8);
            width: 100%;
            max-width: 480px;
        }

        .lg-header {
            margin-bottom: var(--spacing-8);
        }

        .lg-comment {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 1.1rem;
            color: var(--tm-muted);
            margin: 0 0 var(--spacing-2);
        }

        .lg-subtitle {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-muted);
            margin: 0;
            opacity: 0.7;
        }

        .lg-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-5);
        }

        .lg-form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-1);
        }

        .lg-label {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-text);
            text-transform: lowercase;
        }

        .lg-input {
            width: 100%;
        }

        .lg-input-error {
            border-color: #ff6b6b !important;
        }

        .lg-field-error {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.78rem;
            color: #ff6b6b;
            margin-top: var(--spacing-1);
        }

        .lg-error-badge {
            font-weight: 700;
        }

        .lg-remember {
            flex-direction: row;
            align-items: center;
        }

        .lg-checkbox-label {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            cursor: pointer;
        }

        .lg-remember-text {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.78rem;
            color: var(--tm-muted);
        }

        .lg-btn {
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

        .lg-btn:hover:not(:disabled) {
            background: var(--tm-yellow);
            color: var(--tm-bg);
        }

        .lg-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .lg-divider {
            border: none;
            border-top: 1px solid var(--tm-border);
            margin: var(--spacing-6) 0;
        }

        .lg-links {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
            align-items: flex-start;
        }

        .lg-link {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.82rem;
            color: var(--tm-blue);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .lg-link:hover {
            color: var(--tm-yellow);
        }

        @media (max-width: 480px) {
            .lg-card {
                padding: var(--spacing-6) var(--spacing-4);
            }
        }
    </style>
</div>
