<div>
    <header class="header" role="banner">
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden">
                <span class="logo-text">Laravel Sweden</span>
            </div>
            
            <!-- Mobile menu button -->
            <button class="mobile-menu-button" wire:click="toggleMobileMenu" aria-label="Toggle menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Desktop navigation -->
            <nav class="nav-links desktop-nav">
                <a href="#community">Community</a>
                <a href="#events">Events</a>
                <a href="#board">Board</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
        
        <!-- Mobile navigation -->
        <nav class="mobile-nav" x-data x-show="$wire.mobileMenuOpen" x-transition.opacity x-cloak>
            <div class="mobile-nav-container">
                <a href="#community" wire:click="toggleMobileMenu">Community</a>
                <a href="#events" wire:click="toggleMobileMenu">Events</a>
                <a href="#board" wire:click="toggleMobileMenu">Board</a>
                <a href="#contact" wire:click="toggleMobileMenu">Contact</a>
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
            color: var(--gray-800);
            cursor: pointer;
            padding: 0.5rem;
        }
        
        .mobile-nav {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }
        
        .mobile-nav-container {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }
        
        .mobile-nav a {
            padding: 0.75rem 1rem;
            color: var(--gray-800);
            text-decoration: none;
            border-bottom: 1px solid var(--gray-200);
        }
        
        .mobile-nav a:last-child {
            border-bottom: none;
        }
        
        [x-cloak] {
            display: none !important;
        }
        
        @media (max-width: 768px) {
            .desktop-nav {
                display: none;
            }
            
            .mobile-menu-button {
                display: block;
            }
            
            .mobile-nav {
                display: block;
            }
        }
    </style>
</div>
