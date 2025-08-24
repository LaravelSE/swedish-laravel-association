<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 4rem;">
        <div class="section-header">
            <h2 class="section-title">Reset Password</h2>
            <p class="section-subtitle">Create a new password for your account</p>
        </div>
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <form wire:submit.prevent="resetPassword" class="reset-password-form">
                <input type="hidden" wire:model="token">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" autofocus>
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm New Password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control">
                </div>

                <div class="form-group" style="text-align: center;">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Reset Password</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>
            </form>
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
        
        .reset-password-form {
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
    </style>
</div>
