<div class="page-container">
    @livewire('header')

    <section class="fp-section main-content">
        <div class="fp-card">
            <div class="fp-header">
                <p class="fp-comment">$ reset --password</p>
                <p class="fp-subtitle">enter your email to receive a password reset link</p>
            </div>

            @if ($emailSentMessage)
                <div class="fp-success">
                    <span class="fp-ok-badge">[OK]</span> reset link sent — please check your inbox
                </div>
            @else
                <form wire:submit.prevent="sendResetLink" class="fp-form">
                    <div class="fp-form-group">
                        <label class="fp-label" for="email">email</label>
                        <input type="email" id="email" wire:model="email"
                            class="tm-input fp-input @error('email') fp-input-error @enderror"
                            autofocus autocomplete="username">
                        @error('email')
                            <div class="fp-field-error"><span class="fp-error-badge">[ERROR]</span> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="fp-form-group">
                        <button type="submit" class="btn btn-primary fp-btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>$ send --reset-link</span>
                            <span wire:loading>// sending...</span>
                        </button>
                    </div>
                </form>
            @endif

            <div class="fp-divider"></div>

            <div class="fp-links">
                <a href="{{ route('login') }}" class="fp-link">$ back --to-login</a>
            </div>
        </div>
    </section>

    @livewire('footer')

    
</div>
