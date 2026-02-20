<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: var(--spacing-12);">
        <div class="section-header">
            <h2 class="section-title">Submit a Company</h2>
            <p class="section-subtitle">Know a company using Laravel in Sweden? Submit it to our directory!</p>
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
                <p>We'll review the company listing and publish it once approved.</p>
                <a href="{{ route('companies') }}" class="btn btn-primary" style="margin-top: var(--spacing-6);">View Companies</a>
            </div>
        @else
            <div class="form-card">
                <form wire:submit.prevent="submit" class="submit-form">
                    @if(!$isLoggedIn)
                        <div class="form-section">
                            <div class="form-section-header">
                                <h3 class="form-section-title">Create Account</h3>
                                <p class="form-section-description">Create an account to submit a company. Already have an account? <a href="{{ route('login') }}">Log in</a></p>
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
                                <label for="userPhone">Phone (optional)</label>
                                <input type="tel" maxlength="20" id="userPhone" wire:model="userPhone" class="form-control @error('userPhone') is-invalid @enderror">
                                @error('userPhone') <div class="error-message">{{ $message }}</div> @enderror
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
                            <h3 class="form-section-title">Company Details</h3>
                        </div>

                        <div class="form-group">
                            <label for="companyName">Company Name <span class="required">*</span></label>
                            <input type="text" id="companyName" wire:model="companyName" class="form-control @error('companyName') is-invalid @enderror" placeholder="e.g. Acme AB">
                            @error('companyName') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City <span class="required">*</span></label>
                                <select id="city" wire:model="city" class="form-control @error('city') is-invalid @enderror">
                                    <option value="">Select a city...</option>
                                    <option value="Stockholm">Stockholm</option>
                                    <option value="Malmö">Malmö</option>
                                    <option value="Gothenburg">Gothenburg</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('city') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="industry">Industry</label>
                                <input type="text" id="industry" wire:model="industry" class="form-control @error('industry') is-invalid @enderror" placeholder="e.g. SaaS, E-commerce, Consulting">
                                @error('industry') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" id="website" wire:model="website" class="form-control @error('website') is-invalid @enderror" placeholder="https://example.com">
                                @error('website') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="size">Company Size</label>
                                <select id="size" wire:model="size" class="form-control @error('size') is-invalid @enderror">
                                    <option value="">Select size...</option>
                                    @foreach($availableSizes as $sizeOption)
                                        <option value="{{ $sizeOption }}">{{ $sizeOption }} employees</option>
                                    @endforeach
                                </select>
                                @error('size') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Short description of the company and how they use Laravel"></textarea>
                            @error('description') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">Contact Information (optional)</h3>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="contactEmail">Contact Email</label>
                                <input type="email" id="contactEmail" wire:model="contactEmail" class="form-control @error('contactEmail') is-invalid @enderror" placeholder="info@company.com">
                                @error('contactEmail') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" maxlength="20" id="phone" wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                                @error('phone') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" wire:model="address" class="form-control @error('address') is-invalid @enderror" placeholder="Street, City, Postal Code">
                            @error('address') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">Logo & Social Links (optional)</h3>
                        </div>

                        <div class="form-group">
                            <label for="logo">Company Logo</label>
                            <input type="file" id="logo" wire:model="logo" class="form-control form-control-file @error('logo') is-invalid @enderror" accept="image/*">
                            @error('logo') <div class="error-message">{{ $message }}</div> @enderror
                            <div wire:loading wire:target="logo" class="upload-loading">Uploading...</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="linkedin">LinkedIn</label>
                                <input type="url" id="linkedin" wire:model="linkedin" class="form-control @error('linkedin') is-invalid @enderror" placeholder="https://linkedin.com/company/name">
                                @error('linkedin') <div class="error-message">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group">
                                <label for="github">GitHub</label>
                                <input type="url" id="github" wire:model="github" class="form-control @error('github') is-invalid @enderror" placeholder="https://github.com/company">
                                @error('github') <div class="error-message">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="form-group" style="max-width: calc(50% - 0.75rem);">
                            <label for="twitter">Twitter / X</label>
                            <input type="url" id="twitter" wire:model="twitter" class="form-control @error('twitter') is-invalid @enderror" placeholder="https://twitter.com/company">
                            @error('twitter') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="form-section-header">
                            <h3 class="form-section-title">How do you know about this company? <span class="required">*</span></h3>
                        </div>

                        <div class="form-group">
                            <label for="submitterRelationship">Relationship</label>
                            <select id="submitterRelationship" wire:model="submitterRelationship" class="form-control @error('submitterRelationship') is-invalid @enderror">
                                <option value="">Select...</option>
                                @foreach($availableRelationships as $relationship)
                                    <option value="{{ $relationship }}">{{ $relationship }}</option>
                                @endforeach
                            </select>
                            @error('submitterRelationship') <div class="error-message">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Additional Notes</label>
                            <textarea id="notes" wire:model="notes" class="form-control @error('notes') is-invalid @enderror" rows="3" placeholder="Any additional information you'd like to share?"></textarea>
                            @error('notes') <div class="error-message">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-submit-row">
                        <button type="submit" class="btn btn-primary btn-lg" wire:loading.attr="disabled">
                            <span wire:loading.remove>Submit Company</span>
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

            .form-group[style*="max-width"] {
                max-width: 100% !important;
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

        select.form-control {
            appearance: auto;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .form-control-file {
            padding: 0.5rem;
            font-size: 0.875rem;
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

        .upload-loading {
            color: var(--gray-500);
            font-size: 0.8125rem;
            margin-top: var(--spacing-2);
        }
    </style>
</div>
