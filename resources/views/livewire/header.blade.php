<div>
    <header class="header" role="banner">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo logo-link">
                <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" class="logo-image" width="36" height="36" fetchpriority="high">
                <span class="logo-text">laravel<span class="logo-accent">_sweden</span></span>
            </a>

            <!-- Mobile menu button -->
            <button class="mobile-menu-button" wire:click="toggleMobileMenu" aria-label="Toggle menu">
                @if($mobileMenuOpen)
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="8" x2="20" y2="8"></line>
                        <line x1="4" y1="16" x2="20" y2="16"></line>
                    </svg>
                @endif
            </button>

            <!-- Desktop navigation -->
            <nav class="nav-links desktop-nav">
                <a href="{{ route('home') }}#community" class="nav-item">./community<span class="nav-cursor">|</span></a>
                <a href="{{ route('home') }}#events" class="nav-item">./events<span class="nav-cursor">|</span></a>
                <a href="{{ route('companies') }}" class="nav-item">./companies<span class="nav-cursor">|</span></a>
                <a href="{{ route('home') }}#board" class="nav-item">./board<span class="nav-cursor">|</span></a>
                <a href="{{ route('home') }}#contact" class="nav-item">./contact<span class="nav-cursor">|</span></a>
                @auth
                    <a href="{{ route('member') }}" class="nav-item">./member<span class="nav-cursor">|</span></a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-item">./admin<span class="nav-cursor">|</span></a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="nav-register">$ register --now</a>
                @endauth
            </nav>
        </div>

        <!-- Mobile navigation -->
        <nav class="mobile-nav" style="display: {{ $mobileMenuOpen ? 'block' : 'none' }}">
            <div class="mobile-nav-container">
                <a href="{{ route('home') }}#community" wire:click="toggleMobileMenu">./community</a>
                <a href="{{ route('home') }}#events" wire:click="toggleMobileMenu">./events</a>
                <a href="{{ route('companies') }}" wire:click="toggleMobileMenu">./companies</a>
                <a href="{{ route('home') }}#board" wire:click="toggleMobileMenu">./board</a>
                <a href="{{ route('home') }}#contact" wire:click="toggleMobileMenu">./contact</a>
                @auth
                    <a href="{{ route('member') }}" wire:click="toggleMobileMenu">./member</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" wire:click="toggleMobileMenu">./admin</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" wire:click="toggleMobileMenu" class="mobile-nav-register">$ register --now</a>
                @endauth
            </div>
        </nav>
    </header>

    <style>
        .header {
            position: relative;
        }

        .logo-accent {
            color: var(--tm-yellow);
        }

        .nav-item {
            position: relative;
        }

        .nav-cursor {
            display: none;
            animation: blink 1s step-end infinite;
            color: var(--tm-yellow);
            font-weight: 700;
            margin-left: 1px;
        }

        .nav-item:hover .nav-cursor,
        .nav-item:focus .nav-cursor {
            display: inline;
        }

        .mobile-menu-button {
            display: none;
            background: none;
            border: 1px solid var(--tm-border);
            color: var(--tm-muted);
            cursor: pointer;
            padding: 0.5rem;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            transition: color var(--transition-fast), border-color var(--transition-fast);
        }

        .mobile-menu-button:hover {
            color: var(--tm-text);
            border-color: var(--tm-muted);
        }

        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(13, 27, 42, 0.98);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--tm-border);
            z-index: 50;
        }

        .mobile-nav-container {
            display: flex;
            flex-direction: column;
            padding: var(--spacing-2) var(--spacing-4);
        }

        .mobile-nav a {
            color: var(--tm-muted);
            text-decoration: none;
            padding: 0.75rem 0.75rem;
            font-size: 0.875rem;
            font-family: 'JetBrains Mono', monospace;
            transition: color var(--transition-fast);
        }

        .mobile-nav a:hover {
            color: var(--tm-text);
        }

        .logo-link {
            text-decoration: none;
        }

        .logo-image {
            width: 36px;
            height: 36px;
            border-radius: 4px;
        }

        .nav-register {
            background: transparent !important;
            color: var(--tm-yellow) !important;
            border: 1px solid var(--tm-yellow) !important;
            padding: 0.375rem 0.875rem !important;
            font-size: 0.75rem !important;
            font-family: 'JetBrains Mono', monospace !important;
            position: relative;
            overflow: hidden;
        }

        .nav-register::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--tm-yellow);
            transform: translateX(-100%);
            transition: transform var(--transition-base);
        }

        .nav-register:hover::before {
            transform: translateX(0);
        }

        .nav-register:hover {
            color: var(--tm-bg) !important;
        }

        .mobile-nav-register {
            color: var(--tm-yellow) !important;
            font-weight: 500 !important;
        }

        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }

            .mobile-menu-button {
                display: flex;
            }
        }
    </style>
</div>
