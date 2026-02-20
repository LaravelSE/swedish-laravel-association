<div>
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">The Swedish Laravel Community</div>
            <h1 class="hero-title">Build with Laravel.<br>Grow with Sweden.</h1>
            <p class="hero-description">We bring together Laravel developers across Sweden through meetups, conferences, and an active online community.</p>
            <div class="hero-cta">
                <a href="https://bit.ly/laravel-sweden-slack" class="btn btn-primary btn-hero" target="_blank" rel="noopener noreferrer">
                    Join Our Slack
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
                <a href="#events" class="btn btn-secondary btn-hero">
                    Upcoming Events
                </a>
            </div>
        </div>
    </section>

    <style>
        .hero {
            position: relative;
            overflow: hidden;
            padding: var(--spacing-32) var(--spacing-6) var(--spacing-24);
            background: linear-gradient(180deg, white 0%, var(--gray-50) 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -20%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 45, 32, 0.04) 0%, transparent 70%);
            pointer-events: none;
        }

        .hero-content {
            max-width: 720px;
            margin: 0 auto;
            text-align: center;
            position: relative;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            background: var(--laravel-red-light);
            color: var(--laravel-red);
            padding: 0.375rem 1rem;
            border-radius: 9999px;
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: -0.01em;
            margin-bottom: var(--spacing-6);
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            color: var(--gray-950);
            letter-spacing: -0.045em;
            line-height: 1.08;
            margin-bottom: var(--spacing-6);
        }

        .hero-description {
            font-size: 1.1875rem;
            color: var(--gray-500);
            line-height: 1.7;
            max-width: 520px;
            margin: 0 auto var(--spacing-10);
        }

        .hero-cta {
            display: flex;
            gap: var(--spacing-3);
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-hero {
            padding: 0.75rem 1.5rem;
            font-size: 0.9375rem;
        }

        @media (max-width: 640px) {
            .hero {
                padding: var(--spacing-20) var(--spacing-6) var(--spacing-16);
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .btn-hero {
                width: 100%;
                max-width: 280px;
                justify-content: center;
            }
        }
    </style>
</div>
