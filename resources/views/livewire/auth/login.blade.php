<div class="page-container">
    @livewire('header')

    <section class="lg-section main-content">
        <div class="lg-card">
            <div class="lg-header">
                <p class="lg-comment">$ login --user</p>
                <p class="lg-subtitle">authenticate to access your member account</p>
            </div>

            <form wire:submit.prevent="login" class="lg-form">
                <div class="lg-form-group">
                    <label class="lg-label" for="email">email</label>
                    <input type="email" id="email" wire:model="email"
                        class="tm-input lg-input @error('email') lg-input-error @enderror"
                        autofocus autocomplete="username">
                    @error('email')
                        <div class="lg-field-error"><span class="lg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="lg-form-group">
                    <label class="lg-label" for="password">password</label>
                    <input type="password" id="password" wire:model="password"
                        class="tm-input lg-input @error('password') lg-input-error @enderror"
                        autocomplete="current-password">
                    @error('password')
                        <div class="lg-field-error"><span class="lg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="lg-form-group lg-remember">
                    <label class="lg-checkbox-label">
                        <input type="checkbox" wire:model="remember" style="accent-color: var(--tm-yellow);">
                        <span class="lg-remember-text">// remember-session</span>
                    </label>
                </div>

                <div class="lg-form-group">
                    <button type="submit" class="btn btn-primary lg-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>$ login --user</span>
                        <span wire:loading>// authenticating...</span>
                    </button>
                </div>
            </form>

            <div class="lg-divider"></div>

            <div class="lg-links">
                <a href="{{ route('password.request') }}" class="lg-link">$ forgot --password</a>
                <a href="{{ route('register') }}" class="lg-link">$ register --new-user</a>
            </div>
        </div>
    </section>

    @livewire('footer')

    
</div>
