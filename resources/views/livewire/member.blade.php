<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Member Area</h2>
            <p class="section-subtitle">Welcome to the Swedish Laravel Association member area</p>
        </div>

        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <div class="card" style="max-width: 800px; margin: 0 auto;">
            <div class="member-profile">
                <h3>Your Profile</h3>

                <div class="profile-details">
                    <div class="profile-item">
                        <span class="profile-label">Name:</span>
                        <span class="profile-value">{{ $user->name }}</span>
                    </div>

                    <div class="profile-item">
                        <span class="profile-label">Email:</span>
                        <span class="profile-value">{{ $user->email }}</span>
                    </div>

                    @if($user->phone)
                    <div class="profile-item">
                        <span class="profile-label">Phone:</span>
                        <span class="profile-value">{{ $user->phone }}</span>
                    </div>
                    @endif

                    @if($user->city)
                    <div class="profile-item">
                        <span class="profile-label">City:</span>
                        <span class="profile-value">{{ $user->city }}</span>
                    </div>
                    @endif

                    @if($user->company)
                    <div class="profile-item">
                        <span class="profile-label">Company:</span>
                        <span class="profile-value">{{ $user->company }}</span>
                    </div>
                    @endif

                    <div class="profile-item">
                        <span class="profile-label">Member since:</span>
                        <span class="profile-value">{{ $user->created_at->format('F j, Y') }}</span>
                    </div>
                </div>

                <div class="member-actions">
                    <a href="{{ route('member.edit') }}" class="btn btn-primary">Edit Profile</a>
                    <button wire:click="logout" class="btn btn-danger">Logout</button>
                </div>
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
        
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        
        .member-profile {
            padding: 2rem;
        }
        
        .profile-details {
            margin: 2rem 0;
        }
        
        .profile-item {
            margin-bottom: 1rem;
            display: flex;
        }
        
        .profile-label {
            font-weight: 600;
            width: 150px;
        }
        
        .profile-value {
            flex: 1;
        }
        
        .member-actions {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--gray-200);
            display: flex;
            gap: 1rem;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-primary {
            background-color: var(--laravel-red);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--laravel-red-dark);
        }
        
        .btn-danger {
            background-color: #dc2626;
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #b91c1c;
        }
    </style>
</div>
