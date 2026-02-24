<div class="admin-page">
    <x-admin-nav />

    <div class="admin-body">
        <div class="admin-page-header">
            <h1 class="admin-page-title">{{ $event?->exists ? 'Edit: '.$event->title : 'New Event' }}</h1>
            <p class="admin-page-desc">
                <a href="{{ route('admin.events') }}">&larr; Back to list</a>
            </p>
        </div>

        @if(session('message'))
            <div class="flash-message flash-success">
                {{ session('message') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message flash-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">

            {{-- Basic Info --}}
            <div class="form-section">
                <h3 class="form-section-title">Event Details</h3>

                <div class="form-group">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror" placeholder="Laravel Meetup Stockholm">
                    @error('title') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Date & Time <span class="required">*</span></label>
                        <input type="datetime-local" wire:model="datetimeInput" class="form-control @error('datetimeInput') is-invalid @enderror">
                        @error('datetimeInput') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Location <span class="required">*</span></label>
                        <input type="text" wire:model="location" class="form-control @error('location') is-invalid @enderror" placeholder="Venue, Street, City">
                        @error('location') <div class="error-message">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description <span class="required">*</span></label>
                    <textarea wire:model="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Short public description of the event..."></textarea>
                    @error('description') <div class="error-message">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Registration Link</label>
                    <input type="url" wire:model="link" class="form-control @error('link') is-invalid @enderror" placeholder="https://lu.ma/...">
                    @error('link') <div class="error-message">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Details --}}
            <div class="form-section">
                <h3 class="form-section-title">Details</h3>
                <p class="form-section-hint">Additional paragraphs shown in the expanded event view.</p>

                @foreach($details as $i => $detail)
                    <div class="dynamic-row" wire:key="detail-{{ $i }}">
                        <textarea wire:model="details.{{ $i }}" class="form-control" rows="2" placeholder="Detail paragraph..."></textarea>
                        <button wire:click="removeDetailRow({{ $i }})" class="btn-remove" type="button" title="Remove">×</button>
                    </div>
                @endforeach
                <button wire:click="addDetailRow" class="btn-add" type="button">+ Add paragraph</button>
            </div>

            {{-- Schedule --}}
            <div class="form-section">
                <h3 class="form-section-title">Schedule</h3>

                @foreach($schedule as $i => $row)
                    <div class="dynamic-row schedule-row" wire:key="schedule-{{ $i }}">
                        <input type="text" wire:model="schedule.{{ $i }}.time" class="form-control time-input" placeholder="17:30">
                        <input type="text" wire:model="schedule.{{ $i }}.activity" class="form-control" placeholder="Activity description">
                        <button wire:click="removeScheduleRow({{ $i }})" class="btn-remove" type="button" title="Remove">×</button>
                    </div>
                @endforeach
                <button wire:click="addScheduleRow" class="btn-add" type="button">+ Add row</button>
            </div>

            {{-- Organizers --}}
            <div class="form-section">
                <h3 class="form-section-title">Organizers</h3>

                @foreach($organizers as $i => $organizer)
                    <div class="organizer-block" wire:key="organizer-{{ $i }}">
                        <div class="organizer-fields">
                            <input type="text" wire:model="organizers.{{ $i }}.name" class="form-control" placeholder="Organization name">
                            <textarea wire:model="organizers.{{ $i }}.description" class="form-control" rows="2" placeholder="Brief description..."></textarea>
                        </div>
                        <button wire:click="removeOrganizerRow({{ $i }})" class="btn-remove" type="button" title="Remove">×</button>
                    </div>
                @endforeach
                <button wire:click="addOrganizerRow" class="btn-add" type="button">+ Add organizer</button>
            </div>

            {{-- Footer --}}
            <div class="form-section">
                <h3 class="form-section-title">Footer</h3>
                <p class="form-section-hint">Shown at the bottom of the expanded event. Supports HTML (e.g. registration buttons).</p>

                @foreach($footer as $i => $item)
                    <div class="dynamic-row" wire:key="footer-{{ $i }}">
                        <textarea wire:model="footer.{{ $i }}" class="form-control" rows="2" placeholder="Footer text or HTML..."></textarea>
                        <button wire:click="removeFooterRow({{ $i }})" class="btn-remove" type="button" title="Remove">×</button>
                    </div>
                @endforeach
                <button wire:click="addFooterRow" class="btn-add" type="button">+ Add footer item</button>
            </div>

            {{-- Closing --}}
            <div class="form-section" style="border-bottom: none;">
                <h3 class="form-section-title">Closing Message</h3>

                <div class="form-group">
                    <textarea wire:model="closing" class="form-control" rows="2" placeholder="We hope to see you there!"></textarea>
                </div>

                <div class="action-buttons">
                    <button wire:click="save" wire:loading.attr="disabled" class="btn btn-save">
                        <span wire:loading.remove wire:target="save">{{ $event?->exists ? 'Save Changes' : 'Create Event' }}</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                    <a href="{{ route('admin.events') }}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>

        </div>
    </div>

    
</div>
