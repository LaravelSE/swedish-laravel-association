<div>
    <section class="section" id="contact">
        <div class="section-header">
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">Have questions or want to get involved? We'd love to hear from you.</p>
        </div>
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <div class="card-icon" style="margin: 0 auto var(--spacing-4); text-align: center;">📧</div>
            <h3 style="text-align: center;">Contact Us</h3>
            <p style="text-align: center;">For questions, partnership opportunities, or if you want to get involved with the association.</p>

            @if($showSuccessMessage)
                <div class="alert alert-success" style="background-color: #d1e7dd; color: #0f5132; padding: 1rem; border-radius: 0.25rem; margin: 1rem 0;">
                    <p style="margin: 0;">Thank you for your message! We'll get back to you soon.</p>
                </div>
            @endif

            <form wire:submit.prevent="submitForm" class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" wire:model="message" class="form-control @error('message') is-invalid @enderror" rows="5"></textarea>
                    @error('message') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="text-align: center;">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Send Message</span>
                        <span wire:loading>Sending...</span>
                    </button>
                </div>
            </form>

            <div style="margin-top: var(--spacing-6); padding-top: var(--spacing-6); border-top: 1px solid var(--gray-200); text-align: center;">
                <h4 style="margin-bottom: var(--spacing-3);">Know a Swedish Laravel Company?</h4>
                <p style="font-size: 0.875rem; margin-bottom: var(--spacing-4);">Help us build a comprehensive directory of Laravel companies in Sweden.</p>
                <a href="https://forms.gle/6NPAM4EdPRqe2x9g9" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                    Submit Company
                </a>
            </div>
        </div>
    </section>

    <style>
        .contact-form {
            margin: 2rem 0;
        }
        .form-group {
            margin-bottom: 1.5rem;
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
    </style>
</div>
