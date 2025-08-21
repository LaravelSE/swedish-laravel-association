<div>
    <header class="header" role="banner">
        <div class="header-content">
            <div class="logo">
                <img src="{{ asset('square-logo.jpg') }}" alt="Laravel Sweden">
                <span class="logo-text">Laravel Sweden</span>
            </div>
            
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
                <a href="#community">Community</a>
                <a href="#events">Events</a>
                <a href="#board">Board</a>
                <a href="#contact">Contact</a>
            </nav>
        </div>
        
        <!-- Mobile navigation -->
        <nav class="mobile-nav" style="display: {{ $mobileMenuOpen ? 'block' : 'none' }}">
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
