<div>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-label">// swedish_laravel_association</div>
            <h1 class="hero-title"><span class="hero-prompt">&gt;</span> Build with Laravel.<br>Grow with Sweden.</h1>
            <p class="hero-description"><span class="hero-comment">#</span> We bring together Laravel developers across Sweden through meetups, conferences, and an active online community.</p>
            <div class="hero-cta">
                <a href="https://bit.ly/laravel-sweden-slack" class="btn btn-primary btn-hero" target="_blank" rel="noopener noreferrer">
                    <span>Join Our Slack</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="#events" class="btn btn-secondary btn-hero">
                    <span>Upcoming Events</span>
                </a>
            </div>
        </div>
        <div class="hero-terminal-line" aria-hidden="true">
            <span class="ht-prompt">~</span>
            <span class="ht-cmd">php artisan serve --host=stockholm --port=8000</span>
            <span class="ht-cursor">|</span>
        </div>
    </section>

    <style>
        .hero {
            position: relative;
            overflow: hidden;
            padding: var(--spacing-32) var(--spacing-6) var(--spacing-24);
            background: var(--tm-bg);
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--tm-border);
        }

        .hero-content {
            max-width: 760px;
            margin: 0 auto;
            text-align: left;
            position: relative;
        }

        .hero-label {
            font-size: 0.8125rem;
            color: var(--tm-blue);
            font-family: 'JetBrains Mono', monospace;
            font-weight: 400;
            margin-bottom: var(--spacing-5);
            letter-spacing: 0;
        }

        .hero-title {
            font-size: clamp(2rem, 5.5vw, 3.5rem);
            font-weight: 700;
            color: var(--tm-text);
            letter-spacing: -0.03em;
            line-height: 1.1;
            margin-bottom: var(--spacing-6);
            font-family: 'JetBrains Mono', monospace;
        }

        .hero-prompt {
            color: var(--tm-yellow);
            margin-right: 0.5rem;
            font-weight: 700;
        }

        .hero-description {
            font-size: 1rem;
            color: var(--tm-muted);
            line-height: 1.75;
            max-width: 560px;
            margin-bottom: var(--spacing-10);
            font-weight: 300;
            font-family: 'JetBrains Mono', monospace;
        }

        .hero-comment {
            color: var(--tm-muted-dim);
            margin-right: 0.5rem;
            font-weight: 400;
        }

        .hero-cta {
            display: flex;
            gap: var(--spacing-4);
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
        }

        .hero-terminal-line {
            position: absolute;
            bottom: var(--spacing-8);
            right: var(--spacing-6);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: var(--tm-border);
            display: flex;
            gap: 0.5rem;
            align-items: center;
            opacity: 0.5;
        }

        .ht-prompt {
            color: var(--tm-blue);
        }

        .ht-cmd {
            color: var(--tm-muted);
        }

        .ht-cursor {
            animation: blink 1s step-end infinite;
            color: var(--tm-muted);
        }

        @media (max-width: 640px) {
            .hero {
                padding: var(--spacing-20) var(--spacing-6) var(--spacing-16);
            }

            .hero-cta {
                flex-direction: column;
            }

            .btn-hero {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }

            .hero-terminal-line {
                display: none;
            }
        }
    </style>
</div>
