<div class="page-container">
    @livewire('header')

    <section class="st-section main-content" style="padding-top: var(--spacing-12);">
        <div class="st-page-header">
            <p class="st-command">$ talk --submit</p>
            <p class="st-subtitle">Want to share your knowledge at a Laravel Sweden meetup? Submit your talk proposal below!</p>
        </div>

        @if($submitted)
            <div class="st-success">
                <span class="st-success-badge">[OK]</span> talk submitted — pending review
            </div>
            <div style="margin-top: 1.5rem;">
                <a href="{{ route('home') }}" class="btn btn-primary st-btn"><span>$ go --home</span></a>
            </div>
        @else
            <div class="st-form-card">
                <form wire:submit.prevent="submit" class="st-form">
                    @if(!$isLoggedIn)
                        <div class="st-form-section">
                            <p class="st-section-label">// create-account</p>
                            <p class="st-section-desc">
                                Create an account to submit your talk. Already have an account?
                                <a href="{{ route('login') }}" class="st-link">$ login --user</a>
                            </p>

                            <div class="st-form-group">
                                <label class="st-label" for="name">name <span class="st-req">*</span></label>
                                <input type="text" id="name" wire:model="name"
                                    class="tm-input st-input @error('name') st-input-error @enderror"
                                    autofocus>
                                @error('name')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-group">
                                <label class="st-label" for="email">email <span class="st-req">*</span></label>
                                <input type="email" id="email" wire:model="email"
                                    class="tm-input st-input @error('email') st-input-error @enderror">
                                @error('email')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-group">
                                <label class="st-label" for="phone">phone <span class="st-optional">(optional)</span></label>
                                <input type="tel" maxlength="20" id="phone" wire:model="phone"
                                    class="tm-input st-input @error('phone') st-input-error @enderror">
                                @error('phone')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-row">
                                <div class="st-form-group">
                                    <label class="st-label" for="password">password <span class="st-req">*</span></label>
                                    <input type="password" id="password" wire:model="password"
                                        class="tm-input st-input @error('password') st-input-error @enderror">
                                    @error('password')
                                        <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="st-form-group">
                                    <label class="st-label" for="password_confirmation">confirm password <span class="st-req">*</span></label>
                                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                                        class="tm-input st-input">
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="st-logged-in-notice">
                            <span class="st-notice-prefix">// submitting-as</span>
                            <span class="st-notice-user">{{ $user->name }}</span>
                            <span class="st-notice-email">&lt;{{ $user->email }}&gt;</span>
                        </div>
                    @endif

                    <div class="st-form-section">
                        <p class="st-section-label">// talk-details</p>

                        <div class="st-form-group">
                            <label class="st-label" for="title">title <span class="st-req">*</span></label>
                            <input type="text" id="title" wire:model="title"
                                class="tm-input st-input @error('title') st-input-error @enderror"
                                placeholder="e.g. Building Scalable APIs with Laravel">
                            @error('title')
                                <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="st-form-group">
                            <label class="st-label" for="description">description <span class="st-req">*</span></label>
                            <textarea id="description" wire:model="description"
                                class="tm-input st-input st-textarea @error('description') st-input-error @enderror"
                                rows="5"
                                placeholder="Describe your talk — what will attendees learn? What topics will you cover?"></textarea>
                            @error('description')
                                <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="st-form-group">
                            <label class="st-label">which meetup cities? <span class="st-req">*</span></label>
                            <div class="st-checkbox-group">
                                @foreach($availableCities as $city)
                                    <label class="st-checkbox-label">
                                        <input type="checkbox" wire:model="cities" value="{{ $city }}" class="st-checkbox">
                                        <span>{{ $city }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('cities')
                                <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="st-form-section">
                        <p class="st-section-label">// about-you</p>

                        <div class="st-form-row">
                            <div class="st-form-group">
                                <label class="st-label" for="position">position <span class="st-req">*</span></label>
                                <input type="text" id="position" wire:model="position"
                                    class="tm-input st-input @error('position') st-input-error @enderror"
                                    placeholder="e.g. Senior Developer">
                                @error('position')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-group">
                                <label class="st-label" for="company">company <span class="st-optional">(optional)</span></label>
                                <input type="text" id="company" wire:model="company"
                                    class="tm-input st-input @error('company') st-input-error @enderror">
                                @error('company')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="st-form-section">
                        <p class="st-section-label">// social-links <span class="st-optional">(optional)</span></p>
                        <p class="st-section-desc">Share your social profiles so attendees can connect with you.</p>

                        <div class="st-form-row">
                            <div class="st-form-group">
                                <label class="st-label" for="twitter">twitter / x</label>
                                <input type="url" id="twitter" wire:model="twitter"
                                    class="tm-input st-input @error('twitter') st-input-error @enderror"
                                    placeholder="https://twitter.com/username">
                                @error('twitter')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-group">
                                <label class="st-label" for="linkedin">linkedin</label>
                                <input type="url" id="linkedin" wire:model="linkedin"
                                    class="tm-input st-input @error('linkedin') st-input-error @enderror"
                                    placeholder="https://linkedin.com/in/username">
                                @error('linkedin')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="st-form-row">
                            <div class="st-form-group">
                                <label class="st-label" for="github">github</label>
                                <input type="url" id="github" wire:model="github"
                                    class="tm-input st-input @error('github') st-input-error @enderror"
                                    placeholder="https://github.com/username">
                                @error('github')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-group">
                                <label class="st-label" for="bluesky">bluesky</label>
                                <input type="url" id="bluesky" wire:model="bluesky"
                                    class="tm-input st-input @error('bluesky') st-input-error @enderror"
                                    placeholder="https://bsky.app/profile/username">
                                @error('bluesky')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="st-form-row">
                            <div class="st-form-group">
                                <label class="st-label" for="facebook">facebook</label>
                                <input type="url" id="facebook" wire:model="facebook"
                                    class="tm-input st-input @error('facebook') st-input-error @enderror"
                                    placeholder="https://facebook.com/username">
                                @error('facebook')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="st-form-group">
                                <label class="st-label" for="instagram">instagram</label>
                                <input type="url" id="instagram" wire:model="instagram"
                                    class="tm-input st-input @error('instagram') st-input-error @enderror"
                                    placeholder="https://instagram.com/username">
                                @error('instagram')
                                    <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="st-form-section st-form-section-last">
                        <p class="st-section-label">// additional-notes <span class="st-optional">(optional)</span></p>

                        <div class="st-form-group">
                            <label class="st-label" for="notes">notes</label>
                            <textarea id="notes" wire:model="notes"
                                class="tm-input st-input st-textarea @error('notes') st-input-error @enderror"
                                rows="3"
                                placeholder="Any additional information you'd like to share with us?"></textarea>
                            @error('notes')
                                <div class="st-field-error"><span class="st-error-badge">[ERROR]</span> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="st-submit-row">
                        <button type="submit" class="btn btn-primary st-btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>$ submit --talk</span>
                            <span wire:loading>// submitting...</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </section>

    @livewire('footer')

    
</div>
