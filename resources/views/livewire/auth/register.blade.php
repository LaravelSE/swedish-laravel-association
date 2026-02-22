<div class="page-container">
    @livewire('header')

    <section class="rg-section main-content">
        <div class="rg-card">
            <div class="rg-header">
                <p class="rg-comment">// auth --register</p>
                <p class="rg-subtitle">create a new member account</p>
            </div>

            <form wire:submit.prevent="register" class="rg-form">
                <div class="rg-form-group">
                    <label class="rg-label" for="name">name</label>
                    <input type="text" id="name" wire:model="name"
                        class="tm-input rg-input @error('name') rg-input-error @enderror"
                        autofocus autocomplete="name">
                    @error('name')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="email">email</label>
                    <input type="email" id="email" wire:model="email"
                        class="tm-input rg-input @error('email') rg-input-error @enderror"
                        autocomplete="username">
                    @error('email')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="phone">phone <span class="rg-optional">// optional</span></label>
                    <input type="tel" id="phone" wire:model="phone" maxlength="20"
                        class="tm-input rg-input @error('phone') rg-input-error @enderror"
                        autocomplete="tel">
                    @error('phone')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="city">city <span class="rg-optional">// optional</span></label>
                    <input type="text" id="city" wire:model="city" maxlength="150"
                        class="tm-input rg-input @error('city') rg-input-error @enderror"
                        autocomplete="address-level2">
                    @error('city')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="company">company <span class="rg-optional">// optional</span></label>
                    <input type="text" id="company" wire:model="company" maxlength="150"
                        class="tm-input rg-input @error('company') rg-input-error @enderror"
                        autocomplete="organization">
                    @error('company')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="password">password</label>
                    <input type="password" id="password" wire:model="password"
                        class="tm-input rg-input @error('password') rg-input-error @enderror"
                        autocomplete="new-password">
                    @error('password')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="password_confirmation">confirm-password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                        class="tm-input rg-input"
                        autocomplete="new-password">
                </div>

                <div class="rg-form-group">
                    <button type="submit" class="rg-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>$ register --user</span>
                        <span wire:loading>// registering...</span>
                    </button>
                </div>
            </form>

            <div class="rg-divider"></div>

            <div class="rg-links">
                <a href="{{ route('login') }}" class="rg-link">$ login --existing-user</a>
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

        .rg-section {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--spacing-12) var(--spacing-4);
        }

        .rg-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 4px;
            padding: var(--spacing-8);
            width: 100%;
            max-width: 520px;
        }

        .rg-header {
            margin-bottom: var(--spacing-8);
        }

        .rg-comment {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 1.1rem;
            color: var(--tm-muted);
            margin: 0 0 var(--spacing-2);
        }

        .rg-subtitle {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-muted);
            margin: 0;
            opacity: 0.7;
        }

        .rg-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-5);
        }

        .rg-form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-1);
        }

        .rg-label {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.8rem;
            color: var(--tm-text);
            text-transform: lowercase;
        }

        .rg-optional {
            font-size: 0.72rem;
            color: var(--tm-muted);
            opacity: 0.7;
        }

        .rg-input {
            width: 100%;
        }

        .rg-input-error {
            border-color: #ff6b6b !important;
        }

        .rg-field-error {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.78rem;
            color: #ff6b6b;
            margin-top: var(--spacing-1);
        }

        .rg-error-badge {
            font-weight: 700;
        }

        .rg-btn {
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

        .rg-btn:hover:not(:disabled) {
            background: var(--tm-yellow);
            color: var(--tm-bg);
        }

        .rg-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .rg-divider {
            border: none;
            border-top: 1px solid var(--tm-border);
            margin: var(--spacing-6) 0;
        }

        .rg-links {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
            align-items: flex-start;
        }

        .rg-link {
            font-family: 'JetBrains Mono', 'Fira Code', monospace;
            font-size: 0.82rem;
            color: var(--tm-blue);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .rg-link:hover {
            color: var(--tm-yellow);
        }

        @media (max-width: 480px) {
            .rg-card {
                padding: var(--spacing-6) var(--spacing-4);
            }
        }
    </style>
</div>
