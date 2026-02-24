<div class="page-container">
    @livewire('header')

    <section class="mp-section main-content">
        <div class="mp-header">
            <p class="mp-command">$ member --profile --user="{{ $user->name }}"</p>
            <p class="mp-subtitle">// member area — swedish laravel association</p>
        </div>

        @if(session()->has('message'))
        <div class="mp-alert">
            <span class="mp-ok">[OK]</span> {{ session('message') }}
        </div>
        @endif

        <div class="mp-cards">
            {{-- Profile Card --}}
            <div class="mp-card">
                <p class="mp-card-title">// profile --info</p>

                <div class="mp-profile-rows">
                    <div class="mp-row">
                        <span class="mp-key">name</span>
                        <span class="mp-val">{{ $user->name }}</span>
                    </div>
                    <div class="mp-row">
                        <span class="mp-key">email</span>
                        <span class="mp-val">{{ $user->email }}</span>
                    </div>
                    @if($user->phone)
                    <div class="mp-row">
                        <span class="mp-key">phone</span>
                        <span class="mp-val">{{ $user->phone }}</span>
                    </div>
                    @endif
                    @if($user->city)
                    <div class="mp-row">
                        <span class="mp-key">city</span>
                        <span class="mp-val">{{ $user->city }}</span>
                    </div>
                    @endif
                    @if($user->company)
                    <div class="mp-row">
                        <span class="mp-key">company</span>
                        <span class="mp-val">{{ $user->company }}</span>
                    </div>
                    @endif
                    <div class="mp-row">
                        <span class="mp-key">member-since</span>
                        <span class="mp-val">{{ $user->created_at->format('Y-m-d') }}</span>
                    </div>
                </div>

                <div class="mp-actions">
                    <a href="{{ route('member.edit') }}" class="btn btn-primary mp-btn"><span>$ edit --profile</span></a>
                    <button wire:click="logout" class="mp-btn mp-btn-danger"><span>$ logout --user</span></button>
                </div>
            </div>

            {{-- Membership Card --}}
            <div class="mp-card">
                <p class="mp-card-title">// membership --status</p>

                @if($subscriptionsEnabled)
                    @if($user->subscribed())
                        <div class="mp-status-row">
                            <span class="mp-status-active">[ACTIVE]</span>
                            <span class="mp-status-desc">membership is active and in good standing</span>
                        </div>

                        <div class="mp-profile-rows">
                            <div class="mp-row">
                                <span class="mp-key">status</span>
                                <span class="mp-val mp-val-active">active</span>
                            </div>
                            <div class="mp-row">
                                <span class="mp-key">renewal</span>
                                <span class="mp-val">{{ \Carbon\Carbon::createFromTimestamp($user->subscription()->asStripeSubscription()->current_period_end)->format('Y-m-d') }}</span>
                            </div>
                            <div class="mp-row">
                                <span class="mp-key">member-id</span>
                                <span class="mp-val mp-id">{{ substr($user->stripe_id, 0, 8) }}</span>
                            </div>
                        </div>

                        <div class="mp-actions">
                            <a href="{{ route('member.billing') }}" class="btn btn-secondary mp-btn"><span>$ manage --subscription</span></a>
                        </div>
                    @else
                        <div class="mp-status-row">
                            <span class="mp-status-inactive">[INACTIVE]</span>
                            <span class="mp-status-desc">no active membership found</span>
                        </div>

                        <div class="mp-pitch-block">
                            <p class="mp-pitch">// become a member to support the swedish laravel community</p>
                            <ul class="mp-benefits">
                                <li><span class="mp-bullet">→</span> support the swedish laravel community</li>
                                <li><span class="mp-bullet">→</span> access to exclusive content</li>
                                <li><span class="mp-bullet">→</span> participate in member-only events</li>
                                <li><span class="mp-bullet">→</span> connect with other laravel developers</li>
                            </ul>
                        </div>

                        <div class="mp-actions">
                            <a href="{{ route('subscription.checkout') }}" class="btn btn-primary mp-btn"><span>$ join --membership</span></a>
                        </div>
                    @endif
                @else
                    <div class="mp-status-row">
                        <span class="mp-status-inactive">[DISABLED]</span>
                        <span class="mp-status-desc">membership functionality is currently unavailable</span>
                    </div>
                    <p class="mp-pitch">// subscriptions are not currently available — check back later</p>
                @endif
            </div>
        </div>
    </section>

    @livewire('footer')

    
</div>
