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

    
</div>
