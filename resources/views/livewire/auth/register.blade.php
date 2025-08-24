<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Register</h2>
            <p class="section-subtitle">Create a new account to join the Swedish Laravel Association</p>
        </div>
        <div class="card" style="max-width: 600px; margin: 0 auto;">
            <form wire:submit.prevent="register" class="register-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" wire:model="name" class="form-control @error('name') is-invalid @enderror" autofocus>
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone (optional)</label>
                    <input type="tel" maxlength="20" id="phone" wire:model="phone" class="form-control @error('phone') is-invalid @enderror">
                    @error('phone') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="city">City (optional)</label>
                    <input type="text" maxlength="150" id="city" wire:model="city" class="form-control @error('city') is-invalid @enderror">
                    @error('city') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="company">Company (optional)</label>
                    <input type="text" maxlength="150" id="company" wire:model="company" class="form-control @error('company') is-invalid @enderror">
                    @error('company') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" wire:model="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation" class="form-control">
                </div>

                <div class="form-group" style="text-align: center;">
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Register</span>
                        <span wire:loading>Processing...</span>
                    </button>
                </div>
            </form>

            <div style="margin-top: var(--spacing-6); padding-top: var(--spacing-6); border-top: 1px solid var(--gray-200); text-align: center;">
                <p>Already have an account? <a href="{{ route('login') }}">Log in</a></p>
            </div>
        </div>
    </section>

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
        
        .register-form {
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
