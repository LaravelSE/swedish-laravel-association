<div>
    <footer class="footer" role="contentinfo">
        <div class="footer-content">
            <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" class="footer-logo" width="48" height="48" loading="lazy">
            <p>Swedish Laravel Association - Laravel Sweden</p>
            <p>Spreading knowledge about Laravel across Sweden</p>
            <p><a href="mailto:hello@laravelsweden.org">hello@laravelsweden.org</a></p>
        </div>
    </footer>

    <style>
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
            border-radius: 8px;
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
    </style>
</div>
