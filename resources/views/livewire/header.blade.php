<div>
    <header class="header" role="banner">
        <div class="header-content">
            <a href="{{ route('home') }}" class="logo logo-link">
                <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden" class="logo-image">
                <span class="logo-text">Laravel Sweden</span>
            </a>

            <!-- Mobile menu button -->
            <button class="mobile-menu-button" wire:click="toggleMobileMenu" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <!-- Desktop navigation -->
            <nav class="nav-links desktop-nav">
                <a href="{{ route('home') }}#community">Community</a>
                <a href="{{ route('home') }}#events">Events</a>
                <a href="{{ route('home') }}#board">Board</a>
                <a href="{{ route('home') }}#contact">Contact</a>
                @auth
                    <a href="{{ route('member') }}">Member</a>
                @else
                    <a href="{{ route('register') }}">Register</a>
                @endauth
            </nav>
        </div>

        <!-- Mobile navigation -->
        <nav class="mobile-nav" style="display: {{ $mobileMenuOpen ? 'block' : 'none' }}">
            <div class="mobile-nav-container">
                <a href="{{ route('home') }}#community" wire:click="toggleMobileMenu">Community</a>
                <a href="{{ route('home') }}#events" wire:click="toggleMobileMenu">Events</a>
                <a href="{{ route('home') }}#board" wire:click="toggleMobileMenu">Board</a>
                <a href="{{ route('home') }}#contact" wire:click="toggleMobileMenu">Contact</a>
                @auth
                    <a href="{{ route('member') }}" wire:click="toggleMobileMenu">Member</a>
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
            display: none; /* Hidden by default */
            background: none;
            border: none;
            color: var(--gray-800);
            cursor: pointer;
            padding: 0.5rem;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
        }

        .mobile-menu-button svg {
            width: 24px;
            height: 24px;
        }

        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            box-shadow: var(--shadow-md);
            z-index: 50;
        }

        .mobile-nav-container {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        .mobile-nav a {
            color: var(--gray-700);
            text-decoration: none;
            padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .mobile-nav a:last-child {
            border-bottom: none;
        }

        .mobile-nav a:hover {
            background: var(--gray-100);
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-link {
            text-decoration: none;
        }

        .logo-image {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }

        .logo-text {
            font-weight: 600;
            font-size: 1.25rem;
        }

        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }

            .mobile-menu-button {
                display: flex; /* Only show on mobile */
            }
        }
    </style>
</div>
