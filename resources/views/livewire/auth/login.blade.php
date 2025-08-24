<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 4rem;">
        <div class="section-header">
            <h2 class="section-title">Login</h2>
            <p class="section-subtitle">Sign in to your Swedish Laravel Association account</p>
        </div>
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <form wire:submit.prevent="login" class="login-form">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" autofocus>
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="checkbox-container">
                        <input type="checkbox" id="remember" wire:model="remember">
                        <span class="checkbox-label">Remember me</span>
                    </label>
                </div>

                <div class="form-group" style="text-align: center;">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Login</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>

                <div class="form-group" style="text-align: center;">
                    <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot your password?</a>
                </div>
            </form>

            <div style="margin-top: var(--spacing-6); padding-top: var(--spacing-6); border-top: 1px solid var(--gray-200); text-align: center;">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
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
        
        .login-form {
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
        .checkbox-container {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .checkbox-container input {
            margin-right: 0.5rem;
        }
        .checkbox-label {
            font-size: 0.9rem;
        }
        
        .forgot-password-link {
            color: var(--laravel-red);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s ease;
        }
        
        .forgot-password-link:hover {
            color: var(--laravel-red-dark);
            text-decoration: underline;
        }
    </style>
</div>
