<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: var(--spacing-12);">
        <div class="section-header">
            <h2 class="section-title">Submit a Talk</h2>
            <p class="section-subtitle">Want to share your knowledge at a Laravel Sweden meetup? Submit your talk proposal below!</p>
        </div>

        @if($submitted)
            <div class="success-card">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3>Thank you for your submission!</h3>
                <p>We've received your talk proposal and will review it shortly. We'll be in touch soon!</p>
                <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: var(--spacing-6);">Back to Home</a>
            </div>
        @else
            <div class="form-card">
                <form wire:submit.prevent="submit" class="submit-form">
                    @if(!$isLoggedIn)
                        <div class="form-section">
                            <div class="form-section-header">
                                <h3 class="form-section-title">Create Account</h3>
                                <p class="form-section-description">Create an account to submit your talk. Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                            </div>

                            <div class="form-group">
                                <label for="name">Name <span class="required">*</span></label>
                                <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" autofocus>
                                @error('name') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="required">*</span></label>
                                <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                                @error('email') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone (optional)</label>
                                <input type="tel" maxlength="20" id="phone" wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="password">Password <span class="required">*</span></label>
                                    <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
                                    <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="logged-in-notice">
                            <p>Submitting as <strong>{{ $user->name }}</strong> ({{ $user->email }})</p>
                        </div>
                    @endif

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">Talk Details</h3>
                        </div>

                        <div class="form-group">
                            <label for="title">Title <span class="required">*</span></label>
                            <input type="text" id="title" wire:model="title" class="form-control @error('title') is-invalid @enderror" placeholder="e.g. Building Scalable APIs with Laravel">
                            @error('title') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description <span class="required">*</span></label>
                            <textarea id="description" wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Describe your talk - what will attendees learn? What topics will you cover?"></textarea>
                            @error('description') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label>Which meetup cities? <span class="required">*</span></label>
                            <div class="checkbox-group">
                                @foreach($availableCities as $city)
                                    <label class="checkbox-label">
                                        <input type="checkbox" wire:model="cities" value="{{ $city }}">
                                        <span>{{ $city }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('cities') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">About You</h3>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="position">Position <span class="required">*</span></label>
                                <input type="text" id="position" wire:model="position" class="form-control @error('position') is-invalid @enderror" placeholder="e.g. Senior Developer">
                                @error('position') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="company">Company (optional)</label>
                                <input type="text" id="company" wire:model="company" class="form-control @error('company') is-invalid @enderror">
                                @error('company') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">Social Links (optional)</h3>
                            <p class="form-section-description">Share your social profiles so attendees can connect with you.</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="twitter">Twitter / X</label>
                                <input type="url" id="twitter" wire:model="twitter" class="form-control @error('twitter') is-invalid @enderror" placeholder="https://twitter.com/username">
                                @error('twitter') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="url" id="linkedin" wire:model="linkedin" class="form-control @error('linkedin') is-invalid @enderror" placeholder="https://linkedin.com/in/username">
                                @error('linkedin') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="github">GitHub</label>
                                <input type="url" id="github" wire:model="github" class="form-control @error('github') is-invalid @enderror" placeholder="https://github.com/username">
                                @error('github') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="bluesky">Bluesky</label>
                                <input type="url" id="bluesky" wire:model="bluesky" class="form-control @error('bluesky') is-invalid @enderror" placeholder="https://bsky.app/profile/username">
                                @error('bluesky') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="url" id="facebook" wire:model="facebook" class="form-control @error('facebook') is-invalid @enderror" placeholder="https://facebook.com/username">
                                @error('facebook') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="url" id="instagram" wire:model="instagram" class="form-control @error('instagram') is-invalid @enderror" placeholder="https://instagram.com/username">
                                @error('instagram') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">Additional Notes (optional)</h3>
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea id="notes" wire:model="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Any additional information you'd like to share with us?"></textarea>
                            @error('notes') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                            <span wire:loading.remove>Submit Talk Proposal</span>
                            <span wire:loading>Submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
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

        .form-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-10);
            max-width: 720px;
            margin: 0 auto;
        }

        .submit-form {
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
            margin-bottom: 0;
            padding-bottom: 0;
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

        .form-section-description {
            color: var(--gray-500);
            margin-top: var(--spacing-2);
            font-size: 0.9375rem;
        }

        .form-section-description a {
            color: var(--gray-900);
            font-weight: 600;
            text-decoration: none;
        }

        .form-section-description a:hover {
            text-decoration: underline;
        }

        .form-group {
            margin-bottom: var(--spacing-5);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--spacing-5);
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-card {
                padding: var(--spacing-6);
            }
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

        .form-control::placeholder {
            color: var(--gray-400);
        }

        .form-control:focus {
            border-color: var(--gray-900);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(24, 24, 27, 0.08);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        .required {
            color: #ef4444;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-4);
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            cursor: pointer;
            font-weight: normal;
            margin-bottom: 0;
            font-size: 0.9375rem;
            color: var(--gray-700);
        }

        .checkbox-label input[type="checkbox"] {
            width: 1.125rem;
            height: 1.125rem;
            accent-color: var(--gray-900);
            border-radius: 4px;
        }

        .logged-in-notice {
            background-color: var(--gray-50);
            padding: var(--spacing-4) var(--spacing-5);
            border-radius: var(--border-radius-lg);
            margin-bottom: var(--spacing-8);
            border: 1px solid var(--gray-100);
        }

        .logged-in-notice p {
            margin: 0;
            color: var(--gray-600);
            font-size: 0.9375rem;
        }

        .btn-lg {
            padding: 0.75rem 2rem;
            font-size: 1rem;
        }

        .form-submit-row {
            text-align: center;
            margin-top: var(--spacing-8);
        }

        .success-card {
            max-width: 520px;
            margin: 0 auto;
            text-align: center;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-12) var(--spacing-8);
        }

        .success-icon {
            color: #16a34a;
            margin-bottom: var(--spacing-6);
        }

        .success-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: var(--spacing-3);
            color: var(--gray-900);
            letter-spacing: -0.02em;
        }

        .success-card p {
            color: var(--gray-500);
            font-size: 1.0625rem;
        }
    </style>
</div>
