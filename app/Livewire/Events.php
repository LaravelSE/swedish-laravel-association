<?php

namespace App\Livewire;

use App\Models\Events\Event;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;

class Events extends Component
{
    /** @var Collection<int,Event> */
    public Collection $events;

    /** @var Collection<int,Event> */
    public Collection $upcomingEvents;

    /** @var Collection<int,Event> */
    public Collection $pastEvents;

    /** @var Collection<int,bool> */
    public Collection $expandedEvents;

    public function mount()
    {
        $this->expandedEvents = collect();
        $this->events = Event::all();
        $this->upcomingEvents = Event::upcoming()->get();
        $this->pastEvents = Event::past()->get();
//        $this->events = [
//            [
//                'id' => 1,
//                'title' => 'Laravel Meetup Norrköping',
//                'date' => 'Sept 25, 2025',
//                'datetime' => Carbon::parse('2025-09-25 17:30:00', 'Europe/Stockholm'),
//                'location' => 'Åtta91, Sandgatan 11, Norrköping',
//                'description' => 'Welcome to the first Laravel meetup in Östergötland and Norrköping! Join us for Laravel talks, networking with the community, and enjoy some refreshments and drinks.',
//                'details' => [
//                    'The event is hosted at Åtta91 in central Norrköping. This meetup is sponsored by Oderland - visit Oderland.se to learn more about their services for Laravel developers.',
//                    'Location: Åtta91 office, Sandgatan 11, Norrköping',
//                    'Date: September 25, 2025',
//                    'Time: 18:00-21:00 (networking starts at 17:30)',
//                ],
//                'schedule' => [
//                    ['time' => '17:30', 'activity' => 'Welcome, snacks and drinks'],
//                    ['time' => '18:00', 'activity' => 'Introduction'],
//                    ['time' => '18:05', 'activity' => 'There and back again: Our Journey with Repositories in Laravel (Isak Berglind)'],
//                    ['time' => '18:30', 'activity' => 'Dinner break'],
//                    ['time' => '19:00', 'activity' => 'Agentic Coding with Claude Code (Peter Elmered) (preliminary subject)'],
//                    ['time' => '19:30', 'activity' => 'Networking, followed by after-work drinks nearby for those interested'],
//                ],
//                'footer' => [
//                    'The venue is less than a 10-minute walk from Norrköping Central Station (1h 15min by train from Stockholm). Parking is available in the nearby parking garage and street parking in the area.',
//                    '<a href="https://lu.ma/event/evt-HA56UTb2tSc6T9t" class="luma-checkout--button" data-luma-action="checkout" data-luma-event-id="evt-HA56UTb2tSc6T9t">Register for Event</a>',
//                ],
//                'organizers' => [
//                    [
//                        'name' => 'Åtta91',
//                        'description' => 'Åtta91 is a digital agency based in Norrköping that specializes in web development and digital solutions for businesses.',
//                    ],
//                    [
//                        'name' => 'Oderland',
//                        'description' => 'Oderland is a Swedish web hosting company that provides specialized hosting services for Laravel applications.',
//                    ],
//                ],
//                'closing' => 'We hope to see you at the first Laravel meetup in Norrköping!',
//            ],
//            [
//                'id' => 2,
//                'title' => 'Laravel Meetup Stockholm',
//                'date' => 'Oct 1, 2025',
//                'datetime' => Carbon::parse('2025-10-01 17:00:00', 'Europe/Stockholm'),
//                'location' => 'Kameo, Tegnérgatan 8, Stockholm',
//                'description' => 'Welcome to the first Laravel Meetup of the year in Stockholm! Whether you are an experienced Laravel or PHP developer, or just starting out, this evening brings together developers, enthusiasts, and the curious for inspiration, knowledge sharing, and networking.',
//                'details' => [
//                    'Join us to catch up on trends, hear engaging talks, and chat about code over snacks and drinks. The event is free, open to all, and whether you come alone or in a group, you are warmly welcome into the community.',
//                    'Location: Kameo, Tegnérgatan 8, 113 58 Stockholm',
//                    'Date: Wednesday, October 1, 2025',
//                    'Doors open at 17:00, first session starts at 17:30. The main event wraps up around 19:45, after which we\'ll continue at a nearby bar for those who wish.',
//                ],
//                'schedule' => [
//                    ['time' => '17:00', 'activity' => 'Doors open – mingle and get in the mood'],
//                    ['time' => '17:30', 'activity' => 'Session 1: Presentations and inspiration'],
//                    ['time' => '18:15', 'activity' => 'Break: Snacks and drinks'],
//                    ['time' => '18:45', 'activity' => 'Session 2: More talks and closing'],
//                    ['time' => '19:45', 'activity' => 'Afterparty at a nearby bar'],
//                ],
//                'footer' => [
//                    'The event is for anyone working with or interested in PHP and Laravel – no seniority required. We\'ll provide snacks and drinks throughout the evening, and there are always chances to network with fellow developers.',
//                    'The event is hosted by Techlove in collaboration with Kameo and is the first meetup supported by the newly launched Swedish Laravel Association. Many thanks also to Laravel for their collaboration and support for the community.',
//                ],
//                'organizers' => [
//                    [
//                        'name' => 'Kameo',
//                        'description' => 'Kameo is an investment platform that enables both private individuals and institutional investors to invest in secured loans for real estate projects in Scandinavia. They use Laravel to build stable and reliable systems that meet high demands for security and scalability.',
//                    ],
//                    [
//                        'name' => 'Techlove',
//                        'description' => 'Techlove supports businesses all the way from prototype to full-scale business systems, focusing on smart development, business value, and an active developer community around Laravel and PHP.',
//                    ],
//                    [
//                        'name' => 'Swedish Laravel Association',
//                        'description' => 'Community hub for Laravel developers in Sweden',
//                    ],
//                ],
//                'closing' => 'Mark the date in your calendar and stay tuned for more information – we hope to see you on October 1 at Laravel Meetup Stockholm!',
//            ],
//        ];

        $this->sortEvents();
    }

    public function sortEvents()
    {
        $now = Carbon::now();

        $this->upcomingEvents = collect($this->events)
            ->filter(function ($event) use ($now) {
                return Carbon::parse($event['datetime'])->isAfter($now);
            })
            ->sortBy('datetime')
            ->values();

        $this->pastEvents = collect($this->events)
            ->filter(function ($event) use ($now) {
                return Carbon::parse($event['datetime'])->isBefore($now);
            })
            ->sortByDesc('datetime')
            ->values();
    }

    public function toggleEvent($eventId)
    {
        if ($this->expandedEvents->has($eventId)) {
            $this->expandedEvents = $this->expandedEvents->except($eventId);
            return;
        }

        $this->expandedEvents->put($eventId, true);
    }

    public function isExpanded($eventId)
    {
        return $this->expandedEvents->has($eventId);
    }

    public function render()
    {
        return view('livewire.events');
    }
}
