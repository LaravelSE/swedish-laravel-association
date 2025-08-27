<div class="event-card @if($isPast) past-event @endif">
    <div class="event-header" wire:click="toggleEvent({{ $event->id }})">
        <div class="event-date-badge @if($isPast) past @endif">
            <span class="event-month">{{ $event->starts_at->format('M') }}</span>
            <span class="event-day">{{ $event->starts_at->format('d') }}</span>
        </div>
        <div class="event-info">
            <div class="flex justify-between items-start flex-col md:flex-row">
                <div>
                    <h3 class="event-title">{{ $event->title }}</h3>
                    <div class="event-meta-container">
                        <div class="event-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                            </svg>
                            <span>{{ $event->starts_at->format('H:i') }}</span>
                        </div>
                        <div class="event-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z"/>
                            </svg>
                            <span>{{ $event->location }}</span>
                        </div>
                    </div>
                </div>

                @if(!$isPast)
                    <a x-on:click.stop="" href="{{$event->registration_url}}" class="luma-checkout--button" data-luma-action="checkout" data-luma-event-id="evt-HA56UTb2tSc6T9t">{{ $event->registration_text }} <x-heroicon-o-chevron-right height="16" width="16"/></a>
                @endif
            </div>
            <p class="event-teaser">{{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make($event->teaser) }}</p>
            <div class="toggle-button">
                <button class="btn btn-sm btn-outline">
                    {{ $this->isExpanded($event->id) ? 'Show less' : 'Show more' }}
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="{{ $this->isExpanded($event['id']) ? 'rotate-180' : '' }}">
                        <path d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if($this->isExpanded($event->id))
        <div class="event-details">
            {{ \Filament\Forms\Components\RichEditor\RichContentRenderer::make($event->description) }}
            <h4 class="event-subtitle">Schedule</h4>
            <table class="event-schedule">
                <tbody>
                @foreach($event->schedule as $item)
                    <tr>
                        <td>{{ $item['time'] }}</td>
                        <td>{{ $item['activity'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {!! $event->footer !!}

            @if($event->organisers->isNotEmpty())
                <h4 class="event-subtitle">Organizers</h4>
                <div class="event-organizers">
                    @foreach($event->organisers as $organizer)
                        <div class="organizer">
                            <h5>{{ $organizer->name }}</h5>
                            <p>{{ $organizer->description }}</p>
                        </div>
                    @endforeach
                </div>
                <br>
            @endif

            @if(isset($event->closing))
                <p>{{ $event->closing }}</p>
            @endif
        </div>
    @endif
</div>
