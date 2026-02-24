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

    
</div>
