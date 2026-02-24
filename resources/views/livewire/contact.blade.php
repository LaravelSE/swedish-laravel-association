<div>
    <section class="co-section" id="contact">
        <div class="co-page-header">
            <p class="co-command">$ contact --send</p>
            <p class="co-subtitle">Have questions or want to get involved? We'd love to hear from you.</p>
        </div>

        @if($showSuccessMessage)
            <div class="co-success">
                <span class="co-success-badge">[OK]</span> message delivered
            </div>
        @endif

        <form wire:submit.prevent="submitForm" class="co-form">
            <div class="co-form-row">
                <div class="co-form-group">
                    <label class="co-label" for="name">name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="tm-input co-input @error('name') co-input-error @enderror"
                        placeholder="your name"
                    >
                    @error('name')
                        <div class="co-field-error"><span class="co-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>

                <div class="co-form-group">
                    <label class="co-label" for="email">email</label>
                    <input
                        type="email"
                        id="email"
                        wire:model="email"
                        class="tm-input co-input @error('email') co-input-error @enderror"
                        placeholder="you@example.com"
                    >
                    @error('email')
                        <div class="co-field-error"><span class="co-error-badge">[ERROR]</span> {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="co-form-group">
                <label class="co-label" for="message">message</label>
                <textarea
                    id="message"
                    wire:model="message"
                    class="tm-input co-input co-textarea @error('message') co-input-error @enderror"
                    rows="5"
                    placeholder="what would you like to tell us?"
                ></textarea>
                @error('message')
                    <div class="co-field-error"><span class="co-error-badge">[ERROR]</span> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary co-btn" wire:loading.attr="disabled">
                <span wire:loading.remove>$ send --message</span>
                <span wire:loading>// sending...</span>
            </button>
        </form>

        <div class="co-cta">
            <p>// know a Swedish Laravel company? <a href="{{ route('submit-company') }}" class="co-cta-link">$ company --register</a></p>
        </div>
    </section>

    
</div>
