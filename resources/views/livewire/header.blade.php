<div>
    <header class="header" role="banner">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo logo-link">
                <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" class="logo-image" width="36" height="36" fetchpriority="high">
                <span class="logo-text">Laravel Sweden</span>
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
                <a href="{{ route('home') }}#community">Community</a>
                <a href="{{ route('home') }}#events">Events</a>
                <a href="{{ route('companies') }}">Companies</a>
                <a href="{{ route('home') }}#board">Board</a>
                <a href="{{ route('home') }}#contact">Contact</a>
                @auth
                    <a href="{{ route('member') }}">Member</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" class="nav-register">Register</a>
                @endauth
            </nav>
        </div>

        <!-- Mobile navigation -->
        <nav class="mobile-nav" style="display: {{ $mobileMenuOpen ? 'block' : 'none' }}">
            <div class="mobile-nav-container">
                <a href="{{ route('home') }}#community" wire:click="toggleMobileMenu">Community</a>
                <a href="{{ route('home') }}#events" wire:click="toggleMobileMenu">Events</a>
                <a href="{{ route('companies') }}" wire:click="toggleMobileMenu">Companies</a>
                <a href="{{ route('home') }}#board" wire:click="toggleMobileMenu">Board</a>
                <a href="{{ route('home') }}#contact" wire:click="toggleMobileMenu">Contact</a>
                @auth
                    <a href="{{ route('member') }}" wire:click="toggleMobileMenu">Member</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" wire:click="toggleMobileMenu">Admin</a>
                    @endif
                @else
                    <a href="{{ route('register') }}" wire:click="toggleMobileMenu">Register</a>
                @endauth
            </div>
        </nav>
    </header>

    <style>
        .header {
            position: relative;
        }

        .mobile-menu-button {
            display: none;
            background: none;
            border: none;
            color: var(--gray-600);
            cursor: pointer;
            padding: 0.5rem;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            border-radius: var(--border-radius);
            transition: color var(--transition-fast), background var(--transition-fast);
        }

        .mobile-menu-button:hover {
            color: var(--gray-900);
            background: var(--gray-100);
        }

        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--gray-200);
            z-index: 50;
        }

        .mobile-nav-container {
            display: flex;
            flex-direction: column;
            padding: var(--spacing-2) var(--spacing-4);
        }

        .mobile-nav a {
            color: var(--gray-700);
            text-decoration: none;
            padding: 0.75rem 0.75rem;
            font-size: 0.9375rem;
            font-weight: 500;
            border-radius: var(--border-radius);
            transition: background var(--transition-fast);
        }

        .mobile-nav a:hover {
            background: var(--gray-100);
        }

        .logo-link {
            text-decoration: none;
        }

        .logo-image {
            width: 36px;
            height: 36px;
            border-radius: 8px;
        }

        .nav-register {
            background: var(--gray-900) !important;
            color: white !important;
            padding: 0.375rem 0.875rem !important;
            border-radius: var(--border-radius) !important;
            font-size: 0.8125rem !important;
        }

        .nav-register:hover {
            background: var(--gray-800) !important;
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
