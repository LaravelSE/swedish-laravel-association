<div>
    <footer class="footer" role="contentinfo">
        <div class="footer-content">
            <div class="footer-top">
                <div class="footer-brand">
                    <div class="footer-logo-row">
                        <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" class="footer-logo" width="32" height="32" loading="lazy">
                        <span class="footer-logo-text">Laravel Sweden</span>
                    </div>
                    <p class="footer-tagline">Spreading knowledge about Laravel across Sweden through meetups, conferences, and community.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-col">
                        <h4>Navigate</h4>
                        <a href="/#events">Events</a>
                        <a href="/#board">Board</a>
                        <a href="/#community">Community</a>
                        <a href="/#contact">Contact</a>
                    </div>
                    <div class="footer-col">
                        <h4>Connect</h4>
                        <a href="https://bit.ly/laravel-sweden-slack" target="_blank" rel="noopener noreferrer">Slack</a>
                        <a href="https://www.linkedin.com/company/swedish-laravel-association/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        <a href="https://x.com/laravelsweden" target="_blank" rel="noopener noreferrer">Twitter/X</a>
                        <a href="mailto:hello@laravelsweden.org">Email</a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>Swedish Laravel Association &middot; hello@laravelsweden.org</p>
            </div>
        </div>
    </footer>

    <style>
        .footer {
            background: var(--gray-950);
            color: var(--gray-400);
            padding: var(--spacing-16) 0 var(--spacing-8);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
        }

        .footer-top {
            display: flex;
            justify-content: space-between;
            gap: var(--spacing-12);
            padding-bottom: var(--spacing-10);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-brand {
            max-width: 320px;
        }

        .footer-logo-row {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
            margin-bottom: var(--spacing-4);
        }

        .footer-logo {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            opacity: 0.9;
        }

        .footer-logo-text {
            font-weight: 700;
            font-size: 1rem;
            color: white;
            letter-spacing: -0.02em;
        }

        .footer-tagline {
            font-size: 0.875rem;
            line-height: 1.7;
            color: var(--gray-500);
        }

        .footer-links {
            display: flex;
            gap: var(--spacing-16);
        }

        .footer-col {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-3);
        }

        .footer-col h4 {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--gray-500);
            margin-bottom: var(--spacing-1);
        }

        .footer-col a {
            color: var(--gray-400);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color var(--transition-fast);
        }

        .footer-col a:hover {
            color: white;
        }

        .footer-bottom {
            padding-top: var(--spacing-8);
            text-align: center;
        }

        .footer-bottom p {
            font-size: 0.8125rem;
            color: var(--gray-600);
        }

        @media (max-width: 640px) {
            .footer-top {
                flex-direction: column;
                gap: var(--spacing-8);
            }

            .footer-links {
                gap: var(--spacing-10);
            }
        }
    </style>
</div>
