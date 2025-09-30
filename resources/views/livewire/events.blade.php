<div>
    <section class="section" id="events">
        <div class="section-header">
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">Join us at our upcoming meetups and conferences across Sweden.</p>
        </div>
        @if(count($upcomingEvents) > 0)
            <div class="event-list">
                @foreach($upcomingEvents as $event)
                    <div class="event-card">
                        <div class="event-header" wire:click="toggleEvent({{ $event['id'] }})">
                            <div class="event-date-badge">
                                <span class="event-month">{{ Carbon\Carbon::parse($event['datetime'])->format('M') }}</span>
                                <span class="event-day">{{ Carbon\Carbon::parse($event['datetime'])->format('d') }}</span>
                            </div>
                            <div class="event-info">
                                <h3 class="event-title">{{ $event['title'] }}</h3>
                                <div class="event-meta-container">
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                        </svg>
                                        <span>{{ Carbon\Carbon::parse($event['datetime'])->format('H:i') }}</span>
                                    </div>
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                        </svg>
                                        <span>{{ $event['location'] }}</span>
                                    </div>
                                </div>
                                <p class="event-description">{{ $event['description'] }}</p>
                                <div class="toggle-button">
                                    <button class="btn btn-sm btn-outline">
                                        {{ $this->isExpanded($event['id']) ? 'Show less' : 'Show more' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="{{ $this->isExpanded($event['id']) ? 'rotate-180' : '' }}">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                    @if(array_key_exists('link', $event))
                                    <a href="{{ $event['link'] }}" class="btn btn-big btn-outline">Sign Up</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($this->isExpanded($event['id']))
                            <div class="event-details">
                                <br>
                                @foreach($event['details'] as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach

                                <h4 class="event-subtitle">Schedule</h4>
                                <table class="event-schedule">
                                    <tbody>
                                        @foreach($event['schedule'] as $item)
                                            <tr>
                                                <td>{{ $item['time'] }}</td>
                                                <td>{{ $item['activity'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @foreach($event['footer'] as $footer)
                                    <p>{!! $footer !!}</p>
                                    @if(!$loop->last)
                                        <br>
                                    @endif
                                @endforeach

                                @if(isset($event['organizers']))
                                    <h4 class="event-subtitle">Organizers</h4>
                                    <div class="event-organizers">
                                        @foreach($event['organizers'] as $organizer)
                                            <div class="organizer">
                                                <h5>{{ $organizer['name'] }}</h5>
                                                <p>{{ $organizer['description'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif

                                @if(isset($event['closing']))
                                    <p>{{ $event['closing'] }}</p>
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

    @if(count($pastEvents) > 0)
        <section class="section" id="past-events">
            <div class="section-header">
                <h2 class="section-title">Past Events</h2>
                <p class="section-subtitle">Catch up on our previous meetups and conferences.</p>
            </div>
            <div class="event-list past-events">
                @foreach($pastEvents as $event)
                    <div class="event-card past-event">
                        <div class="event-header" wire:click="toggleEvent({{ $event['id'] }})">
                            <div class="event-date-badge past">
                                <span class="event-month">{{ Carbon\Carbon::parse($event['datetime'])->format('M') }}</span>
                                <span class="event-day">{{ Carbon\Carbon::parse($event['datetime'])->format('d') }}</span>
                            </div>
                            <div class="event-info">
                                <h3 class="event-title">{{ $event['title'] }}</h3>
                                <div class="event-meta-container">
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                        </svg>
                                        <span>{{ Carbon\Carbon::parse($event['datetime'])->format('H:i') }}</span>
                                    </div>
                                    <div class="event-meta-item">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                                        </svg>
                                        <span>{{ $event['location'] }}</span>
                                    </div>
                                </div>
                                <p class="event-description">{{ $event['description'] }}</p>
                                <div class="toggle-button">
                                    <button class="btn btn-sm btn-outline">
                                        {{ $this->isExpanded($event['id']) ? 'Show less' : 'Show more' }}
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="{{ $this->isExpanded($event['id']) ? 'rotate-180' : '' }}">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if($this->isExpanded($event['id']))
                            <div class="event-details">
                                <br>
                                @foreach($event['details'] as $detail)
                                    <p>{!! $detail !!}</p>
                                @endforeach

                                <h4 class="event-subtitle">Schedule</h4>
                                <table class="event-schedule">
                                    <tbody>
                                        @foreach($event['schedule'] as $item)
                                            <tr>
                                                <td>{{ $item['time'] }}</td>
                                                <td>{{ $item['activity'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @foreach($event['footer'] as $footer)
                                    <p>{!! $footer !!}</p>
                                    @if(!$loop->last)
                                        <br>
                                    @endif
                                @endforeach

                                @if(isset($event['organizers']))
                                    <h4 class="event-subtitle">Organizers</h4>
                                    <div class="event-organizers">
                                        @foreach($event['organizers'] as $organizer)
                                            <div class="organizer">
                                                <h5>{{ $organizer['name'] }}</h5>
                                                <p>{{ $organizer['description'] }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                @endif

                                @if(isset($event['closing']))
                                    <p>{{ $event['closing'] }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <style>
        .event-header {
            cursor: pointer;
            display: flex;
            gap: 1rem;
            padding: 1rem;
            border-radius: var(--border-radius);
            align-items: flex-start;
        }

        .event-header:hover {
            background-color: rgba(255, 45, 32, 0.03);
        }

        .event-date-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-width: 60px;
            height: 60px;
            background-color: var(--laravel-red);
            color: white;
            border-radius: 8px;
            text-align: center;
            margin-top: 3px;
        }

        .event-date-badge.past {
            background-color: var(--gray-500);
        }

        .event-month {
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .event-day {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .event-info {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .event-title {
            margin-top: 0;
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .event-meta-container {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 1rem;
            margin-bottom: 0.5rem;
            color: var(--gray-600);
            font-size: 0.9rem;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .event-meta-item svg {
            flex-shrink: 0;
        }

        .event-description {
            margin-bottom: 0.5rem;
        }

        .toggle-button {
            display: flex;
            justify-content: flex-start;
            margin-top: 0.5rem;
            gap: 1rem;
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--laravel-red);
            color: var(--laravel-red);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .btn-big{
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .rotate-180 {
            transform: rotate(180deg);
        }

        .past-events {
            opacity: 0.8;
        }

        .past-event .event-title {
            color: var(--gray-700);
        }

        .no-events {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
        }
    </style>
    <script id="luma-checkout" src="https://embed.lu.ma/checkout-button.js"></script>
</div>
