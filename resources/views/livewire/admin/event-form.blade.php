<div class="page-container">
    @livewire('header')

    <section class="section main-content" style="padding-top: 2rem;">
        <div class="section-header">
            <h2 class="section-title">{{ $event?->exists ? 'Edit: '.$event->title : 'New Event' }}</h2>
            <p class="section-subtitle">
                <a href="{{ route('admin.events') }}">&larr; Back to list</a>
            </p>
        </div>

        @if(session('message'))
            <div class="flash-message" style="max-width: 800px; margin: 0 auto 1rem;">
                {{ session('message') }}
            </div>
        @endif

        <div class="card" style="max-width: 800px; margin: 0 auto;">

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
    </section>

    @livewire('footer')

    <style>
        .page-container { display: flex; flex-direction: column; min-height: 100vh; }
        .main-content { flex: 1; }

        .form-section {
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--gray-900);
        }

        .form-section-hint {
            font-size: 0.85rem;
            color: var(--gray-500);
            margin-bottom: 1rem;
        }

        .form-group { margin-bottom: 1rem; }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 600px) {
            .form-row { grid-template-columns: 1fr; }
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            color: var(--gray-700);
        }

        .required { color: #FF2D20; }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #FF2D20;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 45, 32, 0.25);
        }

        .form-control.is-invalid { border-color: #dc3545; }
        .error-message { color: #dc3545; font-size: 0.85rem; margin-top: 0.25rem; }

        .dynamic-row {
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
            margin-bottom: 0.5rem;
        }

        .dynamic-row .form-control { flex: 1; }

        .schedule-row .time-input { max-width: 80px; }

        .organizer-block {
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: var(--gray-50, #f9fafb);
            border-radius: 0.25rem;
        }

        .organizer-fields { flex: 1; display: flex; flex-direction: column; gap: 0.5rem; }

        .btn-remove {
            background: none;
            border: 1px solid var(--gray-300, #d1d5db);
            color: var(--gray-500);
            border-radius: 0.25rem;
            width: 28px;
            height: 28px;
            cursor: pointer;
            font-size: 1.1rem;
            line-height: 1;
            padding: 0;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .btn-remove:hover { background: #f8d7da; border-color: #dc3545; color: #dc3545; }

        .btn-add {
            background: none;
            border: 1px dashed var(--gray-300, #d1d5db);
            color: var(--gray-500);
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            cursor: pointer;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .btn-add:hover { border-color: #FF2D20; color: #FF2D20; }

        .action-buttons { display: flex; gap: 1rem; margin-top: 1.5rem; align-items: center; }

        .btn {
            padding: 0.625rem 1.5rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .btn-save { background-color: #FF2D20; color: white; }
        .btn-save:hover:not(:disabled) { background-color: #e0261b; }

        .btn-cancel { background-color: var(--gray-100, #f3f4f6); color: var(--gray-700); }
        .btn-cancel:hover { background-color: var(--gray-200, #e5e7eb); }

        .flash-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .section-subtitle a { color: #FF2D20; text-decoration: none; }
        .section-subtitle a:hover { text-decoration: underline; }
    </style>
</div>
