<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">Membership Subscription</h2>
            <p class="section-subtitle">Join the Swedish Laravel Association</p>
        </div>

        @if(!empty($errorMessage))
        <div class="alert alert-danger">
            {{ $errorMessage }}
        </div>
        @endif

        <div class="checkout-container">
            <div class="card checkout-card">
                <div class="checkout-details">
                    <h3>Membership Details</h3>

                    <div class="subscription-info">
                        <div class="subscription-item">
                            <span class="subscription-label">Annual Membership:</span>
                            <span class="subscription-value">{{ $subscriptionPrice }} SEK</span>
                        </div>

                        <div class="subscription-item">
                            <span class="subscription-label">Billing Period:</span>
                            <span class="subscription-value">Yearly (January 1st)</span>
                        </div>

                        <div class="subscription-item highlight">
                            <span class="subscription-label">First Payment:</span>
                            <span class="subscription-value">Prorated amount for remainder of {{ date('Y') }}</span>
                            <div class="subscription-note">
                                You'll be charged a prorated amount based on the time remaining until January 1st, {{ date('Y') + 1 }}
                            </div>
                        </div>

                        <div class="subscription-item">
                            <span class="subscription-label">Next Billing Date:</span>
                            <span class="subscription-value">{{ $nextYearDate->format('F j, Y') }}</span>
                        </div>
                    </div>

                    <div class="checkout-actions text-center">
                        <a href="{{ $checkoutUrl }}" class="btn btn-primary">
                            Continue to Stripe's Secure Checkout
                        </a>
                        <a href="{{ route('member') }}" class="btn btn-outline">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('footer')

    <style>
        .checkout-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .checkout-card {
            border-radius: var(--border-radius);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }

        .checkout-details {
            padding: 2rem;
        }

        .subscription-info {
            margin: 2rem 0;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            padding: 1.5rem;
        }

        .subscription-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .subscription-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .subscription-label {
            font-weight: 500;
            color: var(--gray-700);
        }

        .subscription-value {
            font-weight: 600;
        }

        .subscription-note {
            width: 100%;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .subscription-item.highlight {
            background-color: var(--primary-50);
            margin-left: -1.5rem;
            margin-right: -1.5rem;
            padding: 1rem 1.5rem;
            border-left: 3px solid var(--primary-500);
        }

        .checkout-actions {
            margin-top: 2rem;
            display: flex;
            gap: 1rem;
            justify-content: center;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #ef4444;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</div>
