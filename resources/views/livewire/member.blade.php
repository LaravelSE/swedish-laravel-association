<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: var(--spacing-12);">
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
            <div class="member-card">
                <div class="member-card-inner">
                    <h3 class="member-card-title">Your Profile</h3>

                    <div class="profile-details">
                        <div class="profile-item">
                            <span class="profile-label">Name</span>
                            <span class="profile-value">{{ $user->name }}</span>
                        </div>

                        <div class="profile-item">
                            <span class="profile-label">Email</span>
                            <span class="profile-value">{{ $user->email }}</span>
                        </div>

                        @if($user->phone)
                        <div class="profile-item">
                            <span class="profile-label">Phone</span>
                            <span class="profile-value">{{ $user->phone }}</span>
                        </div>
                        @endif

                        @if($user->city)
                        <div class="profile-item">
                            <span class="profile-label">City</span>
                            <span class="profile-value">{{ $user->city }}</span>
                        </div>
                        @endif

                        @if($user->company)
                        <div class="profile-item">
                            <span class="profile-label">Company</span>
                            <span class="profile-value">{{ $user->company }}</span>
                        </div>
                        @endif

                        <div class="profile-item">
                            <span class="profile-label">Member since</span>
                            <span class="profile-value">{{ $user->created_at->format('F j, Y') }}</span>
                        </div>
                    </div>

                    <div class="member-actions">
                        <a href="{{ route('member.edit') }}" class="btn btn-primary">Edit Profile</a>
                        <button wire:click="logout" class="btn btn-danger">Logout</button>
                    </div>
                </div>
            </div>

            <div class="member-card">
                <div class="member-card-inner">
                    <h3 class="member-card-title">Membership</h3>

                    @if($subscriptionsEnabled)
                        @if($user->subscribed())
                            <div class="membership-status active">
                                <div class="membership-header">
                                    <div class="membership-badge active">Active</div>
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
                                        <span class="membership-value membership-id">{{ substr($user->stripe_id, 0, 8) }}</span>
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
                                    <div class="membership-badge inactive">Inactive</div>
                                    <p>You don't have an active membership yet.</p>
                                </div>

                                <div class="membership-details">
                                    <p class="membership-pitch">Become a member to support the Swedish Laravel community and get access to exclusive content and events.</p>

                                    <ul class="membership-benefits">
                                        <li>Support the Swedish Laravel community</li>
                                        <li>Get access to exclusive content</li>
                                        <li>Participate in member-only events</li>
                                        <li>Connect with other Laravel developers</li>
                                    </ul>
                                </div>

                                <div class="member-actions">
                                    <a href="{{ route('subscription.checkout') }}" class="btn btn-accent">Become a Member</a>
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
            padding: var(--spacing-4);
            margin-bottom: var(--spacing-6);
            border-radius: var(--border-radius-lg);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #bbf7d0;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: var(--spacing-6);
            max-width: 1000px;
            margin: 0 auto;
        }

        .member-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-2xl);
            transition: border-color var(--transition-base);
        }

        .member-card:hover {
            border-color: var(--gray-300);
        }

        .member-card-inner {
            padding: var(--spacing-8);
        }

        .member-card-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.02em;
            margin-bottom: var(--spacing-6);
        }

        .profile-details {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-4);
        }

        .profile-item {
            display: flex;
            align-items: baseline;
        }

        .profile-label {
            font-weight: 600;
            font-size: 0.8125rem;
            color: var(--gray-500);
            width: 120px;
            flex-shrink: 0;
        }

        .profile-value {
            color: var(--gray-900);
            font-size: 0.9375rem;
        }

        .member-actions {
            margin-top: var(--spacing-8);
            padding-top: var(--spacing-6);
            border-top: 1px solid var(--gray-100);
            display: flex;
            gap: var(--spacing-3);
        }

        .btn {
            padding: 0.625rem 1.25rem;
            border: none;
            border-radius: var(--border-radius-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all var(--transition-fast);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .btn-primary {
            background-color: var(--gray-900);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--gray-800);
        }

        .btn-accent {
            background-color: var(--laravel-red);
            color: white;
        }

        .btn-accent:hover {
            background-color: var(--laravel-red-dark);
        }

        .btn-danger {
            background-color: white;
            color: #ef4444;
            border: 1px solid var(--gray-300);
        }

        .btn-danger:hover {
            background-color: #fef2f2;
            border-color: #fca5a5;
        }

        .btn-secondary {
            background-color: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-secondary:hover {
            background-color: var(--gray-50);
            border-color: var(--gray-400);
        }

        .membership-header {
            margin-bottom: var(--spacing-5);
        }

        .membership-header h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: var(--spacing-2);
        }

        .membership-header p {
            color: var(--gray-500);
            font-size: 0.9375rem;
        }

        .membership-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: var(--spacing-3);
            letter-spacing: 0.02em;
        }

        .membership-badge.active {
            background-color: #dcfce7;
            color: #166534;
        }

        .membership-badge.inactive {
            background-color: var(--gray-100);
            color: var(--gray-600);
        }

        .membership-details {
            margin-bottom: var(--spacing-2);
        }

        .membership-item {
            margin-bottom: var(--spacing-3);
            display: flex;
            align-items: baseline;
        }

        .membership-label {
            font-weight: 600;
            font-size: 0.8125rem;
            width: 120px;
            color: var(--gray-500);
            flex-shrink: 0;
        }

        .membership-value {
            font-size: 0.9375rem;
            color: var(--gray-900);
        }

        .membership-id {
            font-family: 'SF Mono', Monaco, 'Cascadia Code', monospace;
            font-size: 0.8125rem;
            background: var(--gray-100);
            padding: 0.125rem 0.5rem;
            border-radius: 4px;
        }

        .membership-pitch {
            color: var(--gray-600);
            font-size: 0.9375rem;
            margin-bottom: var(--spacing-4);
        }

        .membership-benefits {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
        }

        .membership-benefits li {
            position: relative;
            padding-left: var(--spacing-6);
            color: var(--gray-600);
            font-size: 0.9375rem;
        }

        .membership-benefits li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0.5em;
            width: 6px;
            height: 6px;
            background: var(--laravel-red);
            border-radius: 50%;
        }

        .membership-icon {
            display: none;
        }

        .membership-status {
            flex: 1;
        }

        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</div>
