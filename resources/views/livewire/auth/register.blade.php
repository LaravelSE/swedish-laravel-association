<div class="page-container">
    @livewire('header')

    <section class="rg-section main-content">
        <div class="rg-card">
            <div class="rg-header">
                <p class="rg-comment">$ register --user</p>
                <p class="rg-subtitle">create a new member account</p>
            </div>

            <form wire:submit.prevent="register" class="rg-form">
                <div class="rg-form-group">
                    <label class="rg-label" for="name">name</label>
                    <input type="text" id="name" wire:model="name"
                        class="tm-input rg-input @error('name') rg-input-error @enderror"
                        autofocus autocomplete="name">
                    @error('name')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="email">email</label>
                    <input type="email" id="email" wire:model="email"
                        class="tm-input rg-input @error('email') rg-input-error @enderror"
                        autocomplete="username">
                    @error('email')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="phone">phone <span class="rg-optional">// optional</span></label>
                    <input type="tel" id="phone" wire:model="phone" maxlength="20"
                        class="tm-input rg-input @error('phone') rg-input-error @enderror"
                        autocomplete="tel">
                    @error('phone')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="city">city <span class="rg-optional">// optional</span></label>
                    <input type="text" id="city" wire:model="city" maxlength="150"
                        class="tm-input rg-input @error('city') rg-input-error @enderror"
                        autocomplete="address-level2">
                    @error('city')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="company">company <span class="rg-optional">// optional</span></label>
                    <input type="text" id="company" wire:model="company" maxlength="150"
                        class="tm-input rg-input @error('company') rg-input-error @enderror"
                        autocomplete="organization">
                    @error('company')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="password">password</label>
                    <input type="password" id="password" wire:model="password"
                        class="tm-input rg-input @error('password') rg-input-error @enderror"
                        autocomplete="new-password">
                    @error('password')
                        <div class="rg-field-error"><span class="rg-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="rg-form-group">
                    <label class="rg-label" for="password_confirmation">confirm-password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                        class="tm-input rg-input"
                        autocomplete="new-password">
                </div>

                <div class="rg-form-group">
                    <button type="submit" class="btn btn-primary rg-btn" wire:loading.attr="disabled">
                        <span wire:loading.remove>$ register --user</span>
                        <span wire:loading>// registering...</span>
                    </button>
                </div>
            </form>

            <div class="rg-divider"></div>

            <div class="rg-links">
                <a href="{{ route('login') }}" class="rg-link">$ login --existing-user</a>
            </div>
        </div>
    </section>

    @livewire('footer')

    
</div>
