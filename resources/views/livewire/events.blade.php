<div>
    <section class="section" id="events">
        <div class="section-header">
            <div class="section-cmd">$ events --filter=upcoming --sort=date</div>
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">Join us at our upcoming meetups and conferences across Sweden.</p>
            <div class="section-cta">
                <a href="{{ route('submit-talk') }}" class="btn btn-accent btn-sm-cta"><span>$ submit --talk</span></a>
            </div>
        </div>
        @if($upcomingEvents->isNotEmpty())
            <div class="event-list">
                @foreach($upcomingEvents as $event)
                    <div class="event-card" wire:key="event-{{ $event->id }}">
                        <div class="event-log-bar">
                            <span class="event-log-level">[INFO]</span>
                            <span class="event-log-date">{{ $event->datetime->format('Y-m-d') }}</span>
                            <span class="event-log-sep">&middot;</span>
                            <span class="event-log-loc">{{ $event->location }}</span>
                        </div>
                        <div class="event-header" wire:click="toggleEvent({{ $event->id }})">
                            <div class="event-date-badge">
                                <span class="event-month">{{ $event->datetime->format('M') }}</span>
                                <span class="event-day">{{ $event->datetime->format('d') }}</span>
                            </div>
                            <div class="event-info">
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <div class="event-meta-container">
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span>{{ $event->datetime->format('H:i') }}</span>
                                    </div>
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>
                                <p class="event-description">{{ $event->description }}</p>
                                <div class="event-actions">
                                    <button class="event-toggle-btn">
                                        {{ $this->isExpanded($event->id) ? '-- show less' : '++ show more' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="{{ $this->isExpanded($event->id) ? 'rotate-180' : '' }}"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                    @if($event->link)
                                    <a href="{{ $event->link }}" class="btn btn-accent btn-event-signup" wire:click.stop><span>$ register</span></a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($this->isExpanded($event->id))
                            <div class="event-details">
                                @foreach($event->details as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach

                                <h4 class="event-subtitle"># Schedule</h4>
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
                                    <h4 class="event-subtitle"># Organizers</h4>
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
                                    <p class="event-closing">// {{ $event->closing }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-events">
                <div class="no-events-output">
                    <span class="no-events-arrow">→</span>
                    <span>No upcoming events. <span class="no-events-dim">// check back soon or join our community channels</span></span>
                </div>
            </div>
        @endif
    </section>

    @if($pastEvents->isNotEmpty())
        <section class="section" id="past-events">
            <div class="section-header">
                <div class="section-cmd">$ events --filter=past --sort=date-desc</div>
                <h2 class="section-title">Past Events</h2>
                <p class="section-subtitle">Catch up on our previous meetups and conferences.</p>
            </div>
            <div class="event-list">
                @foreach($pastEvents as $event)
                    <div class="event-card past-event" wire:key="past-event-{{ $event->id }}">
                        <div class="event-log-bar past-log-bar">
                            <span class="event-log-level past-level">[DONE]</span>
                            <span class="event-log-date">{{ $event->datetime->format('Y-m-d') }}</span>
                            <span class="event-log-sep">&middot;</span>
                            <span class="event-log-loc">{{ $event->location }}</span>
                        </div>
                        <div class="event-header" wire:click="toggleEvent({{ $event->id }})">
                            <div class="event-date-badge past">
                                <span class="event-month">{{ $event->datetime->format('M') }}</span>
                                <span class="event-day">{{ $event->datetime->format('d') }}</span>
                            </div>
                            <div class="event-info">
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <div class="event-meta-container">
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                        <span>{{ $event->datetime->format('H:i') }}</span>
                                    </div>
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                        <span>{{ $event->location }}</span>
                                    </div>
                                </div>
                                <p class="event-description">{{ $event->description }}</p>
                                <div class="event-actions">
                                    <button class="event-toggle-btn">
                                        {{ $this->isExpanded($event->id) ? '-- show less' : '++ show more' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="{{ $this->isExpanded($event->id) ? 'rotate-180' : '' }}"><path d="m6 9 6 6 6-6"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if($this->isExpanded($event->id))
                            <div class="event-details">
                                @foreach($event->details as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach

                                <h4 class="event-subtitle"># Schedule</h4>
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
                                    <h4 class="event-subtitle"># Organizers</h4>
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
                                    <p class="event-closing">// {{ $event->closing }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <style>
        .section-cmd {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: var(--tm-yellow);
            margin-bottom: var(--spacing-4);
            letter-spacing: 0;
            font-weight: 400;
        }

        .section-cta {
            margin-top: var(--spacing-6);
        }

        .btn-sm-cta {
            padding: 0.5rem 1rem;
            font-size: 0.75rem;
        }

        .event-list {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-4);
            max-width: 800px;
            margin: 0 auto;
        }

        .event-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            border-left: 3px solid var(--tm-yellow);
            overflow: hidden;
            transition: border-color var(--transition-base);
        }

        .event-card:hover {
            border-color: var(--tm-muted);
            border-left-color: var(--tm-yellow);
        }

        .event-log-bar {
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
            padding: 0.375rem var(--spacing-4);
            background: var(--tm-bg);
            border-bottom: 1px solid var(--tm-border);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.6875rem;
            font-weight: 400;
        }

        .event-log-level {
            color: var(--tm-yellow);
            font-weight: 700;
        }

        .past-level {
            color: var(--tm-muted);
        }

        .event-log-date {
            color: var(--tm-blue);
        }

        .event-log-sep {
            color: var(--tm-border);
        }

        .event-log-loc {
            color: var(--tm-muted);
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
            min-width: 52px;
            height: 52px;
            background: var(--tm-bg);
            border: 1px solid var(--tm-border);
            color: var(--tm-text);
            text-align: center;
            flex-shrink: 0;
        }

        .event-date-badge.past {
            opacity: 0.5;
        }

        .event-month {
            font-size: 0.625rem;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: var(--tm-muted);
            font-family: 'JetBrains Mono', monospace;
        }

        .event-day {
            font-size: 1.25rem;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.02em;
            font-family: 'JetBrains Mono', monospace;
        }

        .event-info {
            flex: 1;
            min-width: 0;
        }

        .event-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--tm-text);
            margin-bottom: var(--spacing-2);
            letter-spacing: -0.02em;
            line-height: 1.3;
            font-family: 'JetBrains Mono', monospace;
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
            color: var(--tm-muted);
            font-size: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
        }

        .event-meta-item svg {
            flex-shrink: 0;
            color: var(--tm-muted);
        }

        .event-description {
            color: var(--tm-muted);
            font-size: 0.875rem;
            line-height: 1.65;
            margin-bottom: var(--spacing-3);
            font-weight: 300;
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
            color: var(--tm-muted);
            font-size: 0.75rem;
            font-weight: 400;
            cursor: pointer;
            padding: 0;
            font-family: 'JetBrains Mono', monospace;
            transition: color var(--transition-fast);
        }

        .event-toggle-btn:hover {
            color: var(--tm-text);
        }

        .btn-event-signup {
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .event-details {
            padding: 0 var(--spacing-6) var(--spacing-6);
            margin-left: calc(52px + var(--spacing-5));
            border-top: 1px solid var(--tm-border);
            padding-top: var(--spacing-5);
        }

        .event-details p {
            color: var(--tm-muted);
            line-height: 1.7;
            font-size: 0.875rem;
            margin-bottom: var(--spacing-3);
            font-weight: 300;
        }

        .event-details a {
            color: var(--tm-blue);
            text-decoration: none;
        }

        .event-details a:hover {
            color: var(--tm-text);
            text-decoration: underline;
        }

        .event-subtitle {
            font-size: 0.875rem;
            font-weight: 700;
            color: var(--tm-muted);
            margin: var(--spacing-6) 0 var(--spacing-3);
            letter-spacing: 0;
            font-family: 'JetBrains Mono', monospace;
        }

        .event-schedule {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: var(--spacing-4);
        }

        .event-schedule td {
            padding: var(--spacing-2) var(--spacing-3);
            font-size: 0.8125rem;
            border-bottom: 1px solid var(--tm-border);
            color: var(--tm-muted);
            font-family: 'JetBrains Mono', monospace;
            font-weight: 300;
        }

        .schedule-time {
            font-weight: 700;
            color: var(--tm-blue);
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
            font-size: 0.8125rem;
            font-weight: 700;
            color: var(--tm-text);
            margin-bottom: var(--spacing-1);
            font-family: 'JetBrains Mono', monospace;
        }

        .organizer p {
            font-size: 0.75rem;
            color: var(--tm-muted);
        }

        .event-closing {
            font-style: italic;
            margin-top: var(--spacing-4);
            color: var(--tm-muted) !important;
        }

        .past-event {
            border-left-color: var(--tm-border);
            opacity: 0.65;
        }

        .past-event:hover {
            opacity: 1;
            border-left-color: var(--tm-muted);
        }

        .past-log-bar {
            background: var(--tm-bg);
        }

        .no-events {
            padding: var(--spacing-12) var(--spacing-6);
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            max-width: 800px;
            margin: 0 auto;
        }

        .no-events-output {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.875rem;
            color: var(--tm-muted);
        }

        .no-events-arrow {
            color: var(--tm-muted);
            font-weight: 700;
        }

        .no-events-dim {
            color: var(--tm-border);
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
