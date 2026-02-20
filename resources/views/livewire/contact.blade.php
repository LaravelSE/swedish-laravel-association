<div>
    <section class="section" id="contact">
        <div class="section-header">
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">Have questions or want to get involved? We'd love to hear from you.</p>
        </div>
        <div class="contact-wrapper">
            <div class="contact-card">
                <div class="contact-intro">
                    <div class="contact-icon-wrap">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <h3 class="contact-card-title">Contact Us</h3>
                    <p class="contact-card-desc">For questions, partnership opportunities, or if you want to get involved with the association.</p>
                </div>

                @if($showSuccessMessage)
                    <div class="alert-success-msg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                        <p>Thank you for your message! We'll get back to you soon.</p>
                    </div>
                @endif

                <form wire:submit.prevent="submitForm" class="contact-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your name">
                        @error('name') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com">
                        @error('email') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" wire:model="message" class="form-control @error('message') is-invalid @enderror" rows="5" placeholder="What would you like to tell us?"></textarea>
                        @error('message') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary btn-contact-submit" wire:loading.attr="disabled">
                            <span wire:loading.remove>Send Message</span>
                            <span wire:loading>Sending...</span>
                        </button>
                    </div>
                </form>

                <div class="contact-footer-cta">
                    <h4>Know a Swedish Laravel Company?</h4>
                    <p>Help us build a comprehensive directory of Laravel companies in Sweden.</p>
                    <a href="https://forms.gle/6NPAM4EdPRqe2x9g9" class="community-link" target="_blank" rel="noopener noreferrer">
                        Submit Company
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-wrapper {
            max-width: 560px;
            margin: 0 auto;
        }

        .contact-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-10);
        }

        .contact-intro {
            text-align: center;
            margin-bottom: var(--spacing-8);
        }

        .contact-icon-wrap {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--gray-100);
            color: var(--gray-600);
            margin: 0 auto var(--spacing-4);
        }

        .contact-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
            letter-spacing: -0.02em;
        }

        .contact-card-desc {
            color: var(--gray-500);
            font-size: 0.9375rem;
            line-height: 1.65;
        }

        .alert-success-msg {
            display: flex;
            align-items: flex-start;
            gap: var(--spacing-3);
            background: #ecfdf5;
            color: #065f46;
            padding: var(--spacing-4);
            border-radius: var(--border-radius-lg);
            margin-bottom: var(--spacing-6);
            font-size: 0.9375rem;
            border: 1px solid #bbf7d0;
        }

        .alert-success-msg svg {
            flex-shrink: 0;
            margin-top: 2px;
            color: #16a34a;
        }

        .alert-success-msg p {
            margin: 0;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-5);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-2);
        }

        .form-group label {
            font-size: 0.8125rem;
            font-weight: 600;
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

        .form-control::placeholder {
            color: var(--gray-400);
        }

        .form-control:focus {
            border-color: var(--gray-900);
            outline: none;
            box-shadow: 0 0 0 3px rgba(24, 24, 27, 0.08);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
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
        }

        .form-submit-row {
            padding-top: var(--spacing-2);
        }

        .btn-contact-submit {
            width: 100%;
            justify-content: center;
            padding: 0.75rem 1.5rem;
        }

        .contact-footer-cta {
            margin-top: var(--spacing-8);
            padding-top: var(--spacing-8);
            border-top: 1px solid var(--gray-200);
            text-align: center;
        }

        .contact-footer-cta h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
        }

        .contact-footer-cta p {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin-bottom: var(--spacing-4);
        }

        .community-link {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-1);
            color: var(--gray-900);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: gap var(--transition-fast);
        }

        .community-link:hover {
            gap: var(--spacing-2);
        }
    </style>
</div>
