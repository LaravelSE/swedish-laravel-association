<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 4rem;">
        <div class="section-header">
            <h2 class="section-title">Forgot Password</h2>
            <p class="section-subtitle">Enter your email to receive a password reset link</p>
        </div>
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            @if ($emailSentMessage)
                <div class="alert alert-success">
                    <p>If your email was registered in our system an email with your password reset link has been sent. Please check your inbox.</p>
                </div>
            @else
                <form wire:submit.prevent="sendResetLink" class="forgot-password-form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" autofocus>
                        @error('email') <div class="error-message">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                            <span wire:loading.remove>Send Password Reset Link</span>
                            <span wire:loading>Sending...</span>
                        </button>
                    </div>
                </form>
            @endif

            <div style="margin-top: var(--spacing-6); padding-top: var(--spacing-6); border-top: 1px solid var(--gray-200); text-align: center;">
                <p>Remember your password? <a href="{{ route('login') }}">Back to Login</a></p>
            </div>
        </div>
    </section>

    <div style="margin-top: 4rem;"></div>

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

        .forgot-password-form {
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

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 2rem;
            text-align: center;
        }
    </style>
</div>
