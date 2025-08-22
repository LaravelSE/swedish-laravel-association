<div>
    <!-- About Section -->
    <section class="section" id="about">
        <div class="section-header">
            <h2 class="section-title">What We Do</h2>
            <p class="section-subtitle">We spread knowledge about the Laravel PHP framework through meetings, conferences, websites and other online activities.</p>
        </div>
        <div class="card-grid">
            <div class="card">
                <div class="card-icon">🎓</div>
                <h3>Education & Learning</h3>
                <p>We organize workshops, talks, and educational events to help developers master Laravel and modern PHP development.</p>
            </div>
            <div class="card">
                <div class="card-icon">🤝</div>
                <h3>Community Building</h3>
                <p>Connecting Laravel developers across Sweden through our Slack community, meetups, and networking events.</p>
            </div>
            <div class="card">
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
                    <svg class="quote-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>
                    <p>{{ $testimonials[$currentTestimonial]['quote'] }}</p>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-author-name">{{ $testimonials[$currentTestimonial]['author'] }}</div>
                    <div class="testimonial-author-role">{{ $testimonials[$currentTestimonial]['role'] }}</div>
                </div>
                <div class="testimonial-controls">
                    <button wire:click="prevTestimonial" class="testimonial-control-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <div class="testimonial-indicators">
                        @for($i = 0; $i < count($testimonials); $i++)
                            <span class="testimonial-indicator {{ $i === $currentTestimonial ? 'active' : '' }}"></span>
                        @endfor
                    </div>
                    <button wire:click="nextTestimonial" class="testimonial-control-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                <div class="community-icon">💬</div>
                <h4>Slack Community</h4>
                <p>Join our active Slack community for real-time discussions, help, and networking.</p>
                <a href="https://join.slack.com/t/laravel-sweden/shared_invite/zt-3c8n148lc-nWo_0tO9cNtU~CJJR9nNUg" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                    Join Slack
                </a>
            </div>
            <div class="community-card">
                <div class="community-icon">💼</div>
                <h4>LinkedIn</h4>
                <p>Follow us on LinkedIn for professional updates and industry news.</p>
                <a href="https://www.linkedin.com/company/swedish-laravel-association/" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                    Follow us
                </a>
            </div>
            <div class="community-card">
                <div class="community-icon">🐦</div>
                <h4>Twitter/X</h4>
                <p>Stay updated with the latest news and announcements from our community.</p>
                <a href="https://x.com/laravelsweden" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                    Follow us
                </a>
            </div>
        </div>
    </section>

    <style>
        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-6);
            margin-top: var(--spacing-8);
        }

        .statistic-card {
            background: white;
            border-radius: var(--border-radius);
            padding: var(--spacing-6);
            box-shadow: var(--shadow-sm);
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .statistic-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .statistic-icon {
            font-size: 2.5rem;
            margin-bottom: var(--spacing-2);
        }

        .statistic-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--laravel-red);
            margin-bottom: var(--spacing-1);
        }

        .statistic-label {
            color: var(--gray-600);
            font-size: 1rem;
        }

        .testimonial-slider {
            margin-top: var(--spacing-8);
            background: white;
            border-radius: var(--border-radius);
            padding: var(--spacing-6);
            box-shadow: var(--shadow-sm);
        }

        .testimonial-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .testimonial-quote {
            position: relative;
            padding: var(--spacing-6) var(--spacing-8);
            font-style: italic;
            color: var(--gray-700);
            font-size: 1.125rem;
            line-height: 1.6;
        }

        .quote-icon {
            position: absolute;
            top: 0;
            left: 0;
            color: var(--laravel-red);
            opacity: 0.2;
            width: 32px;
            height: 32px;
        }

        .testimonial-author {
            text-align: center;
            margin-top: var(--spacing-4);
        }

        .testimonial-author-name {
            font-weight: 600;
            font-size: 1.125rem;
        }

        .testimonial-author-role {
            color: var(--gray-600);
            font-size: 0.875rem;
        }

        .testimonial-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: var(--spacing-4);
        }

        .testimonial-control-btn {
            background: transparent;
            border: none;
            color: var(--laravel-red);
            cursor: pointer;
            padding: var(--spacing-2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s ease;
        }

        .testimonial-control-btn:hover {
            background-color: rgba(255, 45, 32, 0.1);
        }

        .testimonial-indicators {
            display: flex;
            gap: var(--spacing-2);
            margin: 0 var(--spacing-4);
        }

        .testimonial-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--gray-300);
            transition: background-color 0.2s ease;
        }

        .testimonial-indicator.active {
            background-color: var(--laravel-red);
        }
    </style>
</div>
