<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swedish Laravel Association - Laravel Sweden</title>
    <meta name="description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://laravelsweden.org/">
    <meta property="og:title" content="Swedish Laravel Association - Laravel Sweden">
    <meta property="og:description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    <meta property="og:image" content="/banner-1500x500.jpeg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://laravelsweden.org/">
    <meta property="twitter:title" content="Swedish Laravel Association - Laravel Sweden">
    <meta property="twitter:description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    <meta property="twitter:image" content="/banner-1500x500.jpeg">

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    <style>
        :root {
            --laravel-red: #FF2D20;
            --laravel-red-dark: #dc2626;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 0.75rem;
            --spacing-4: 1rem;
            --spacing-5: 1.25rem;
            --spacing-6: 1.5rem;
            --spacing-8: 2rem;
            --spacing-12: 3rem;
            --spacing-16: 4rem;
            --spacing-20: 5rem;
            --spacing-24: 6rem;
            --border-radius-sm: 0.375rem;
            --border-radius: 0.5rem;
            --border-radius-lg: 0.75rem;
            --border-radius-xl: 1rem;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--gray-700);
            background: var(--gray-50);
            font-size: 16px;
        }

        /* Skip navigation */
        .skip-nav {
            position: absolute;
            top: -40px;
            left: var(--spacing-4);
            background: var(--laravel-red);
            color: white;
            padding: var(--spacing-2) var(--spacing-4);
            text-decoration: none;
            border-radius: var(--border-radius);
            z-index: 1000;
            font-weight: 600;
            transition: top 0.3s ease;
        }

        .skip-nav:focus {
            top: var(--spacing-4);
        }

        /* Header */
        .header {
            background: white;
            border-bottom: 1px solid var(--gray-200);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 80px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
        }

        .logo img {
            width: 48px;
            height: 48px;
            border-radius: var(--border-radius);
        }

        .logo-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900);
        }

        .nav-links {
            display: flex;
            gap: var(--spacing-8);
        }

        .nav-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-links a:hover {
            color: var(--laravel-red);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--gray-900) 0%, var(--gray-800) 100%);
            color: white;
            padding: var(--spacing-20) 0;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: var(--spacing-6);
            line-height: 1.1;
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--gray-300);
            margin-bottom: var(--spacing-8);
        }

        .hero-cta {
            display: flex;
            gap: var(--spacing-4);
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            padding: var(--spacing-3) var(--spacing-6);
            border-radius: var(--border-radius-lg);
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--laravel-red);
            color: white;
        }

        .btn-primary:hover {
            background: var(--laravel-red-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-secondary:hover {
            background: var(--gray-50);
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-16) var(--spacing-6);
        }

        .section {
            margin-bottom: var(--spacing-20);
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--spacing-12);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--gray-900);
            margin-bottom: var(--spacing-4);
        }

        .section-subtitle {
            font-size: 1.25rem;
            color: var(--gray-600);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Card Grid */
        .card-grid {
            display: grid;
            gap: var(--spacing-8);
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        }

        .card {
            background: white;
            border-radius: var(--border-radius-xl);
            padding: var(--spacing-8);
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-xl);
            transform: translateY(-4px);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            background: var(--laravel-red);
            border-radius: var(--border-radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: var(--spacing-4);
            font-size: 1.5rem;
        }

        .card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-3);
        }

        .card p {
            color: var(--gray-600);
            margin-bottom: var(--spacing-4);
        }

        /* Community Section */
        .community-grid {
            display: grid;
            gap: var(--spacing-6);
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .community-card {
            background: white;
            border-radius: var(--border-radius-xl);
            padding: var(--spacing-6);
            text-align: center;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .community-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .community-icon {
            font-size: 2rem;
            margin-bottom: var(--spacing-4);
        }

        .community-card h4 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
        }

        .community-card p {
            color: var(--gray-600);
            font-size: 0.875rem;
            margin-bottom: var(--spacing-4);
        }

        /* Events Section */
        .event-card {
            background: white;
            border-radius: var(--border-radius-xl);
            padding: var(--spacing-8);
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            border-left: 4px solid var(--laravel-red);
        }

        .event-date {
            display: inline-block;
            background: var(--laravel-red);
            color: white;
            padding: var(--spacing-1) var(--spacing-3);
            border-radius: var(--border-radius);
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: var(--spacing-4);
        }

        .event-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
        }

        .event-location {
            color: var(--gray-600);
            margin-bottom: var(--spacing-4);
            display: flex;
            align-items: center;
            gap: var(--spacing-2);
        }

        /* Board Section */
        .board-grid {
            display: grid;
            gap: var(--spacing-6);
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .board-card {
            background: white;
            border-radius: var(--border-radius-xl);
            padding: var(--spacing-6);
            text-align: center;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .board-card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .board-avatar {
            width: 64px;
            height: 64px;
            background: var(--gray-200);
            border-radius: 50%;
            margin: 0 auto var(--spacing-4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-600);
        }

        .board-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: var(--spacing-1);
        }

        .board-role {
            color: var(--laravel-red);
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: var(--spacing-2);
        }

        .board-company {
            color: var(--gray-500);
            font-size: 0.875rem;
        }

        /* Footer */
        .footer {
            background: var(--gray-900);
            color: var(--gray-400);
            padding: var(--spacing-16) 0 var(--spacing-8);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
            text-align: center;
        }

        .footer-logo {
            width: 48px;
            height: 48px;
            margin: 0 auto var(--spacing-4);
            border-radius: var(--border-radius);
            opacity: 0.8;
        }

        .footer p {
            margin-bottom: var(--spacing-4);
        }

        .footer a {
            color: var(--laravel-red);
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 var(--spacing-4);
                min-height: 70px;
            }

            .nav-links {
                display: none;
            }

            .hero {
                padding: var(--spacing-12) 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-cta {
                flex-direction: column;
                align-items: center;
            }

            .main-content {
                padding: var(--spacing-12) var(--spacing-4);
            }

            .section-title {
                font-size: 2rem;
            }

            .card-grid,
            .community-grid,
            .board-grid {
                grid-template-columns: 1fr;
            }

            .card,
            .event-card {
                padding: var(--spacing-6);
            }
        }

        /* Focus styles for accessibility */
        a:focus, button:focus, input:focus, textarea:focus {
            outline: 3px solid var(--laravel-red);
            outline-offset: 2px;
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <a href="#main-content" class="skip-nav">Hoppa till huvudinnehåll</a>
    
    <header class="header" role="banner">
        <div class="header-content">
            <div class="logo">
                <img src="/square-logo.jpg" alt="Laravel Sweden">
                <span class="logo-text">Laravel Sweden</span>
            </div>
            <nav class="nav-links">
                <a href="#community">Community</a>
                <a href="#events">Events</a>
                <a href="#board">Board</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
    </header>

    <main role="main" id="main-content">
        <section class="hero">
            <div class="hero-content">
                <h1>Swedish Laravel Association</h1>
                <p>Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter på internet.</p>
                <div class="hero-cta">
                    <a href="https://bit.ly/laravelse-slack" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                        Join Our Slack
                    </a>
                    <a href="#contact" class="btn btn-secondary">
                        Get In Touch
                    </a>
                </div>
            </div>
        </section>

        <div class="main-content">
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
                        <a href="https://bit.ly/laravelse-slack" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
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

            <section class="section" id="events">
                <div class="section-header">
                    <h2 class="section-title">Upcoming Events</h2>
                    <p class="section-subtitle">Join us at our upcoming meetups and conferences across Sweden.</p>
                </div>
                <div class="event-card">
                    <span class="event-date">Sept 25, 2024</span>
                    <h3 class="event-title">Laravel Meetup Norrköping</h3>
                    <div class="event-location">
                        <span>📍</span>
                        <span>Norrköping, Sweden</span>
                    </div>
                    <p>Join us for our first meetup in Norrköping! We'll be discussing Laravel best practices, sharing experiences, and networking with fellow developers. More details coming soon!</p>
                </div>
            </section>

            <section class="section" id="board">
                <div class="section-header">
                    <h2 class="section-title">Board Members</h2>
                    <p class="section-subtitle">Meet the team behind Swedish Laravel Association.</p>
                </div>
                <div class="board-grid">
                    <div class="board-card">
                        <div class="board-avatar">ML</div>
                        <div class="board-name">Mikko Lauhakari</div>
                        <div class="board-role">Ordförande</div>
                        <div class="board-company">Glesys AB</div>
                    </div>
                    <div class="board-card">
                        <div class="board-avatar">IB</div>
                        <div class="board-name">Isak Berglind</div>
                        <div class="board-role">Sekreterare</div>
                        <div class="board-company">CampusBokhandel</div>
                    </div>
                    <div class="board-card">
                        <div class="board-avatar">MD</div>
                        <div class="board-name">Martin Danielsson</div>
                        <div class="board-role">Kassör</div>
                        <div class="board-company">ePark</div>
                    </div>
                    <div class="board-card">
                        <div class="board-avatar">TL</div>
                        <div class="board-name">Tommie Lagerroos</div>
                        <div class="board-role">Styrelseledamot</div>
                        <div class="board-company">Techlove</div>
                    </div>
                    <div class="board-card">
                        <div class="board-avatar">OE</div>
                        <div class="board-name">Ola Ebbesson</div>
                        <div class="board-role">Styrelseledamot</div>
                        <div class="board-company">Ceaser Dev</div>
                    </div>
                    <div class="board-card">
                        <div class="board-avatar">JA</div>
                        <div class="board-name">Jonatan Alvarsson</div>
                        <div class="board-role">Revisor</div>
                        <div class="board-company">JA Webb</div>
                    </div>
                    <div class="board-card">
                        <div class="board-avatar">OS</div>
                        <div class="board-name">Oliver Scase</div>
                        <div class="board-role">Suppleant</div>
                        <div class="board-company">Techlove</div>
                    </div>
                </div>
            </section>

            <section class="section" id="contact">
                <div class="section-header">
                    <h2 class="section-title">Get In Touch</h2>
                    <p class="section-subtitle">Have questions or want to get involved? We'd love to hear from you.</p>
                </div>
                <div class="card" style="max-width: 600px; margin: 0 auto; text-align: center;">
                    <div class="card-icon" style="margin: 0 auto var(--spacing-4);">📧</div>
                    <h3>Contact Us</h3>
                    <p>For questions, partnership opportunities, or if you want to get involved with the association.</p>
                    <a href="mailto:hej@laravelsweden.org" class="btn btn-primary">
                        Send us an email
                    </a>
                    <div style="margin-top: var(--spacing-6); padding-top: var(--spacing-6); border-top: 1px solid var(--gray-200);">
                        <h4 style="margin-bottom: var(--spacing-3);">Know a Swedish Laravel Company?</h4>
                        <p style="font-size: 0.875rem; margin-bottom: var(--spacing-4);">Help us build a comprehensive directory of Laravel companies in Sweden.</p>
                        <a href="https://forms.gle/6NPAM4EdPRqe2x9g9" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                            Submit Company
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="footer" role="contentinfo">
        <div class="footer-content">
            <img src="/square-logo.jpg" alt="Laravel Sweden" class="footer-logo">
            <p>Swedish Laravel Association - Laravel Sweden</p>
            <p>Spreading knowledge about Laravel across Sweden</p>
            <p><a href="mailto:hej@laravelsweden.org">hej@laravelsweden.org</a></p>
        </div>
    </footer>
</body>
</html>