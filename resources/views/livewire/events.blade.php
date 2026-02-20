<div>
    <section class="section" id="events">
        <div class="section-header">
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">Join us at our upcoming meetups and conferences across Sweden.</p>
            <div class="section-cta">
                <a href="{{ route('submit-talk') }}" class="btn btn-accent btn-sm-cta">Submit a talk</a>
            </div>
        </div>
        @if($upcomingEvents->isNotEmpty())
            <div class="event-list">
                @foreach($upcomingEvents as $event)
                    <div class="event-card">
                        <div class="event-header" wire:click="toggleEvent({{ $event->id }})">
                            <div class="event-date-badge">
                                <span class="event-month">{{ $event->datetime->format('M') }}</span>
                                <span class="event-day">{{ $event->datetime->format('d') }}</span>
                            </div>
                            <div class="event-info">
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <div class="event-meta-container">
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span>{{ $event->datetime->format('H:i') }}</span>
                                    </div>
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>
                                <p class="event-description">{{ $event->description }}</p>
                                <div class="event-actions">
                                    <button class="event-toggle-btn">
                                        {{ $this->isExpanded($event->id) ? 'Show less' : 'Show more' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="{{ $this->isExpanded($event->id) ? 'rotate-180' : '' }}"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    @if($event->link)
                                    <a href="{{ $event->link }}" class="btn btn-accent btn-event-signup" wire:click.stop>Sign Up</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($this->isExpanded($event->id))
                            <div class="event-details">
                                @foreach($event->details as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach

                                <h4 class="event-subtitle">Schedule</h4>
                                <table class="event-schedule">
                                    <tbody>
                                        @foreach($event->schedule as $item)
                                            <tr>
                                                <td class="schedule-time">{{ $item['time'] }}</td>
                                                <td>{{ $item['activity'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @foreach($event->footer as $footer)
                                    <p>{!! $footer !!}</p>
                                    @if(!$loop->last)
                                        <br>
                                    @endif
                                @endforeach

                                @if($event->organizers)
                                    <h4 class="event-subtitle">Organizers</h4>
                                    <div class="event-organizers">
                                        @foreach($event->organizers as $organizer)
                                            <div class="organizer">
                                                <h5>{{ $organizer['name'] }}</h5>
                                                <p>{{ $organizer['description'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if($event->closing)
                                    <p class="event-closing">{{ $event->closing }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-events">
                <p>No upcoming events at the moment. Check back soon or join our community channels to stay updated!</p>
            </div>
        @endif
    </section>

    @if($pastEvents->isNotEmpty())
        <section class="section" id="past-events">
            <div class="section-header">
                <h2 class="section-title">Past Events</h2>
                <p class="section-subtitle">Catch up on our previous meetups and conferences.</p>
            </div>
            <div class="event-list">
                @foreach($pastEvents as $event)
                    <div class="event-card past-event">
                        <div class="event-header" wire:click="toggleEvent({{ $event->id }})">
                            <div class="event-date-badge past">
                                <span class="event-month">{{ $event->datetime->format('M') }}</span>
                                <span class="event-day">{{ $event->datetime->format('d') }}</span>
                            </div>
                            <div class="event-info">
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <div class="event-meta-container">
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span>{{ $event->datetime->format('H:i') }}</span>
                                    </div>
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>
                                <p class="event-description">{{ $event->description }}</p>
                                <div class="event-actions">
                                    <button class="event-toggle-btn">
                                        {{ $this->isExpanded($event->id) ? 'Show less' : 'Show more' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="{{ $this->isExpanded($event->id) ? 'rotate-180' : '' }}"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if($this->isExpanded($event->id))
                            <div class="event-details">
                                @foreach($event->details as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach

                                <h4 class="event-subtitle">Schedule</h4>
                                <table class="event-schedule">
                                    <tbody>
                                        @foreach($event->schedule as $item)
                                            <tr>
                                                <td class="schedule-time">{{ $item['time'] }}</td>
                                                <td>{{ $item['activity'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @foreach($event->footer as $footer)
                                    <p>{!! $footer !!}</p>
                                    @if(!$loop->last)
                                        <br>
                                    @endif
                                @endforeach

                                @if($event->organizers)
                                    <h4 class="event-subtitle">Organizers</h4>
                                    <div class="event-organizers">
                                        @foreach($event->organizers as $organizer)
                                            <div class="organizer">
                                                <h5>{{ $organizer['name'] }}</h5>
                                                <p>{{ $organizer['description'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if($event->closing)
                                    <p class="event-closing">{{ $event->closing }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <style>
        .section-cta {
            margin-top: var(--spacing-6);
        }

        .btn-sm-cta {
            padding: 0.5rem 1.125rem;
            font-size: 0.8125rem;
        }

        .event-list {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-4);
            max-width: 800px;
            margin: 0 auto;
        }

        .event-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-xl);
            overflow: hidden;
            transition: border-color var(--transition-base);
        }

        .event-card:hover {
            border-color: var(--gray-300);
        }

        .event-header {
            cursor: pointer;
            display: flex;
            gap: var(--spacing-5);
            padding: var(--spacing-6);
            align-items: flex-start;
        }

        .event-date-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 56px;
            height: 56px;
            background: var(--gray-950);
            color: white;
            border-radius: 12px;
            text-align: center;
            flex-shrink: 0;
        }

        .event-date-badge.past {
            background: var(--gray-400);
        }

        .event-month {
            font-size: 0.6875rem;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
            opacity: 0.8;
        }

        .event-day {
            font-size: 1.375rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -0.02em;
        }

        .event-info {
            flex: 1;
            min-width: 0;
        }

        .event-title {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
            letter-spacing: -0.02em;
            line-height: 1.3;
        }

        .event-meta-container {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-4);
            margin-bottom: var(--spacing-3);
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-1);
            color: var(--gray-500);
            font-size: 0.8125rem;
        }

        .event-meta-item svg {
            flex-shrink: 0;
            color: var(--gray-400);
        }

        .event-description {
            color: var(--gray-600);
            font-size: 0.9375rem;
            line-height: 1.65;
            margin-bottom: var(--spacing-3);
        }

        .event-actions {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            margin-top: var(--spacing-2);
        }

        .event-toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-1);
            background: none;
            border: none;
            color: var(--gray-500);
            font-size: 0.8125rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
            transition: color var(--transition-fast);
        }

        .event-toggle-btn:hover {
            color: var(--gray-900);
        }

        .btn-event-signup {
            padding: 0.375rem 1rem;
            font-size: 0.8125rem;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .event-details {
            padding: 0 var(--spacing-6) var(--spacing-6);
            margin-left: calc(56px + var(--spacing-5));
            border-top: 1px solid var(--gray-100);
            padding-top: var(--spacing-5);
        }

        .event-details p {
            color: var(--gray-600);
            line-height: 1.7;
            font-size: 0.9375rem;
            margin-bottom: var(--spacing-3);
        }

        .event-details a {
            color: var(--laravel-red);
            text-decoration: none;
        }

        .event-details a:hover {
            text-decoration: underline;
        }

        .event-subtitle {
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--gray-900);
            margin: var(--spacing-6) 0 var(--spacing-3);
            letter-spacing: -0.01em;
        }

        .event-schedule {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: var(--spacing-4);
        }

        .event-schedule td {
            padding: var(--spacing-2) var(--spacing-3);
            font-size: 0.875rem;
            border-bottom: 1px solid var(--gray-100);
            color: var(--gray-600);
        }

        .schedule-time {
            font-weight: 600;
            color: var(--gray-700);
            white-space: nowrap;
            width: 80px;
        }

        .event-organizers {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: var(--spacing-4);
            margin-bottom: var(--spacing-4);
        }

        .organizer h5 {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: var(--spacing-1);
        }

        .organizer p {
            font-size: 0.8125rem;
            color: var(--gray-500);
        }

        .event-closing {
            font-style: italic;
            margin-top: var(--spacing-4);
        }

        .past-event {
            opacity: 0.7;
        }

        .past-event:hover {
            opacity: 1;
        }

        .no-events {
            text-align: center;
            padding: var(--spacing-12) var(--spacing-6);
            background: var(--gray-50);
            border-radius: var(--border-radius-xl);
            border: 1px solid var(--gray-100);
            color: var(--gray-500);
            max-width: 800px;
            margin: 0 auto;
        }

        @media (max-width: 640px) {
            .event-header {
                flex-direction: column;
                gap: var(--spacing-4);
            }

            .event-details {
                margin-left: 0;
            }

            .event-meta-container {
                flex-direction: column;
                gap: var(--spacing-2);
            }
        }
    </style>
    <script id="luma-checkout" src="https://embed.lu.ma/checkout-button.js"></script>
</div>
