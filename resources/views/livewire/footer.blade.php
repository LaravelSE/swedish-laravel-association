<div>
    <footer class="footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="footer-logo-row">
                        <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" class="footer-logo" width="32" height="32" loading="lazy">
                        <span class="footer-logo-text">laravel<span class="footer-logo-accent">_sweden</span></span>
                    </div>
                    <p class="footer-tagline"># Spreading knowledge about Laravel across Sweden through meetups, conferences, and community.</p>
                    <div class="footer-process-line" aria-label="Server process: php artisan schedule:run, status: running">
                        <span class="footer-ps1">~</span>
                        <span class="footer-cmd">php artisan schedule:run</span>
                        <span class="footer-status">✓ running</span>
                    </div>
                </div>
                <div class="footer-links">
                    <div class="footer-col">
                        <h4>// navigate</h4>
                        <a href="/#events">./events</a>
                        <a href="/#board">./board</a>
                        <a href="/#community">./community</a>
                        <a href="/#contact">./contact</a>
                    </div>
                    <div class="footer-col">
                        <h4>// connect</h4>
                        <a href="https://bit.ly/laravel-sweden-slack" target="_blank" rel="noopener noreferrer">./slack</a>
                        <a href="https://www.linkedin.com/company/swedish-laravel-association/" target="_blank" rel="noopener noreferrer">./linkedin</a>
                        <a href="https://x.com/laravelsweden" target="_blank" rel="noopener noreferrer">./twitter</a>
                        <a href="mailto:hello@laravelsweden.org" class="footer-email-link">hello@laravelsweden.org</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <span class="footer-bottom-prompt">$</span>
                <p>Swedish Laravel Association &middot; <a href="mailto:hello@laravelsweden.org" class="footer-email-link">hello@laravelsweden.org</a></p>
                <span class="footer-cursor" aria-hidden="true">|</span>
            </div>
        </div>
    </footer>

    <style>
        .footer {
            background: var(--tm-surface);
            color: var(--tm-muted);
            padding: 4rem 0 2rem;
            border-top: 1px solid var(--tm-border);
        }

        .footer-inner {
            max-width: var(--max-w, 1120px);
            margin: 0 auto;
            padding: 0 var(--px, 2rem);
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            gap: 4rem;
            padding-bottom: 2.5rem;
            border-bottom: 1px solid var(--tm-border);
        }

        .footer-brand {
            max-width: 320px;
        }

        .footer-logo-row {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 1rem;
        }

        .footer-logo {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            border: 1px solid var(--tm-border);
            opacity: 0.8;
        }

        .footer-logo-text {
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 1rem;
            color: var(--tm-text);
            letter-spacing: -0.02em;
        }

        .footer-logo-accent {
            color: var(--tm-yellow);
        }

        .footer-tagline {
            font-size: 0.8125rem;
            line-height: 1.7;
            color: var(--tm-muted);
            font-family: var(--font-mono);
            font-weight: 300;
            margin-bottom: 1.25rem;
        }

        .footer-process-line {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--font-mono);
            font-size: 0.75rem;
        }

        .footer-ps1 {
            color: var(--tm-muted);
        }

        .footer-cmd {
            color: var(--tm-text);
            font-weight: 300;
        }

        .footer-status {
            color: var(--tm-green);
            font-weight: 500;
        }

        .footer-links {
            display: flex;
            gap: 4rem;
        }

        .footer-col {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
        }

        .footer-col h4 {
            font-size: 0.6875rem;
            font-weight: 700;
            color: var(--tm-muted);
            margin-bottom: 0.25rem;
            font-family: var(--font-mono);
            letter-spacing: 0;
        }

        .footer-col a {
            color: var(--tm-muted);
            text-decoration: none;
            font-size: 0.8125rem;
            font-family: var(--font-mono);
            font-weight: 300;
            transition: color 0.15s;
        }

        .footer-col a:hover {
            color: var(--tm-text);
        }

        .footer-email-link {
            color: var(--tm-yellow) !important;
            text-decoration: none;
            font-family: var(--font-mono);
            font-size: 0.8125rem;
            transition: color 0.15s !important;
        }

        .footer-email-link:hover {
            color: var(--tm-text) !important;
        }

        .footer-bottom {
            padding-top: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .footer-bottom-prompt {
            color: var(--tm-muted);
            font-family: var(--font-mono);
            font-size: 0.8125rem;
            font-weight: 700;
        }

        .footer-bottom p {
            font-size: 0.8125rem;
            color: var(--tm-muted);
            font-family: var(--font-mono);
            font-weight: 300;
        }

        .footer-cursor {
            color: var(--tm-muted);
            font-family: var(--font-mono);
            font-size: 0.8125rem;
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }

        @media (max-width: 640px) {
            .footer-top {
                flex-direction: column;
                gap: 2rem;
            }

            .footer-links {
                gap: 3rem;
            }

            .footer-brand {
                max-width: 100%;
            }
        }
    </style>
</div>
