<div class="page-container">
    @livewire('header')

    <section class="sc-section main-content" style="padding-top: var(--spacing-12);">
        <div class="sc-page-header">
            <p class="sc-command">$ company --register</p>
            <p class="sc-subtitle">Know a company using Laravel in Sweden? Submit it to our directory.</p>
        </div>

        @if($submitted)
            <div class="sc-success">
                <span class="sc-success-badge">[OK]</span> company submitted — pending review
            </div>
            <div style="margin-top: 1.5rem;">
                <a href="{{ route('companies') }}" class="btn btn-primary sc-btn"><span>$ view --companies</span></a>
            </div>
        @else
            <div class="sc-form-card">
                <form wire:submit.prevent="submit" class="sc-form">
                    @if(!$isLoggedIn)
                        <div class="sc-form-section">
                            <p class="sc-section-label">// create-account</p>
                            <p class="sc-section-desc">
                                Create an account to submit a company. Already have an account?
                                <a href="{{ route('login') }}" class="sc-link">$ login --user</a>
                            </p>

                            <div class="sc-form-group">
                                <label class="sc-label" for="name">name <span class="sc-req">*</span></label>
                                <input type="text" id="name" wire:model="name"
                                    class="tm-input sc-input @error('name') sc-input-error @enderror"
                                    autofocus>
                                @error('name')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-group">
                                <label class="sc-label" for="email">email <span class="sc-req">*</span></label>
                                <input type="email" id="email" wire:model="email"
                                    class="tm-input sc-input @error('email') sc-input-error @enderror">
                                @error('email')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-group">
                                <label class="sc-label" for="userPhone">phone <span class="sc-optional">(optional)</span></label>
                                <input type="tel" maxlength="20" id="userPhone" wire:model="userPhone"
                                    class="tm-input sc-input @error('userPhone') sc-input-error @enderror">
                                @error('userPhone')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-row">
                                <div class="sc-form-group">
                                    <label class="sc-label" for="password">password <span class="sc-req">*</span></label>
                                    <input type="password" id="password" wire:model="password"
                                        class="tm-input sc-input @error('password') sc-input-error @enderror">
                                    @error('password')
                                        <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="sc-form-group">
                                    <label class="sc-label" for="password_confirmation">confirm password <span class="sc-req">*</span></label>
                                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                        class="tm-input sc-input">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="sc-logged-in-notice">
                            <span class="sc-notice-prefix">// submitting-as</span>
                            <span class="sc-notice-user">{{ $user->name }}</span>
                            <span class="sc-notice-email">&lt;{{ $user->email }}&gt;</span>
                        </div>
                    @endif

                    <div class="sc-form-section">
                        <p class="sc-section-label">// company-details</p>

                        <div class="sc-form-group">
                            <label class="sc-label" for="companyName">company name <span class="sc-req">*</span></label>
                            <input type="text" id="companyName" wire:model="companyName"
                                class="tm-input sc-input @error('companyName') sc-input-error @enderror"
                                placeholder="e.g. Acme AB">
                            @error('companyName')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sc-form-row">
                            <div class="sc-form-group">
                                <label class="sc-label" for="city">city <span class="sc-req">*</span></label>
                                <select id="city" wire:model="city"
                                    class="tm-input sc-input @error('city') sc-input-error @enderror">
                                    <option value="">--city=?</option>
                                    <option value="Stockholm">Stockholm</option>
                                    <option value="Malmö">Malmö</option>
                                    <option value="Gothenburg">Gothenburg</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('city')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-group">
                                <label class="sc-label" for="industry">industry <span class="sc-optional">(optional)</span></label>
                                <input type="text" id="industry" wire:model="industry"
                                    class="tm-input sc-input @error('industry') sc-input-error @enderror"
                                    placeholder="e.g. SaaS, Consulting">
                                @error('industry')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="sc-form-row">
                            <div class="sc-form-group">
                                <label class="sc-label" for="website">website <span class="sc-optional">(optional)</span></label>
                                <input type="url" id="website" wire:model="website"
                                    class="tm-input sc-input @error('website') sc-input-error @enderror"
                                    placeholder="https://example.com">
                                @error('website')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-group">
                                <label class="sc-label" for="size">size <span class="sc-optional">(optional)</span></label>
                                <select id="size" wire:model="size"
                                    class="tm-input sc-input @error('size') sc-input-error @enderror">
                                    <option value="">--size=?</option>
                                    @foreach($availableSizes as $sizeOption)
                                        <option value="{{ $sizeOption }}">{{ $sizeOption }} employees</option>
                                    @endforeach
                                </select>
                                @error('size')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="sc-form-group">
                            <label class="sc-label" for="description">description <span class="sc-optional">(optional)</span></label>
                            <textarea id="description" wire:model="description"
                                class="tm-input sc-input sc-textarea @error('description') sc-input-error @enderror"
                                rows="4"
                                placeholder="Short description of the company and how they use Laravel"></textarea>
                            @error('description')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sc-form-section">
                        <p class="sc-section-label">// contact-information <span class="sc-optional">(optional)</span></p>

                        <div class="sc-form-row">
                            <div class="sc-form-group">
                                <label class="sc-label" for="contactEmail">contact email</label>
                                <input type="email" id="contactEmail" wire:model="contactEmail"
                                    class="tm-input sc-input @error('contactEmail') sc-input-error @enderror"
                                    placeholder="info@company.com">
                                @error('contactEmail')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-group">
                                <label class="sc-label" for="phone">phone</label>
                                <input type="tel" maxlength="20" id="phone" wire:model="phone"
                                    class="tm-input sc-input @error('phone') sc-input-error @enderror">
                                @error('phone')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="sc-form-group">
                            <label class="sc-label" for="address">address</label>
                            <input type="text" id="address" wire:model="address"
                                class="tm-input sc-input @error('address') sc-input-error @enderror"
                                placeholder="Street, City, Postal Code">
                            @error('address')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sc-form-section">
                        <p class="sc-section-label">// logo-and-social <span class="sc-optional">(optional)</span></p>

                        <div class="sc-form-group">
                            <label class="sc-label" for="logo">company logo</label>
                            <input type="file" id="logo" wire:model="logo"
                                class="tm-input sc-input sc-input-file @error('logo') sc-input-error @enderror"
                                accept="image/*">
                            @error('logo')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                            <div wire:loading wire:target="logo" class="sc-upload-status">// uploading...</div>
                        </div>

                        <div class="sc-form-row">
                            <div class="sc-form-group">
                                <label class="sc-label" for="linkedin">linkedin</label>
                                <input type="url" id="linkedin" wire:model="linkedin"
                                    class="tm-input sc-input @error('linkedin') sc-input-error @enderror"
                                    placeholder="https://linkedin.com/company/name">
                                @error('linkedin')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="sc-form-group">
                                <label class="sc-label" for="github">github</label>
                                <input type="url" id="github" wire:model="github"
                                    class="tm-input sc-input @error('github') sc-input-error @enderror"
                                    placeholder="https://github.com/company">
                                @error('github')
                                    <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="sc-form-group sc-half-width">
                            <label class="sc-label" for="twitter">twitter / x</label>
                            <input type="url" id="twitter" wire:model="twitter"
                                class="tm-input sc-input @error('twitter') sc-input-error @enderror"
                                placeholder="https://twitter.com/company">
                            @error('twitter')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sc-form-section sc-form-section-last">
                        <p class="sc-section-label">// submitter-info <span class="sc-req">*</span></p>

                        <div class="sc-form-group">
                            <label class="sc-label" for="submitterRelationship">relationship to company</label>
                            <select id="submitterRelationship" wire:model="submitterRelationship"
                                class="tm-input sc-input @error('submitterRelationship') sc-input-error @enderror">
                                <option value="">--relationship=?</option>
                                @foreach($availableRelationships as $relationship)
                                    <option value="{{ $relationship }}">{{ $relationship }}</option>
                                @endforeach
                            </select>
                            @error('submitterRelationship')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sc-form-group">
                            <label class="sc-label" for="notes">additional notes <span class="sc-optional">(optional)</span></label>
                            <textarea id="notes" wire:model="notes"
                                class="tm-input sc-input sc-textarea @error('notes') sc-input-error @enderror"
                                rows="3"
                                placeholder="Any additional information you'd like to share?"></textarea>
                            @error('notes')
                                <div class="sc-field-error"><span class="sc-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sc-submit-row">
                        <button type="submit" class="btn btn-primary sc-btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>$ submit --company</span>
                            <span wire:loading>// submitting...</span>
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

        .sc-section {
            flex: 1;
            max-width: var(--max-w, 1120px);
            margin: 0 auto;
            padding: 3rem var(--px, 2rem) 5rem;
            width: 100%;
        }

        .sc-page-header {
            margin-bottom: 2.5rem;
            max-width: 680px;
            margin-left: auto;
            margin-right: auto;
        }

        .sc-command {
            font-family: var(--font-mono);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--tm-yellow);
            margin-bottom: 0.5rem;
        }

        .sc-subtitle {
            font-family: var(--font-mono);
            font-size: 0.875rem;
            color: var(--tm-muted);
        }

        .sc-success {
            font-family: var(--font-mono);
            font-size: 1rem;
            color: #4ade80;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.2);
            border-radius: var(--border-radius);
            padding: 1rem 1.25rem;
            display: inline-block;
        }

        .sc-success-badge {
            font-weight: 700;
        }

        .sc-form-card {
            border: 1px solid var(--tm-border);
            border-radius: var(--border-radius-lg);
            padding: 2.5rem;
            max-width: 680px;
            margin: 0 auto;
            background: var(--tm-surface);
        }

        .sc-form {
            display: flex;
            flex-direction: column;
        }

        .sc-form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--tm-border);
        }

        .sc-form-section-last {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .sc-section-label {
            font-family: var(--font-mono);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--tm-yellow);
            border-left: 2px solid var(--tm-yellow);
            padding-left: 0.625rem;
            margin-bottom: 1rem;
        }

        .sc-section-desc {
            font-family: var(--font-mono);
            font-size: 0.8125rem;
            color: var(--tm-muted);
            margin-bottom: 1.25rem;
        }

        .sc-link {
            color: var(--tm-yellow);
            text-decoration: none;
        }

        .sc-link:hover {
            text-decoration: underline;
        }

        .sc-logged-in-notice {
            font-family: var(--font-mono);
            font-size: 0.8125rem;
            background: rgba(245, 213, 99, 0.06);
            border: 1px solid rgba(245, 213, 99, 0.15);
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            margin-bottom: 2rem;
        }

        .sc-notice-prefix {
            color: var(--tm-muted);
            margin-right: 0.5rem;
        }

        .sc-notice-user {
            color: var(--tm-yellow);
            font-weight: 600;
        }

        .sc-notice-email {
            color: var(--tm-muted);
            margin-left: 0.25rem;
        }

        .sc-form-group {
            margin-bottom: 1.25rem;
        }

        .sc-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
        }

        .sc-half-width {
            max-width: calc(50% - 0.625rem);
        }

        .sc-label {
            display: block;
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--tm-text);
            margin-bottom: 0.375rem;
        }

        .sc-req {
            color: var(--tm-red);
        }

        .sc-optional {
            color: var(--tm-muted-dim);
        }

        .sc-input {
            width: 100%;
        }

        .sc-input-error {
            border-color: var(--tm-red) !important;
        }

        .sc-input-error:focus {
            box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2) !important;
        }

        .sc-input-file {
            padding: 0.4375rem;
            font-size: 0.8125rem;
        }

        .sc-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .sc-field-error {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--tm-red);
            margin-top: 0.375rem;
        }

        .sc-error-badge {
            font-weight: 700;
        }

        .sc-upload-status {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--tm-muted);
            margin-top: 0.375rem;
        }

        .sc-submit-row {
            margin-top: 2rem;
        }

        .sc-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        @media (max-width: 600px) {
            .sc-form-row {
                grid-template-columns: 1fr;
            }

            .sc-form-card {
                padding: 1.5rem;
            }

            .sc-half-width {
                max-width: 100%;
            }
        }
    </style>
</div>
