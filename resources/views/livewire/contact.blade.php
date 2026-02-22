<div>
    <section class="co-section" id="contact">
        <div class="co-page-header">
            <p class="co-command">$ contact --send</p>
            <p class="co-subtitle">Have questions or want to get involved? We'd love to hear from you.</p>
        </div>

        @if($showSuccessMessage)
            <div class="co-success">
                <span class="co-success-badge">[OK]</span> message delivered
            </div>
        @endif

        <form wire:submit.prevent="submitForm" class="co-form">
            <div class="co-form-row">
                <div class="co-form-group">
                    <label class="co-label" for="name">name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="tm-input co-input @error('name') co-input-error @enderror"
                        placeholder="your name"
                    >
                    @error('name')
                        <div class="co-field-error"><span class="co-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="co-form-group">
                    <label class="co-label" for="email">email</label>
                    <input
                        type="email"
                        id="email"
                        wire:model="email"
                        class="tm-input co-input @error('email') co-input-error @enderror"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <div class="co-field-error"><span class="co-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="co-form-group">
                <label class="co-label" for="message">message</label>
                <textarea
                    id="message"
                    wire:model="message"
                    class="tm-input co-input co-textarea @error('message') co-input-error @enderror"
                    rows="5"
                    placeholder="what would you like to tell us?"
                ></textarea>
                @error('message')
                    <div class="co-field-error"><span class="co-error-badge">[ERROR]</span> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary co-btn" wire:loading.attr="disabled">
                <span wire:loading.remove>$ send --message</span>
                <span wire:loading>// sending...</span>
            </button>
        </form>

        <div class="co-cta">
            <p>// know a Swedish Laravel company? <a href="{{ route('submit-company') }}" class="co-cta-link">$ company --register</a></p>
        </div>
    </section>

    <style>
        .co-section {
            margin-bottom: 7rem;
        }

        .co-page-header {
            max-width: 520px;
            margin: 0 auto 2.5rem;
        }

        .co-command {
            font-family: var(--font-mono);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--tm-yellow);
            margin-bottom: 0.5rem;
        }

        .co-subtitle {
            font-family: var(--font-mono);
            font-size: 0.875rem;
            color: var(--tm-muted);
        }

        .co-success {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--font-mono);
            font-size: 0.9375rem;
            color: #4ade80;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
            border-radius: var(--border-radius-sm);
            padding: 0.75rem 1rem;
            margin-bottom: 1.75rem;
        }

        .co-success-badge {
            font-weight: 700;
        }

        .co-form {
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            max-width: 520px;
            margin: 0 auto;
        }

        .co-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .co-form-group {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .co-label {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--tm-text);
            letter-spacing: 0.04em;
        }

        .co-input {
            /* extends .tm-input from terminal-midnight.css */
        }

        .co-input-error {
            border-color: var(--tm-red);
        }

        .co-input-error:focus {
            border-color: var(--tm-red);
            box-shadow: 0 0 0 2px rgb(255 107 107 / 0.15);
        }

        .co-textarea {
            resize: vertical;
            min-height: 120px;
        }

        .co-field-error {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--tm-red);
        }

        .co-error-badge {
            font-weight: 700;
        }

        .co-btn {
            align-self: flex-start;
        }

        .co-btn:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        .co-cta {
            margin-top: 2rem;
            padding-top: 1.75rem;
            border-top: 1px solid var(--tm-border);
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .co-cta p {
            font-family: var(--font-mono);
            font-size: 0.8125rem;
            color: var(--tm-muted);
        }

        .co-cta-link {
            color: var(--tm-yellow);
            text-decoration: none;
            transition: opacity var(--transition-fast);
        }

        .co-cta-link:hover {
            opacity: 0.8;
        }

        @media (max-width: 640px) {
            .co-form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</div>
