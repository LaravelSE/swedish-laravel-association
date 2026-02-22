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

    <style>
        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: var(--tm-bg);
        }

        .main-content {
            flex: 1;
        }

        .mp-section {
            padding: var(--spacing-12) var(--spacing-6);
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }

        .mp-header {
            margin-bottom: var(--spacing-8);
        }

        .mp-command {
            font-family: var(--font);
            font-size: 1.125rem;
            color: var(--tm-yellow);
            margin-bottom: var(--spacing-1);
        }

        .mp-subtitle {
            font-family: var(--font);
            font-size: 0.8125rem;
            color: var(--tm-muted);
        }

        .mp-alert {
            font-family: var(--font);
            font-size: 0.875rem;
            color: #4ade80;
            background: rgba(74, 222, 128, 0.08);
            border: 1px solid rgba(74, 222, 128, 0.25);
            border-radius: 4px;
            padding: var(--spacing-3) var(--spacing-4);
            margin-bottom: var(--spacing-6);
        }

        .mp-ok {
            font-weight: 700;
        }

        .mp-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: var(--spacing-6);
        }

        .mp-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-radius: 6px;
            padding: var(--spacing-8);
            display: flex;
            flex-direction: column;
        }

        .mp-card-title {
            font-family: var(--font);
            font-size: 0.8125rem;
            color: var(--tm-muted);
            margin-bottom: var(--spacing-6);
            letter-spacing: 0.02em;
        }

        .mp-profile-rows {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
            flex: 1;
        }

        .mp-row {
            display: flex;
            align-items: baseline;
            gap: var(--spacing-3);
        }

        .mp-key {
            font-family: var(--font);
            font-size: 0.75rem;
            color: var(--tm-muted);
            min-width: 110px;
            flex-shrink: 0;
        }

        .mp-val {
            font-family: var(--font);
            font-size: 0.875rem;
            color: var(--tm-text);
        }

        .mp-val-active {
            color: #4ade80;
        }

        .mp-id {
            font-size: 0.8125rem;
            background: rgba(77, 159, 212, 0.12);
            color: var(--tm-blue);
            padding: 0.125rem 0.5rem;
            border-radius: 3px;
        }

        .mp-actions {
            margin-top: var(--spacing-8);
            padding-top: var(--spacing-5);
            border-top: 1px solid var(--tm-border);
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-3);
        }

        .mp-btn {
            font-size: 0.8125rem;
        }

        .mp-btn-danger {
            font-family: var(--font);
            font-size: 0.8125rem;
            padding: 0.5rem 1rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            color: var(--tm-red);
            border: 1px solid var(--tm-red);
            position: relative;
            overflow: hidden;
            transition: color var(--transition-fast);
        }

        .mp-btn-danger::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--tm-red);
            transform: translateX(-100%);
            transition: transform var(--transition-base);
            z-index: 0;
        }

        .mp-btn-danger:hover::before {
            transform: translateX(0);
        }

        .mp-btn-danger:hover {
            color: var(--tm-bg);
        }

        .mp-btn-danger span {
            position: relative;
            z-index: 1;
        }

        .mp-status-row {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            margin-bottom: var(--spacing-5);
            flex-wrap: wrap;
        }

        .mp-status-active {
            font-family: var(--font);
            font-size: 0.8125rem;
            font-weight: 700;
            color: #4ade80;
        }

        .mp-status-inactive {
            font-family: var(--font);
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--tm-muted);
        }

        .mp-status-desc {
            font-family: var(--font);
            font-size: 0.75rem;
            color: var(--tm-muted);
        }

        .mp-pitch-block {
            flex: 1;
        }

        .mp-pitch {
            font-family: var(--font);
            font-size: 0.8125rem;
            color: var(--tm-muted);
            margin-bottom: var(--spacing-4);
        }

        .mp-benefits {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: var(--spacing-2);
        }

        .mp-benefits li {
            font-family: var(--font);
            font-size: 0.8125rem;
            color: var(--tm-text);
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
        }

        .mp-bullet {
            color: var(--tm-yellow);
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            .mp-cards {
                grid-template-columns: 1fr;
            }

            .mp-section {
                padding: var(--spacing-8) var(--spacing-4);
            }

            .mp-command {
                font-size: 0.875rem;
                word-break: break-all;
            }
        }

        @media (max-width: 375px) {
            .mp-key {
                min-width: 90px;
            }

            .mp-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</div>
