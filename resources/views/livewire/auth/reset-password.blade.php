<div class="page-container">
    @livewire('header')

    <section class="rp-section main-content">
        <div class="rp-card">
            <div class="rp-header">
                <p class="rp-comment">$ set --new-password</p>
                <p class="rp-subtitle">enter a new password for your account</p>
            </div>

            <form wire:submit.prevent="resetPassword" class="rp-form">
                <input type="hidden" wire:model="token">

                <div class="rp-form-group">
                    <label class="rp-label" for="email">email</label>
                    <input type="email" id="email" wire:model="email"
                        class="tm-input rp-input @error('email') rp-input-error @enderror"
                        autofocus autocomplete="username">
                    @error('email')
                        <div class="rp-field-error"><span class="rp-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rp-form-group">
                    <label class="rp-label" for="password">new password</label>
                    <input type="password" id="password" wire:model="password"
                        class="tm-input rp-input @error('password') rp-input-error @enderror"
                        autocomplete="new-password">
                    @error('password')
                        <div class="rp-field-error"><span class="rp-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rp-form-group">
                    <label class="rp-label" for="password_confirmation">confirm new password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                        class="tm-input rp-input"
                        autocomplete="new-password">
                </div>

                <div class="rp-form-group">
                    <button type="submit" class="btn btn-primary rp-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>$ reset --password</span>
                        <span wire:loading>// resetting...</span>
                    </button>
                </div>
            </form>

            <div class="rp-divider"></div>

            <div class="rp-links">
                <a href="{{ route('login') }}" class="rp-link">$ back --to-login</a>
            </div>
        </div>
    </section>

    @livewire('footer')

    
</div>
