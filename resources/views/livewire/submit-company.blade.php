<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Submit a Company</h2>
            <p class="section-subtitle">Know a company using Laravel in Sweden? Submit it to our directory!</p>
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
                <p>We'll review the company listing and publish it once approved.</p>
                <a href="{{ route('companies') }}" class="btn btn-primary" style="margin-top: 1.5rem;">View Companies</a>
            </div>
        @else
            <div class="card" style="max-width: 700px; margin: 0 auto;">
                <form wire:submit.prevent="submit" class="submit-company-form">
                    @if(!$isLoggedIn)
                        <div class="form-section">
                            <h3 class="form-section-title">Create Account</h3>
                            <p class="form-section-description">Create an account to submit a company. Already have an account? <a href="{{ route('login') }}">Log in</a></p>

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
                        <h3 class="form-section-title">Company Details</h3>

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
                        <h3 class="form-section-title">Contact Information (optional)</h3>

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
                        <h3 class="form-section-title">Logo & Social Links (optional)</h3>

                        <div class="form-group">
                            <label for="logo">Company Logo</label>
                            <input type="file" id="logo" wire:model="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
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
                        <h3 class="form-section-title">How do you know about this company? <span class="required">*</span></h3>

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

                    <div class="form-group" style="text-align: center; margin-top: 2rem;">
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

        .submit-company-form {
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

        select.form-control {
            appearance: auto;
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

        .upload-loading {
            color: var(--gray-600);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</div>
