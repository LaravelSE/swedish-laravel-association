<div>
    <!-- About Section -->
    <section class="section" id="about">
        <div class="section-header">
            <div class="section-cmd">$ section --name="what-we-do" --type=about</div>
            <h2 class="section-title">What We Do</h2>
            <p class="section-subtitle">We spread knowledge about the Laravel PHP framework through meetings, conferences, websites and other online activities.</p>
        </div>
        <div class="card-grid">
            <div class="card about-card">
                <div class="card-icon about-icon">01</div>
                <h3>Education &amp; Learning</h3>
                <p>We organize workshops, talks, and educational events to help developers master Laravel and modern PHP development.</p>
            </div>
            <div class="card about-card">
                <div class="card-icon about-icon">02</div>
                <h3>Community Building</h3>
                <p>Connecting Laravel developers across Sweden through our Slack community, meetups, and networking events.</p>
            </div>
            <div class="card about-card">
                <div class="card-icon about-icon">03</div>
                <h3>Innovation</h3>
                <p>Supporting the growth of the Laravel ecosystem in Sweden by sharing best practices and promoting modern development techniques.</p>
            </div>
        </div>
    </section>

    @if (count($statistics) > 0)
    <!-- Statistics Section -->
    <section class="section" id="statistics">
        <div class="section-header">
            <div class="section-cmd">$ stats --output=json --pretty</div>
            <h2 class="section-title">Our Impact</h2>
            <p class="section-subtitle">Growing the Laravel community in Sweden since 2022</p>
        </div>
        <div class="statistics-grid">
            @foreach($statistics as $stat)
                <div class="statistic-card">
                    <div class="stat-output-line">
                        <span class="stat-arrow">→</span>
                        <span class="stat-number">{{ $stat['number'] }}</span>
                    </div>
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
            <div class="section-cmd">$ testimonials --list --verified</div>
            <h2 class="section-title">What People Say</h2>
            <p class="section-subtitle">Hear from our community members</p>
        </div>
        <div class="testimonial-slider">
            <div class="testimonial-container">
                <div class="testimonial-quote">
                    <span class="testimonial-prefix">// </span>
                    <p>{{ $testimonials[$currentTestimonial]['quote'] }}</p>
                </div>
                <div class="testimonial-author">
                    <div class="testimonial-author-name">{{ $testimonials[$currentTestimonial]['author'] }}</div>
                    <div class="testimonial-author-role">{{ $testimonials[$currentTestimonial]['role'] }}</div>
                </div>
                <div class="testimonial-controls">
                    <button wire:click="prevTestimonial" class="testimonial-control-btn" aria-label="Previous testimonial">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>
                    <div class="testimonial-indicators">
                        @for($i = 0; $i < count($testimonials); $i++)
                            <span class="testimonial-indicator {{ $i === $currentTestimonial ? 'active' : '' }}"></span>
                        @endfor
                    </div>
                    <button wire:click="nextTestimonial" class="testimonial-control-btn" aria-label="Next testimonial">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
            <div class="section-cmd">$ community --connect --year={{ date('Y') }}</div>
            <h2 class="section-title">Join Our Community</h2>
            <p class="section-subtitle">Connect with Laravel developers across Sweden through our various community channels.</p>
        </div>
        <div class="community-grid">
            <div class="community-card">
                <div class="community-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h4>Slack Community</h4>
                <p>Join our active Slack community for real-time discussions, help, and networking.</p>
                <a href="https://bit.ly/laravel-sweden-slack" class="community-link" target="_blank" rel="noopener noreferrer">
                    <span class="community-link-prompt">$</span> open slack
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
            <div class="community-card">
                <div class="community-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
                </div>
                <h4>LinkedIn</h4>
                <p>Follow us on LinkedIn for professional updates and industry news.</p>
                <a href="https://www.linkedin.com/company/swedish-laravel-association/" class="community-link" target="_blank" rel="noopener noreferrer">
                    <span class="community-link-prompt">$</span> open linkedin
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
            <div class="community-card">
                <div class="community-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </div>
                <h4>Twitter/X</h4>
                <p>Stay updated with the latest news and announcements from our community.</p>
                <a href="https://x.com/laravelsweden" class="community-link" target="_blank" rel="noopener noreferrer">
                    <span class="community-link-prompt">$</span> open twitter
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    
</div>
