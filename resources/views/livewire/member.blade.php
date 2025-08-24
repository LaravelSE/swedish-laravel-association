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

        <div class="cards-container">
            <div class="card member-card">
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

            <div class="card member-card">
                <div class="member-profile">
                    <h3>Membership</h3>

                    @if($subscriptionsEnabled)
                        @if($user->subscribed())
                            <div class="membership-status active">
                                <div class="membership-header">
                                    <h4>Active Membership</h4>
                                    <p>Your membership is active and in good standing.</p>
                                </div>
                                
                                <div class="membership-details">
                                    <div class="membership-item">
                                        <span class="membership-label">Status:</span>
                                        <span class="membership-value">Active</span>
                                    </div>
                                    
                                    <div class="membership-item">
                                        <span class="membership-label">Renewal Date:</span>
                                        <span class="membership-value">{{ \Carbon\Carbon::createFromTimestamp($user->subscription()->asStripeSubscription()->current_period_end)->format('F j, Y') }}</span>
                                    </div>
                                    
                                    <div class="membership-item">
                                        <span class="membership-label">Membership ID:</span>
                                        <span class="membership-value">{{ substr($user->stripe_id, 0, 8) }}</span>
                                    </div>
                                </div>

                                <div class="member-actions">
                                    <a href="{{ route('member.billing') }}" class="btn btn-secondary">Manage Subscription</a>
                                </div>
                            </div>
                            <div class="membership-icon active">
                                <i class="fas fa-check-circle"></i>
                            </div>
                        @else
                            <div class="membership-status inactive">
                                <div class="membership-header">
                                    <h4>Inactive Membership</h4>
                                    <p>You don't have an active membership yet.</p>
                                </div>
                                
                                <div class="membership-details">
                                    <p>Become a member to support the Swedish Laravel community and get access to exclusive content and events.</p>
                                    
                                    <ul class="membership-benefits">
                                        <li>Support the Swedish Laravel community</li>
                                        <li>Get access to exclusive content</li>
                                        <li>Participate in member-only events</li>
                                        <li>Connect with other Laravel developers</li>
                                    </ul>
                                </div>
                                
                                <div class="member-actions">
                                    <a href="{{ route('subscription.checkout') }}" class="btn btn-primary">Become a Member</a>
                                </div>
                            </div>
                            <div class="membership-icon inactive">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        @endif
                    @else
                        <div class="membership-status">
                            <div class="membership-header">
                                <h4>Membership Information</h4>
                                <p>Membership functionality is currently disabled.</p>
                            </div>
                            
                            <div class="membership-details">
                                <p>Membership subscriptions are not currently available. Please check back later.</p>
                            </div>
                        </div>
                        <div class="membership-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                    @endif
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
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .member-card {
            flex: 1;
            min-width: 350px;
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

        .membership-placeholder,
        .membership-active,
        .membership-inactive {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1.5rem;
            padding: 1.5rem;
            background-color: var(--gray-50);
            border-radius: var(--border-radius);
        }

        .membership-message {
            flex: 1;
        }

        .membership-icon {
            margin-left: 1.5rem;
            color: var(--gray-400);
        }

        .membership-icon.active {
            color: var(--primary-color);
        }

        .membership-status {
            flex: 1;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.75rem;
        }

        .status-badge.active {
            background-color: #dcfce7;
            color: #166534;
        }

        .membership-details {
            margin: 1.5rem 0;
        }

        .membership-item {
            margin-bottom: 0.75rem;
            display: flex;
        }

        .membership-label {
            font-weight: 500;
            width: 150px;
            color: var(--gray-600);
        }

        .membership-value {
            font-weight: 500;
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

        .btn-secondary {
            background-color: #4b5563;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #2f3a4e;
        }

        /* Responsive design for mobile */
        @media (max-width: 768px) {
            .cards-container {
                flex-direction: column;
            }

            .member-card {
                width: 100%;
            }
        }
    </style>
</div>
