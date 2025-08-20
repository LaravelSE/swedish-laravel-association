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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #374151;
            background: #ffffff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .header {
            background: linear-gradient(135deg, #1f2937 0%, #111827 50%, #FF2D20 100%);
            color: white;
            padding: 120px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 45, 32, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        .main-heading {
            max-width: 600px;
            width: 100%;
            height: auto;
            margin: 0 auto 40px;
            position: relative;
            z-index: 10;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 1s ease-out;
        }

        .main-heading img {
            width: 100%;
            height: auto;
            border-radius: 16px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .header .subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            font-weight: 400;
            color: #9ca3af;
        }

        .logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 32px;
            position: relative;
            z-index: 10;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: pulse 3s ease-in-out infinite;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 10px 30px rgba(255, 45, 32, 0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 15px 40px rgba(255, 45, 32, 0.4);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }

        .content {
            padding: 80px 0;
            background: linear-gradient(45deg, #f9fafb 0%, #ffffff 50%, #f3f4f6 100%);
            position: relative;
        }

        .content::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 80%, rgba(255, 45, 32, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 45, 32, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        .section {
            margin-bottom: 64px;
            position: relative;
            z-index: 10;
        }

        .section h2 {
            font-size: 2.5rem;
            margin-bottom: 32px;
            background: linear-gradient(135deg, #111827 0%, #FF2D20 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            position: relative;
        }

        .section h2::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, #FF2D20, #dc2626);
            border-radius: 2px;
        }

        .section h3 {
            font-size: 1.5rem;
            margin-bottom: 16px;
            color: #1f2937;
            font-weight: 600;
        }

        .section p {
            margin-bottom: 16px;
            line-height: 1.75;
            color: #4b5563;
            font-size: 1.125rem;
        }

        .mission {
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            padding: 48px;
            border-radius: 24px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-left: 6px solid #FF2D20;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .mission::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg, #FF2D20, #dc2626, #FF2D20);
            border-radius: 26px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mission:hover::before {
            opacity: 0.1;
        }

        .mission:hover {
            transform: translateY(-5px);
            box-shadow:
                0 25px 30px -5px rgba(0, 0, 0, 0.15),
                0 15px 15px -5px rgba(0, 0, 0, 0.08);
        }

        .community-links {
            background: linear-gradient(135deg, #ffffff 0%, #fafafa 100%);
            padding: 48px;
            border-radius: 24px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .community-links:hover {
            transform: translateY(-5px);
            box-shadow:
                0 25px 30px -5px rgba(0, 0, 0, 0.15),
                0 15px 15px -5px rgba(0, 0, 0, 0.08);
        }

        .community-links a {
            display: inline-block;
            background: linear-gradient(135deg, #FF2D20 0%, #dc2626 100%);
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            border-radius: 12px;
            margin-right: 16px;
            margin-bottom: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 700;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(255, 45, 32, 0.2);
        }

        .community-links a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .community-links a:hover::before {
            left: 100%;
        }

        .community-links a:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255, 45, 32, 0.3);
        }

        .board-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 32px;
        }

        .board-member {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 40px;
            border-radius: 20px;
            box-shadow:
                0 10px 15px -3px rgba(0, 0, 0, 0.1),
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .board-member::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #FF2D20, #dc2626, #FF2D20);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .board-member:hover::before {
            transform: scaleX(1);
        }

        .board-member:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04),
                0 0 0 1px rgba(255, 45, 32, 0.1);
        }

        .board-member:nth-child(even):hover {
            transform: translateY(-8px) scale(1.02) rotate(1deg);
        }

        .board-member:nth-child(odd):hover {
            transform: translateY(-8px) scale(1.02) rotate(-1deg);
        }

        .board-member h3 {
            color: #111827;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .board-member .title {
            color: #FF2D20;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 8px;
        }

        .board-member .company {
            color: #6b7280;
            font-size: 1rem;
            font-weight: 500;
        }

        .coming-soon {
            background: #f3f4f6;
            padding: 48px;
            border-radius: 16px;
            text-align: center;
            border: 2px dashed #d1d5db;
        }

        .footer {
            background: #111827;
            color: #9ca3af;
            padding: 48px 0;
            text-align: center;
            margin-top: 80px;
        }

        .footer-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            border-radius: 12px;
            overflow: hidden;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .footer-logo:hover {
            opacity: 1;
        }

        .footer-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .footer a {
            color: #FF2D20;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            color: #dc2626;
        }

        .contact-form {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 48px;
            border-radius: 24px;
            box-shadow:
                0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin-top: 32px;
            position: relative;
            overflow: hidden;
        }

        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #FF2D20, #dc2626, #b91c1c, #dc2626, #FF2D20);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 200% 0; }
            50% { background-position: -200% 0; }
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #111827;
            font-weight: 600;
            font-size: 1rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 16px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s;
            background: #fff;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #FF2D20;
            box-shadow:
                0 0 0 3px rgba(255, 45, 32, 0.1),
                0 4px 8px rgba(255, 45, 32, 0.15);
            transform: translateY(-2px);
        }

        .contact-form button {
            background: linear-gradient(135deg, #FF2D20 0%, #dc2626 100%);
            color: white;
            padding: 18px 40px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(255, 45, 32, 0.2);
        }

        .contact-form button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .contact-form button:hover::before {
            left: 100%;
        }

        .contact-form button:hover {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 8px 25px rgba(255, 45, 32, 0.3);
        }

        .success-message {
            background: #ecfdf5;
            border: 2px solid #10b981;
            color: #047857;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .error-message {
            background: #fef2f2;
            border: 2px solid #ef4444;
            color: #b91c1c;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .error-message ul {
            margin: 0;
            padding-left: 24px;
        }

        /* Skip navigation for keyboard users */
        .skip-nav {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #FF2D20;
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
            font-weight: 600;
        }

        .skip-nav:focus {
            top: 6px;
        }

        /* Focus indicators for better keyboard navigation */
        a:focus, button:focus, input:focus, textarea:focus, select:focus {
            outline: 3px solid #FF2D20;
            outline-offset: 2px;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .header {
                background: #000000;
            }
            
            .section h2 {
                background: #000000;
                -webkit-background-clip: unset;
                -webkit-text-fill-color: unset;
                background-clip: unset;
                color: #000000;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Screen reader only content */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        .sr-only:focus {
            position: static;
            width: auto;
            height: auto;
            padding: inherit;
            margin: inherit;
            overflow: visible;
            clip: auto;
            white-space: normal;
        }

        /* Optional field indicator */
        .optional {
            color: #6b7280;
            font-weight: 400;
        }

        @media (max-width: 768px) {
            .main-heading {
                max-width: 90%;
                margin-bottom: 30px;
            }

            .container {
                padding: 0 16px;
            }

            .board-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .mission, .community-links, .contact-form {
                padding: 24px;
            }

            .content {
                padding: 48px 0;
            }

            .section {
                margin-bottom: 48px;
            }
        }
    </style>
</head>
<body>
    <a href="#main-content" class="skip-nav">Hoppa till huvudinnehåll</a>
    <header class="header" role="banner">
        <div class="container">
            <h1 class="main-heading">
                <img src="/banner-1500x500.jpeg" alt="Swedish Laravel Association - Laravel Sweden">
            </h1>
            <p class="subtitle">Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel</p>
        </div>
    </header>

    <main class="content" role="main" id="main-content">
        <div class="container">
            <section class="section" aria-labelledby="about-heading">
                <div class="mission">
                    <h2 id="about-heading">Om föreningen</h2>
                    <p><strong>Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel. Detta gör vi genom att anordna möten, konferenser, webbplatser och andra aktiviteter på internet.</strong></p>
                    <p lang="en"><em>The association's purpose is to spread knowledge about the PHP framework Laravel. We do this by organizing meetings, conferences, websites and other activities on the internet.</em></p>
                </div>
            </section>

            <section class="section" aria-labelledby="community-heading">
                <h2 id="community-heading">Community</h2>
                <div class="community-links">
                    <p>Gå med i vår community och håll dig uppdaterad med Laravel-utvecklingen i Sverige.</p>
                    <a href="https://bit.ly/laravelse-slack" target="_blank" rel="noopener noreferrer" aria-label="Gå med i Laravel Sweden Slack kanal (öppnar i nytt fönster)">💬 Laravel Sweden Slack</a>
                    <a href="https://www.linkedin.com/company/swedish-laravel-association/" target="_blank" rel="noopener noreferrer" aria-label="Besök Swedish Laravel Association på LinkedIn (öppnar i nytt fönster)">💼 LinkedIn</a>
                    <a href="https://x.com/laravelsweden" target="_blank" rel="noopener noreferrer" aria-label="Följ Laravel Sweden på Twitter/X (öppnar i nytt fönster)">🐦 Twitter/X</a>
                </div>
            </section>

            <section class="section" aria-labelledby="events-heading">
                <h2 id="events-heading">Kommande aktiviteter</h2>
                <div class="community-links">
                    <h3>📅 Laravel Meetup Norrköping</h3>
                    <p><strong>Datum:</strong> <time datetime="2024-09-25">25 september 2024</time></p>
                    <p><strong>Plats:</strong> Norrköping</p>
                    <p>Mer information kommer snart!</p>
                </div>
            </section>

            <section class="section" aria-labelledby="board-heading">
                <h2 id="board-heading">Styrelse</h2>
                <div class="board-grid" role="list" aria-label="Styrelsemedlemmar">
                    <div class="board-member" role="listitem">
                        <h3>Mikko Lauhakari</h3>
                        <div class="title" aria-label="Roll">Ordförande</div>
                        <div class="company" aria-label="Företag">Glesys AB</div>
                    </div>
                    <div class="board-member" role="listitem">
                        <h3>Tommie Lagerroos</h3>
                        <div class="title" aria-label="Roll">Styrelseledamot</div>
                        <div class="company" aria-label="Företag">Techlove</div>
                    </div>
                    <div class="board-member" role="listitem">
                        <h3>Isak Berglind</h3>
                        <div class="title" aria-label="Roll">Sekreterare</div>
                        <div class="company" aria-label="Företag">CampusBokhandel</div>
                    </div>
                    <div class="board-member" role="listitem">
                        <h3>Ola Ebbesson</h3>
                        <div class="title" aria-label="Roll">Styrelseledamot</div>
                        <div class="company" aria-label="Företag">Ceaser Dev</div>
                    </div>
                    <div class="board-member" role="listitem">
                        <h3>Martin Danielsson</h3>
                        <div class="title" aria-label="Roll">Kassör</div>
                        <div class="company" aria-label="Företag">ePark</div>
                    </div>
                    <div class="board-member" role="listitem">
                        <h3>Jonatan Alvarsson</h3>
                        <div class="title" aria-label="Roll">Revisor</div>
                        <div class="company" aria-label="Företag">JA Webb</div>
                    </div>
                    <div class="board-member" role="listitem">
                        <h3>Oliver Scase</h3>
                        <div class="title" aria-label="Roll">Suppleant</div>
                        <div class="company" aria-label="Företag">Techlove</div>
                    </div>
                </div>
            </section>

            <section class="section" aria-labelledby="members-heading">
                <h2 id="members-heading">Medlemmar & Partners</h2>
                <div class="coming-soon">
                    <h3>Kommer snart</h3>
                    <p>Vi arbetar på att visa våra medlemmar och partners här. Håll utkik!</p>
                    <p style="margin-top: 16px; font-size: 0.95rem;">
                        Känner du till ett företag i Sverige som använder Laravel?
                        <a href="https://forms.gle/6NPAM4EdPRqe2x9g9" target="_blank" rel="noopener noreferrer" style="color: #FF2D20; text-decoration: underline; font-weight: 600;" aria-label="Tipsa om Laravel företag i Sverige (öppnar Google formulär i nytt fönster)">Tipsa oss här →</a>
                    </p>
                </div>
            </section>

            <section class="section" aria-labelledby="contact-heading">
                <h2 id="contact-heading">Kontakta oss</h2>
                <div class="community-links">
                    <p>Har du frågor eller vill du engagera dig i föreningen? Hör av dig till oss!</p>
                    <p style="margin-bottom: 20px;">📧 <a href="mailto:hej@laravelsweden.org" aria-label="Skicka e-post till hej@laravelsweden.org">hej@laravelsweden.org</a></p>

                    @if(session('success'))
                        <div class="success-message" role="alert" aria-live="polite">
                            <p>✅ {{ session('success') }}</p>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="error-message" role="alert" aria-live="polite">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>❌ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="error-message" role="alert" aria-live="polite">
                            <p>❌ {{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('contact') }}" method="POST" class="contact-form" aria-labelledby="contact-form-heading">
                        @csrf
                        <div class="form-group">
                            <label for="name">Namn <span aria-label="Obligatoriskt fält">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="email">E-post <span aria-label="Obligatoriskt fält">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required aria-required="true">
                        </div>

                        <div class="form-group">
                            <label for="company">Företag <span class="optional">(valfritt)</span></label>
                            <input type="text" id="company" name="company" value="{{ old('company') }}">
                        </div>

                        <div class="form-group">
                            <label for="message">Meddelande <span aria-label="Obligatoriskt fält">*</span></label>
                            <textarea id="message" name="message" rows="5" required aria-required="true">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" aria-describedby="submit-help">Skicka meddelande</button>
                        <div id="submit-help" class="sr-only">Skickar ditt meddelande till Swedish Laravel Association</div>
                    </form>
                </div>
            </section>
        </div>
    </main>

    <footer class="footer" role="contentinfo">
        <div class="container">
            <div class="footer-logo">
                <img src="/square-logo.jpg" alt="Laravel Sweden Logo">
            </div>
            <p>Swedish Laravel Association - Laravel Sweden</p>
        </div>
    </footer>
</body>
</html>