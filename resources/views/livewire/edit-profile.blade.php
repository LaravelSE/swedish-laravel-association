<div class="page-container">
    <livewire:header />

    <section class="ep-main">
        <div class="ep-inner">
            <div class="ep-header">
                <div class="ep-title">$ profile --edit</div>
                <div class="ep-subtitle">// update your profile information</div>
            </div>

            <form wire:submit.prevent="save" class="ep-form">
                {{-- Profile Information --}}
                <div class="ep-section">
                    <div class="ep-section-label">// profile-information</div>

                    <div class="ep-field">
                        <label class="ep-label" for="name">name</label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            autocomplete="name"
                            class="tm-input @error('name') ep-input-error @enderror"
                        >
                        @error('name')
                            <div class="ep-error">[ERROR] {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ep-field">
                        <label class="ep-label" for="email">email</label>
                        <input
                            type="email"
                            id="email"
                            wire:model="email"
                            autocomplete="email"
                            class="tm-input @error('email') ep-input-error @enderror"
                        >
                        @error('email')
                            <div class="ep-error">[ERROR] {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ep-field">
                        <label class="ep-label" for="phone">
                            phone <span class="ep-optional">// optional</span>
                        </label>
                        <input
                            type="text"
                            id="phone"
                            wire:model="phone"
                            autocomplete="tel"
                            class="tm-input @error('phone') ep-input-error @enderror"
                        >
                        @error('phone')
                            <div class="ep-error">[ERROR] {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ep-field">
                        <label class="ep-label" for="city">
                            city <span class="ep-optional">// optional</span>
                        </label>
                        <input
                            type="text"
                            id="city"
                            wire:model="city"
                            autocomplete="address-level2"
                            class="tm-input @error('city') ep-input-error @enderror"
                        >
                        @error('city')
                            <div class="ep-error">[ERROR] {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="ep-field">
                        <label class="ep-label" for="company">
                            company <span class="ep-optional">// optional</span>
                        </label>
                        <input
                            type="text"
                            id="company"
                            wire:model="company"
                            autocomplete="organization"
                            class="tm-input @error('company') ep-input-error @enderror"
                        >
                        @error('company')
                            <div class="ep-error">[ERROR] {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Password Section --}}
                <div class="ep-section">
                    <div class="ep-password-header">
                        <div class="ep-section-label">// password</div>
                        <button
                            type="button"
                            class="btn btn-secondary ep-toggle-btn"
                            wire:click="toggleChangePassword"
                        >
                            <span>{{ $change_password ? '// cancel' : '$ change --password' }}</span>
                        </button>
                    </div>

                    @if($change_password)
                        <div class="ep-field">
                            <label class="ep-label" for="current_password">current-password</label>
                            <input
                                type="password"
                                id="current_password"
                                wire:model="current_password"
                                autocomplete="current-password"
                                class="tm-input @error('current_password') ep-input-error @enderror"
                            >
                            @error('current_password')
                                <div class="ep-error">[ERROR] {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="ep-field">
                            <label class="ep-label" for="password">new-password</label>
                            <input
                                type="password"
                                id="password"
                                wire:model="password"
                                autocomplete="new-password"
                                class="tm-input @error('password') ep-input-error @enderror"
                            >
                            @error('password')
                                <div class="ep-error">[ERROR] {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="ep-field">
                            <label class="ep-label" for="password_confirmation">confirm-new-password</label>
                            <input
                                type="password"
                                id="password_confirmation"
                                wire:model="password_confirmation"
                                autocomplete="new-password"
                                class="tm-input"
                            >
                        </div>
                    @endif
                </div>

                {{-- Form Actions --}}
                <div class="ep-actions">
                    <a href="{{ route('member') }}" class="ep-back-link">$ back --to-profile</a>
                    <button
                        type="submit"
                        class="btn btn-primary ep-submit-btn"
                        wire:loading.attr="disabled"
                        wire:loading.class="ep-btn-loading"
                    >
                        <span wire:loading.remove>$ save --changes</span>
                        <span wire:loading>// saving...</span>
                    </button>
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
            background: var(--tm-bg);
        }

        .ep-main {
            flex: 1;
            padding: 3rem 1.25rem 4rem;
        }

        .ep-inner {
            max-width: 640px;
            margin: 0 auto;
        }

        /* Header */
        .ep-header {
            margin-bottom: 2rem;
        }

        .ep-title {
            font-family: var(--font);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--tm-yellow);
            letter-spacing: 0.02em;
        }

        .ep-subtitle {
            font-family: var(--font);
            font-size: 0.875rem;
            color: var(--tm-muted);
            margin-top: 0.25rem;
        }

        /* Form card */
        .ep-form {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 4px;
            overflow: hidden;
        }

        /* Sections */
        .ep-section {
            padding: 1.75rem 2rem;
            border-bottom: 1px solid var(--tm-border);
        }

        .ep-section:last-of-type {
            border-bottom: none;
        }

        .ep-section-label {
            font-family: var(--font);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--tm-yellow);
            border-left: 2px solid var(--tm-yellow);
            padding-left: 0.625rem;
            margin-bottom: 1.25rem;
        }

        .ep-password-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            gap: 1rem;
        }

        .ep-password-header .ep-section-label {
            margin-bottom: 0;
        }

        .ep-toggle-btn {
            font-size: 0.75rem;
            padding: 0.3rem 0.75rem;
        }

        /* Fields */
        .ep-field {
            margin-bottom: 1.25rem;
        }

        .ep-field:last-child {
            margin-bottom: 0;
        }

        .ep-label {
            display: block;
            font-family: var(--font);
            font-size: 0.8125rem;
            color: var(--tm-text);
            margin-bottom: 0.5rem;
        }

        .ep-optional {
            font-family: var(--font);
            font-size: 0.75rem;
            color: var(--tm-muted);
        }

        .ep-input-error {
            border-color: #ff6b6b !important;
        }

        .ep-error {
            font-family: var(--font);
            font-size: 0.75rem;
            color: #ff6b6b;
            margin-top: 0.375rem;
        }

        /* Actions */
        .ep-actions {
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            background: var(--tm-bg);
            border-top: 1px solid var(--tm-border);
        }

        .ep-back-link {
            font-family: var(--font);
            font-size: 0.875rem;
            color: var(--tm-blue);
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .ep-back-link:hover {
            color: var(--tm-yellow);
        }

        .ep-submit-btn:disabled,
        .ep-btn-loading {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .ep-main {
                padding: 2rem 1rem 3rem;
            }

            .ep-section {
                padding: 1.25rem 1rem;
            }

            .ep-actions {
                padding: 1.25rem 1rem;
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .ep-submit-btn {
                width: 100%;
                justify-content: center;
            }

            .ep-back-link {
                text-align: center;
                display: block;
            }
        }
    </style>
</div>
