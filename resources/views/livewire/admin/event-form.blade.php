<div class="page-container">
    @livewire('header')

    <x-admin-nav />

    <section class="admin-content">
        <div class="admin-content-inner">
            <div class="admin-page-header">
                <div>
                    <a href="{{ route('admin.events') }}" class="admin-back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5m7-7l-7 7 7 7"/></svg>
                        Back to events
                    </a>
                    <h1 class="admin-page-title">{{ $event?->exists ? 'Edit: '.$event->title : 'New Event' }}</h1>
                </div>
            </div>

            @if(session('message'))
                <div class="admin-flash admin-flash-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('message') }}
                </div>
            @endif

            <div class="form-layout">
                <div class="form-main">
                    <div class="admin-card">
                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Event Details</h3>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Title <span class="admin-required">*</span></label>
                                <input type="text" wire:model="title" class="admin-input @error('title') admin-input-error @enderror" placeholder="Laravel Meetup Stockholm">
                                @error('title') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="admin-form-row">
                                <div class="admin-form-group">
                                    <label class="admin-form-label">Date & Time <span class="admin-required">*</span></label>
                                    <input type="datetime-local" wire:model="datetimeInput" class="admin-input @error('datetimeInput') admin-input-error @enderror">
                                    @error('datetimeInput') <div class="admin-error">{{ $message }}</div> @enderror
                                </div>
                                <div class="admin-form-group">
                                    <label class="admin-form-label">Location <span class="admin-required">*</span></label>
                                    <input type="text" wire:model="location" class="admin-input @error('location') admin-input-error @enderror" placeholder="Venue, Street, City">
                                    @error('location') <div class="admin-error">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Description <span class="admin-required">*</span></label>
                                <textarea wire:model="description" class="admin-input admin-input-textarea @error('description') admin-input-error @enderror" rows="3" placeholder="Short public description of the event..."></textarea>
                                @error('description') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>

                            <div class="admin-form-group">
                                <label class="admin-form-label">Registration Link</label>
                                <input type="url" wire:model="link" class="admin-input @error('link') admin-input-error @enderror" placeholder="https://lu.ma/...">
                                @error('link') <div class="admin-error">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Details</h3>
                            <p class="admin-form-hint">Additional paragraphs shown in the expanded event view.</p>

                            @foreach($details as $i => $detail)
                                <div class="admin-dynamic-row" wire:key="detail-{{ $i }}">
                                    <textarea wire:model="details.{{ $i }}" class="admin-input admin-input-textarea" rows="2" placeholder="Detail paragraph..."></textarea>
                                    <button wire:click="removeDetailRow({{ $i }})" class="admin-btn-remove" type="button" title="Remove">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                            <button wire:click="addDetailRow" class="admin-btn-add" type="button">+ Add paragraph</button>
                        </div>

                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Schedule</h3>

                            @foreach($schedule as $i => $row)
                                <div class="admin-dynamic-row schedule-row" wire:key="schedule-{{ $i }}">
                                    <input type="text" wire:model="schedule.{{ $i }}.time" class="admin-input time-input" placeholder="17:30">
                                    <input type="text" wire:model="schedule.{{ $i }}.activity" class="admin-input" placeholder="Activity description">
                                    <button wire:click="removeScheduleRow({{ $i }})" class="admin-btn-remove" type="button" title="Remove">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                            <button wire:click="addScheduleRow" class="admin-btn-add" type="button">+ Add row</button>
                        </div>

                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Organizers</h3>

                            @foreach($organizers as $i => $organizer)
                                <div class="admin-organizer-block" wire:key="organizer-{{ $i }}">
                                    <div class="admin-organizer-fields">
                                        <input type="text" wire:model="organizers.{{ $i }}.name" class="admin-input" placeholder="Organization name">
                                        <textarea wire:model="organizers.{{ $i }}.description" class="admin-input admin-input-textarea" rows="2" placeholder="Brief description..."></textarea>
                                    </div>
                                    <button wire:click="removeOrganizerRow({{ $i }})" class="admin-btn-remove" type="button" title="Remove">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                            <button wire:click="addOrganizerRow" class="admin-btn-add" type="button">+ Add organizer</button>
                        </div>

                        <div class="admin-card-section">
                            <h3 class="admin-card-section-title">Footer</h3>
                            <p class="admin-form-hint">Shown at the bottom of the expanded event. Supports HTML (e.g. registration buttons).</p>

                            @foreach($footer as $i => $item)
                                <div class="admin-dynamic-row" wire:key="footer-{{ $i }}">
                                    <textarea wire:model="footer.{{ $i }}" class="admin-input admin-input-textarea" rows="2" placeholder="Footer text or HTML..."></textarea>
                                    <button wire:click="removeFooterRow({{ $i }})" class="admin-btn-remove" type="button" title="Remove">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            @endforeach
                            <button wire:click="addFooterRow" class="admin-btn-add" type="button">+ Add footer item</button>
                        </div>

                        <div class="admin-card-section" style="border-bottom: none;">
                            <h3 class="admin-card-section-title">Closing Message</h3>

                            <div class="admin-form-group">
                                <textarea wire:model="closing" class="admin-input admin-input-textarea" rows="2" placeholder="We hope to see you there!"></textarea>
                            </div>

                            <div class="admin-form-actions">
                                <button wire:click="save" wire:loading.attr="disabled" class="admin-btn admin-btn-save">
                                    <span wire:loading.remove wire:target="save">{{ $event?->exists ? 'Save Changes' : 'Create Event' }}</span>
                                    <span wire:loading wire:target="save">Saving...</span>
                                </button>
                                <a href="{{ route('admin.events') }}" class="admin-btn admin-btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('footer')

    <style>
        .page-container { display: flex; flex-direction: column; min-height: 100vh; }

        .admin-content {
            flex: 1;
            background: var(--gray-50);
            padding: 2rem 1.5rem 4rem;
        }

        .admin-content-inner { max-width: 1400px; margin: 0 auto; }

        .admin-page-header { margin-bottom: 2rem; }

        .admin-back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--gray-500);
            text-decoration: none;
            margin-bottom: 0.75rem;
            transition: color 0.15s;
        }

        .admin-back-link:hover { color: var(--laravel-red); }

        .admin-page-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--gray-900);
            margin: 0;
            letter-spacing: -0.025em;
        }

        .admin-flash {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.25rem;
            border-radius: var(--border-radius-lg);
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .admin-flash-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .form-layout {
            max-width: 1000px;
        }

        .admin-card {
            background: white;
            border-radius: var(--border-radius-xl);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .admin-card-section {
            padding: 1.5rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .admin-card-section-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--gray-400);
            margin: 0 0 1.25rem;
        }

        .admin-form-hint {
            font-size: 0.85rem;
            color: var(--gray-400);
            margin: -0.75rem 0 1.25rem;
        }

        .admin-form-group { margin-bottom: 1.25rem; }

        .admin-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        @media (max-width: 600px) {
            .admin-form-row { grid-template-columns: 1fr; }
        }

        .admin-form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.375rem;
            font-size: 0.875rem;
            color: var(--gray-700);
        }

        .admin-required { color: var(--laravel-red); }

        .admin-input {
            display: block;
            width: 100%;
            padding: 0.625rem 0.875rem;
            font-size: 0.9rem;
            font-family: inherit;
            line-height: 1.5;
            color: var(--gray-700);
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius);
            box-sizing: border-box;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .admin-input:focus {
            border-color: var(--laravel-red);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(255, 45, 32, 0.1);
        }

        .admin-input-textarea { resize: vertical; }
        .admin-input-error { border-color: #dc2626; }
        .admin-error { color: #dc2626; font-size: 0.8rem; margin-top: 0.35rem; }

        .admin-dynamic-row {
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
            margin-bottom: 0.75rem;
        }

        .admin-dynamic-row .admin-input { flex: 1; }

        .schedule-row .time-input { max-width: 90px; flex-shrink: 0; }

        .admin-organizer-block {
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
            margin-bottom: 1rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: var(--border-radius);
            border: 1px solid var(--gray-100);
        }

        .admin-organizer-fields { flex: 1; display: flex; flex-direction: column; gap: 0.75rem; }

        .admin-btn-remove {
            background: none;
            border: 1px solid var(--gray-200);
            color: var(--gray-400);
            border-radius: var(--border-radius-sm);
            width: 32px;
            height: 32px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
            transition: all 0.15s;
        }

        .admin-btn-remove:hover {
            background: #fef2f2;
            border-color: #fecaca;
            color: #dc2626;
        }

        .admin-btn-add {
            background: none;
            border: 1px dashed var(--gray-300);
            color: var(--gray-500);
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.15s;
        }

        .admin-btn-add:hover {
            border-color: var(--laravel-red);
            color: var(--laravel-red);
            background: rgba(255, 45, 32, 0.02);
        }

        .admin-form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            align-items: center;
        }

        .admin-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.75rem;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: opacity 0.15s, transform 0.1s;
        }

        .admin-btn:disabled { opacity: 0.5; cursor: not-allowed; }

        .admin-btn-save {
            background: var(--laravel-red);
            color: white;
        }

        .admin-btn-save:hover:not(:disabled) {
            background: var(--laravel-red-dark);
            transform: translateY(-1px);
        }

        .admin-btn-cancel {
            background: white;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }

        .admin-btn-cancel:hover { background: var(--gray-50); }
    </style>
</div>
