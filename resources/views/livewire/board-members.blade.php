<div>
    <section class="section" id="board">
        <div class="section-header">
            <div class="section-cmd">$ board --list --format=table</div>
            <h2 class="section-title">Board Members</h2>
            <p class="section-subtitle">Meet the team behind Swedish Laravel Association.</p>
        </div>
        <div class="board-grid">
            @foreach($boardMembers as $member)
                <div class="board-card" wire:key="board-{{ $member->id }}">
                    <div class="board-avatar">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" width="80" height="80" loading="lazy">
                    </div>
                    <div class="board-info">
                        <div class="board-name">{{ $member->name }}</div>
                        <div class="board-role">{{ $member->role }}</div>
                        <div class="board-company">// {{ $member->company }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <style>
        .section-cmd {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: var(--tm-yellow);
            margin-bottom: var(--spacing-4);
            letter-spacing: 0;
            font-weight: 400;
        }

        .board-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: var(--spacing-4);
            max-width: 900px;
            margin: 0 auto;
        }

        .board-card {
            background: var(--tm-surface);
            border: 1px solid var(--tm-border);
            padding: var(--spacing-8) var(--spacing-6);
            text-align: center;
            transition: border-color var(--transition-base);
            position: relative;
        }

        .board-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: transparent;
            transition: background var(--transition-base);
        }

        .board-card:hover {
            border-color: var(--tm-muted);
        }

        .board-card:hover::before {
            background: var(--tm-blue);
        }

        .board-avatar {
            margin-bottom: var(--spacing-5);
        }

        .board-avatar img {
            width: 72px;
            height: 72px;
            border-radius: 0;
            object-fit: cover;
            border: 1px solid var(--tm-border);
            filter: grayscale(20%);
            transition: filter var(--transition-base), border-color var(--transition-base);
        }

        .board-card:hover .board-avatar img {
            filter: grayscale(0%);
            border-color: var(--tm-muted);
        }

        .board-name {
            font-size: 0.9375rem;
            font-weight: 700;
            color: var(--tm-text);
            letter-spacing: -0.02em;
            margin-bottom: var(--spacing-1);
            font-family: 'JetBrains Mono', monospace;
        }

        .board-role {
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--tm-blue);
            margin-bottom: var(--spacing-1);
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0;
        }

        .board-company {
            font-size: 0.75rem;
            color: var(--tm-muted);
            font-family: 'JetBrains Mono', monospace;
            font-weight: 300;
        }

        @media (max-width: 640px) {
            .board-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: var(--spacing-3);
            }

            .board-card {
                padding: var(--spacing-6) var(--spacing-4);
            }

            .board-avatar img {
                width: 56px;
                height: 56px;
            }
        }
    </style>
</div>
