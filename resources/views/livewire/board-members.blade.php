<div>
    <section class="section" id="board">
        <div class="section-header">
            <h2 class="section-title">Board Members</h2>
            <p class="section-subtitle">Meet the team behind Swedish Laravel Association.</p>
        </div>
        <div class="board-grid">
            @foreach($boardMembers as $member)
                <div class="board-card">
                    <div class="board-avatar">
                        <img src="{{ $member->imageUrl() }}" alt="{{ $member->name }}" width="96" height="96" loading="lazy">
                    </div>
                    <div class="board-info">
                        <div class="board-name">{{ $member->name }}</div>
                        <div class="board-role">{{ $member->role }}</div>
                        <div class="board-company">{{ $member->company }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <style>
        .board-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: var(--spacing-4);
            max-width: 900px;
            margin: 0 auto;
        }

        .board-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--border-radius-xl);
            padding: var(--spacing-8) var(--spacing-6);
            text-align: center;
            transition: border-color var(--transition-base);
        }

        .board-card:hover {
            border-color: var(--gray-300);
        }

        .board-avatar {
            margin-bottom: var(--spacing-5);
        }

        .board-avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--gray-100);
        }

        .board-name {
            font-size: 1rem;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.02em;
            margin-bottom: var(--spacing-1);
        }

        .board-role {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--laravel-red);
            margin-bottom: var(--spacing-1);
        }

        .board-company {
            font-size: 0.8125rem;
            color: var(--gray-500);
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
                width: 64px;
                height: 64px;
            }
        }
    </style>
</div>
