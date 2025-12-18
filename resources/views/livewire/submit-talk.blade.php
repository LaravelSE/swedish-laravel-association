<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Submit a Talk</h2>
            <p class="section-subtitle">Want to share your knowledge at a Laravel Sweden meetup? Submit your talk proposal below!</p>
        </div>

        @if($submitted)
            <div class="card success-card" style="max-width: 600px; margin: 0 auto; text-align: center;">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </div>
                <h3>Thank you for your submission!</h3>
                <p>We've received your talk proposal and will review it shortly. We'll be in touch soon!</p>
                <a href="{{ route('home') }}" class="btn btn-primary" style="margin-top: 1.5rem;">Back to Home</a>
            </div>
        @else
            <div class="card" style="max-width: 700px; margin: 0 auto;">
                <form wire:submit.prevent="submit" class="submit-talk-form">
                    @if(!$isLoggedIn)
                        <div class="form-section">
                            <h3 class="form-section-title">Create Account</h3>
                            <p class="form-section-description">Create an account to submit your talk. Already have an account? <a href="{{ route('login') }}">Log in</a></p>

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
                        <h3 class="form-section-title">Talk Details</h3>

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
                        <h3 class="form-section-title">About You</h3>

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
                        <h3 class="form-section-title">Social Links (optional)</h3>
                        <p class="form-section-description">Share your social profiles so attendees can connect with you.</p>

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
                        <h3 class="form-section-title">Additional Notes (optional)</h3>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea id="notes" wire:model="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Any additional information you'd like to share with us?"></textarea>
                            @error('notes') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-group" style="text-align: center; margin-top: 2rem;">
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

        .submit-talk-form {
            margin: 2rem 0;
        }

        .form-section {
            margin-bottom: 2.5rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .form-section:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .form-section-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--gray-900);
        }

        .form-section-description {
            color: var(--gray-600);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        @media (max-width: 600px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #FF2D20;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 32, 0.25);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .required {
            color: #dc3545;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            font-weight: normal;
            margin-bottom: 0;
        }

        .checkbox-label input[type="checkbox"] {
            width: 1.25rem;
            height: 1.25rem;
            accent-color: #FF2D20;
        }

        .logged-in-notice {
            background-color: var(--gray-100);
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
        }

        .logged-in-notice p {
            margin: 0;
            color: var(--gray-700);
        }

        .btn-lg {
            padding: 0.875rem 2rem;
            font-size: 1.1rem;
        }

        .success-card {
            padding: 3rem 2rem;
        }

        .success-icon {
            color: #28a745;
            margin-bottom: 1.5rem;
        }

        .success-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--gray-900);
        }

        .success-card p {
            color: var(--gray-600);
            font-size: 1.1rem;
        }
    </style>
</div>
