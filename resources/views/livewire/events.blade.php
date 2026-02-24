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
                                    <p>{{ $detail }}</p>
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
                                    <p>{{ $footer }}</p>
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
                                    <p>{{ $detail }}</p>
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
                                    <p>{{ $footer }}</p>
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

    
    <script id="luma-checkout" src="https://embed.lu.ma/checkout-button.js"></script>
</div>
