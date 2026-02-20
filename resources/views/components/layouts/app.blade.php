@props(['title' => 'Swedish Laravel Association - Laravel Sweden'])

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#FF2D20">
    <title>{{ $title }}</title>
    <meta name="description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://laravelsweden.org/">
    <meta property="og:title" content="Swedish Laravel Association - Laravel Sweden">
    <meta property="og:description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    <meta property="og:image" content="{{ asset('banner-1500x500.jpeg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://laravelsweden.org/">
    <meta property="twitter:title" content="Swedish Laravel Association - Laravel Sweden">
    <meta property="twitter:description" content="Föreningens syfte är att sprida kännedom om PHP-ramverket Laravel genom möten, konferenser och andra aktiviteter.">
    <meta property="twitter:image" content="{{ asset('banner-1500x500.jpeg') }}">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @livewireStyles

    <style media="print" onload="this.media='all'">
        :root {
            --laravel-red: #FF2D20;
            --laravel-red-dark: #E5231A;
            --laravel-red-light: rgba(255, 45, 32, 0.08);
            --gray-50: #FAFAFA;
            --gray-100: #F4F4F5;
            --gray-200: #E4E4E7;
            --gray-300: #D4D4D8;
            --gray-400: #A1A1AA;
            --gray-500: #71717A;
            --gray-600: #52525B;
            --gray-700: #3F3F46;
            --gray-800: #27272A;
            --gray-900: #18181B;
            --gray-950: #09090B;
            --spacing-1: 0.25rem;
            --spacing-2: 0.5rem;
            --spacing-3: 0.75rem;
            --spacing-4: 1rem;
            --spacing-5: 1.25rem;
            --spacing-6: 1.5rem;
            --spacing-8: 2rem;
            --spacing-10: 2.5rem;
            --spacing-12: 3rem;
            --spacing-16: 4rem;
            --spacing-20: 5rem;
            --spacing-24: 6rem;
            --spacing-32: 8rem;
            --border-radius-sm: 0.375rem;
            --border-radius: 0.5rem;
            --border-radius-lg: 0.75rem;
            --border-radius-xl: 1rem;
            --border-radius-2xl: 1.25rem;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.04);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.06), 0 1px 2px -1px rgb(0 0 0 / 0.06);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.07), 0 2px 4px -2px rgb(0 0 0 / 0.05);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.08), 0 4px 6px -4px rgb(0 0 0 / 0.04);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.08), 0 8px 10px -6px rgb(0 0 0 / 0.04);
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: var(--gray-700);
            background: white;
            font-size: 16px;
            letter-spacing: -0.011em;
        }

        /* Skip navigation */
        .skip-nav {
            position: absolute;
            top: -50px;
            left: var(--spacing-4);
            background: var(--gray-900);
            color: white;
            padding: var(--spacing-2) var(--spacing-4);
            text-decoration: none;
            border-radius: var(--border-radius);
            z-index: 1000;
            font-weight: 600;
            transition: top var(--transition-base);
        }

        .skip-nav:focus {
            top: var(--spacing-4);
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border-bottom: 1px solid var(--gray-200);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-6);
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--spacing-3);
        }

        .logo img {
            width: 36px;
            height: 36px;
            border-radius: 8px;
        }

        .logo-text {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--gray-900);
            letter-spacing: -0.025em;
        }

        .nav-links {
            display: flex;
            gap: var(--spacing-1);
        }

        .nav-links a {
            color: var(--gray-600);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            padding: var(--spacing-2) var(--spacing-3);
            border-radius: var(--border-radius);
            transition: color var(--transition-fast), background var(--transition-fast);
        }

        .nav-links a:hover {
            color: var(--gray-900);
            background: var(--gray-100);
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: var(--spacing-20) var(--spacing-6);
        }

        .section {
            margin-bottom: var(--spacing-32);
        }

        .section-header {
            text-align: center;
            margin-bottom: var(--spacing-12);
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 800;
            color: var(--gray-950);
            margin-bottom: var(--spacing-4);
            letter-spacing: -0.035em;
            line-height: 1.15;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--gray-500);
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        /* Card */
        .card {
            background: white;
            border-radius: var(--border-radius-2xl);
            padding: var(--spacing-8);
            border: 1px solid var(--gray-200);
            transition: border-color var(--transition-base), box-shadow var(--transition-base);
        }

        .card:hover {
            border-color: var(--gray-300);
            box-shadow: var(--shadow-lg);
        }

        /* Card grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--spacing-6);
        }

        .card-icon {
            font-size: 1.75rem;
            margin-bottom: var(--spacing-4);
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--gray-100);
        }

        .card h3 {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: var(--spacing-2);
            letter-spacing: -0.02em;
        }

        .card p {
            color: var(--gray-500);
            line-height: 1.7;
            font-size: 0.9375rem;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-2);
            padding: 0.625rem 1.25rem;
            border-radius: var(--border-radius-lg);
            font-weight: 600;
            text-decoration: none;
            transition: all var(--transition-fast);
            cursor: pointer;
            border: none;
            font-size: 0.875rem;
            letter-spacing: -0.01em;
            line-height: 1.5;
        }

        .btn-primary {
            background: var(--gray-900);
            color: white;
        }

        .btn-primary:hover {
            background: var(--gray-800);
        }

        .btn-secondary {
            background: white;
            color: var(--gray-700);
            border: 1px solid var(--gray-300);
        }

        .btn-secondary:hover {
            background: var(--gray-50);
            border-color: var(--gray-400);
        }

        .btn-accent {
            background: var(--laravel-red);
            color: white;
        }

        .btn-accent:hover {
            background: var(--laravel-red-dark);
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            html {
                scroll-behavior: auto;
            }
        }

        @media (max-width: 768px) {
            .card-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <a href="#main-content" class="skip-nav">Hoppa till huvudinnehåll</a>

    {{ $slot }}

    @livewireScripts
</body>
</html>
