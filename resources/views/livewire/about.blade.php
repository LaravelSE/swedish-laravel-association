<div>
    <!-- About Section -->
    <section class="section" id="about">
        <div class="section-header">
            <h2 class="section-title">What We Do</h2>
            <p class="section-subtitle">We spread knowledge about the Laravel PHP framework through meetings, conferences, websites and other online activities.</p>
        </div>
        <div class="card-grid">
            <div class="card about-card">
                <div class="card-icon">🎓</div>
                <h3>Education & Learning</h3>
                <p>We organize workshops, talks, and educational events to help developers master Laravel and modern PHP development.</p>
            </div>
            <div class="card about-card">
                <div class="card-icon">🤝</div>
                <h3>Community Building</h3>
                <p>Connecting Laravel developers across Sweden through our Slack community, meetups, and networking events.</p>
            </div>
            <div class="card about-card">
                <div class="card-icon">🚀</div>
                <h3>Innovation</h3>
                <p>Supporting the growth of the Laravel ecosystem in Sweden by sharing best practices and promoting modern development techniques.</p>
            </div>
        </div>
    </section>

    @if (count($statistics) > 0)
    <!-- Statistics Section -->
    <section class="section" id="statistics">
        <div class="section-header">
            <h2 class="section-title">Our Impact</h2>
            <p class="section-subtitle">Growing the Laravel community in Sweden since 2022</p>
        </div>
        <div class="statistics-grid">
            @foreach($statistics as $stat)
                <div class="statistic-card">
                    <div class="statistic-icon">{{ $stat['icon'] }}</div>
                    <div class="statistic-number">{{ $stat['number'] }}</div>
                    <div class="statistic-label">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    @if (count($testimonials) > 0)
    <!-- Testimonials Section -->
    <section class="section" id="testimonials">
        <div class="section-header">
            <h2 class="section-title">What People Say</h2>
            <p class="section-subtitle">Hear from our community members</p>
        </div>
        <div class="testimonial-slider">
            <div class="testimonial-container">
                <div class="testimonial-quote">
                    <svg class="quote-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>
                    <p>{{ $testimonials[$currentTestimonial]['quote'] }}</p>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-author-name">{{ $testimonials[$currentTestimonial]['author'] }}</div>
                    <div class="testimonial-author-role">{{ $testimonials[$currentTestimonial]['role'] }}</div>
                </div>
                <div class="testimonial-controls">
                    <button wire:click="prevTestimonial" class="testimonial-control-btn" aria-label="Previous testimonial">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <div class="testimonial-indicators">
                        @for($i = 0; $i < count($testimonials); $i++)
                            <span class="testimonial-indicator {{ $i === $currentTestimonial ? 'active' : '' }}"></span>
                        @endfor
                    </div>
                    <button wire:click="nextTestimonial" class="testimonial-control-btn" aria-label="Next testimonial">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Community Section -->
    <section class="section" id="community">
        <div class="section-header">
            <h2 class="section-title">Join Our Community</h2>
            <p class="section-subtitle">Connect with Laravel developers across Sweden through our various community channels.</p>
        </div>
        <div class="community-grid">
            <div class="community-card">
                <div class="community-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h4>Slack Community</h4>
                <p>Join our active Slack community for real-time discussions, help, and networking.</p>
                <a href="https://bit.ly/laravel-sweden-slack" class="community-link" target="_blank" rel="noopener noreferrer">
                    Join Slack
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
            <div class="community-card">
                <div class="community-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                </div>
                <h4>LinkedIn</h4>
                <p>Follow us on LinkedIn for professional updates and industry news.</p>
                <a href="https://www.linkedin.com/company/swedish-laravel-association/" class="community-link" target="_blank" rel="noopener noreferrer">
                    Follow us
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
            <div class="community-card">
                <div class="community-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </div>
                <h4>Twitter/X</h4>
                <p>Stay updated with the latest news and announcements from our community.</p>
                <a href="https://x.com/laravelsweden" class="community-link" target="_blank" rel="noopener noreferrer">
                    Follow us
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <style>
        .about-card {
            padding: var(--spacing-8);
        }

        .about-card:hover {
            transform: none;
        }

        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: var(--spacing-4);
        }

        .statistic-card {
            background: var(--gray-50);
            border-radius: var(--border-radius-xl);
            padding: var(--spacing-8) var(--spacing-6);
            text-align: center;
            border: 1px solid var(--gray-100);
            transition: border-color var(--transition-base);
        }

        .statistic-card:hover {
            border-color: var(--gray-200);
        }

        .statistic-icon {
            font-size: 2rem;
            margin-bottom: var(--spacing-3);
        }

        .statistic-number {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--gray-950);
            letter-spacing: -0.03em;
            margin-bottom: var(--spacing-1);
        }

        .statistic-label {
            color: var(--gray-500);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .testimonial-slider {
            background: var(--gray-50);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-12) var(--spacing-8);
            border: 1px solid var(--gray-100);
        }

        .testimonial-container {
            max-width: 640px;
            margin: 0 auto;
        }

        .testimonial-quote {
            position: relative;
            padding: 0 var(--spacing-8);
            color: var(--gray-700);
            font-size: 1.1875rem;
            line-height: 1.75;
            text-align: center;
        }

        .quote-icon {
            display: block;
            margin: 0 auto var(--spacing-4);
            color: var(--laravel-red);
            opacity: 0.25;
            width: 32px;
            height: 32px;
        }

        .testimonial-author {
            text-align: center;
            margin-top: var(--spacing-6);
        }

        .testimonial-author-name {
            font-weight: 700;
            font-size: 1rem;
            color: var(--gray-900);
        }

        .testimonial-author-role {
            color: var(--gray-500);
            font-size: 0.875rem;
            margin-top: var(--spacing-1);
        }

        .testimonial-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: var(--spacing-8);
            gap: var(--spacing-4);
        }

        .testimonial-control-btn {
            background: white;
            border: 1px solid var(--gray-200);
            color: var(--gray-600);
            cursor: pointer;
            padding: var(--spacing-2);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-fast);
        }

        .testimonial-control-btn:hover {
            border-color: var(--gray-400);
            color: var(--gray-900);
        }

        .testimonial-indicators {
            display: flex;
            gap: var(--spacing-2);
        }

        .testimonial-indicator {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--gray-300);
            transition: all var(--transition-fast);
        }

        .testimonial-indicator.active {
            background-color: var(--gray-900);
            width: 20px;
            border-radius: 3px;
        }

        .community-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-6);
        }

        .community-card {
            background: var(--gray-50);
            border: 1px solid var(--gray-100);
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-8);
            transition: border-color var(--transition-base);
        }

        .community-card:hover {
            border-color: var(--gray-300);
        }

        .community-icon-wrap {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: white;
            border: 1px solid var(--gray-200);
            color: var(--gray-700);
            margin-bottom: var(--spacing-5);
        }

        .community-card h4 {
            font-size: 1.0625rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
            letter-spacing: -0.02em;
        }

        .community-card p {
            color: var(--gray-500);
            font-size: 0.9375rem;
            line-height: 1.65;
            margin-bottom: var(--spacing-5);
        }

        .community-link {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-1);
            color: var(--gray-900);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: gap var(--transition-fast);
        }

        .community-link:hover {
            gap: var(--spacing-2);
        }

        @media (max-width: 640px) {
            .testimonial-quote {
                padding: 0;
                font-size: 1.0625rem;
            }

            .testimonial-slider {
                padding: var(--spacing-8) var(--spacing-6);
            }
        }
    </style>
</div>
