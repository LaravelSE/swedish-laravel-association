<?php

namespace App\Livewire\Subscription;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Checkout extends Component
{
    public $subscriptionPrice;

    public $nextYearDate;

    public $checkoutUrl;

    public $errorMessage = '';

    public function mount()
    {
        $this->calculateNextYearBillingDate();
        $this->subscriptionPrice = 100; // Base yearly price in SEK
        $this->createCheckoutSession();
    }

    public function calculateNextYearBillingDate()
    {
        // Get current date and next year's January 1st
        $currentDate = Carbon::now();
        $nextYear = $currentDate->year + 1;
        $this->nextYearDate = Carbon::createFromDate($nextYear, 1, 1);
    }

    public function createCheckoutSession()
    {
        $user = Auth::user();

        // Create or get the customer in Stripe
        $user->createOrGetStripeCustomer();

        // Get the next billing anchor date (January 1st of next year)
        $anchorDate = $this->nextYearDate;

        // Create a checkout session for the subscription
        $checkout = $user->newSubscription('default', config('stripe.membership.price_id'))
            ->checkout([
                'success_url' => route('member').'?subscription=success',
                'cancel_url' => route('subscription.checkout'),
                'billing_address_collection' => 'required',
                'customer_update' => [
                    'address' => 'auto',
                ],
                'payment_method_types' => ['card'],
                'allow_promotion_codes' => true,
                'subscription_data' => [
                    'billing_cycle_anchor' => $anchorDate->timestamp,
                ],
            ]);

        $this->checkoutUrl = $checkout->url;
    }

    public function render()
    {
        return view('livewire.subscription.checkout');
    }
}
