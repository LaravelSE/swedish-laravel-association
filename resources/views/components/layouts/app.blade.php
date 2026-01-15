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

    @livewireStyles

    <style media="print" onload="this.media='all'">
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
            top: -50px;
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

        /* Card */
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

    {{ $slot }}

    @livewireScripts
</body>
</html>
