@props(['simple' => false, 'backUrl' => '/', 'backText' => '← Kembali ke Beranda'])

@php
    $isSimple = filter_var($simple, FILTER_VALIDATE_BOOLEAN);
@endphp

<nav id="public-navbar" class="fixed top-0 left-0 right-0 z-[60] transition-all duration-500 py-6">
    <div class="container mx-auto px-4 md:px-6">
        <div id="navbar-container" class="flex items-center justify-between bg-black/40 backdrop-blur-xl border border-white/10 rounded-2xl px-6 py-3 transition-all duration-500">
            
            <!-- Logo -->
            <a href="/" class="relative group z-[60] flex items-center gap-2 text-2xl font-extrabold tracking-tighter text-green-400">
                <div class="absolute -inset-2 bg-green-500/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <span class="relative">BOA<span class="text-white">FUTSAL</span></span>
            </a>

            @if($isSimple)
                <!-- Simple Mode Nav -->
                <div class="flex items-center gap-6">
                    <a href="{{ $backUrl }}" class="hidden sm:block text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">
                        {{ $backText }}
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="hidden sm:block text-sm font-bold text-gray-300 hover:text-green-400 transition-colors">Dashboard</a>
                        <div class="h-4 w-px bg-white/20 hidden sm:block"></div>
                        <span class="text-sm font-bold text-gray-300 hidden sm:block">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl font-bold text-xs sm:text-sm hover:bg-red-500 hover:text-white transition-all duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 bg-green-500 text-black rounded-xl font-bold text-xs sm:text-sm hover:bg-green-400 transition-all duration-300">Login</a>
                    @endauth
                </div>
            @else
                <!-- Full Desktop Menu -->
                <div class="hidden md:flex items-center gap-1 bg-white/5 rounded-xl p-1 border border-white/5">
                    <a href="#home" class="nav-link relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors rounded-lg overflow-hidden group">
                        <span class="relative z-10">Home</span>
                        <div class="absolute inset-0 bg-green-500/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                    <a href="#facilities" class="nav-link relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors rounded-lg overflow-hidden group">
                        <span class="relative z-10">Fasilitas</span>
                        <div class="absolute inset-0 bg-green-500/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                    <a href="#fields" class="nav-link relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors rounded-lg overflow-hidden group">
                        <span class="relative z-10">Lapangan</span>
                        <div class="absolute inset-0 bg-green-500/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                    <a href="#contact" class="nav-link relative px-4 py-2 text-sm font-medium text-gray-300 hover:text-white transition-colors rounded-lg overflow-hidden group">
                        <span class="relative z-10">Contact Us</span>
                        <div class="absolute inset-0 bg-green-500/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                    </a>
                </div>

                <!-- Desktop CTA -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-sm font-bold text-gray-300 hover:text-green-400 transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-5 py-2.5 bg-red-500/10 border border-red-500/20 text-red-400 rounded-xl font-bold text-sm hover:bg-red-500 hover:text-white transition-all duration-300">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="group relative px-6 py-2.5 bg-green-500 text-black rounded-xl font-bold text-sm overflow-hidden shadow-[0_0_20px_rgba(34,197,94,0.3)] hover:shadow-[0_0_30px_rgba(34,197,94,0.5)] transition-all duration-300">
                            <span class="relative z-10 flex items-center gap-2">
                                Login
                                <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </span>
                            <div class="absolute inset-0 bg-green-400 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-toggle" class="md:hidden relative z-[60] w-10 h-10 flex flex-col items-center justify-center gap-1.5 text-green-400 focus:outline-none bg-white/5 border border-white/10 rounded-xl hover:bg-white/10 transition-colors">
                    <span class="line-1 w-5 h-0.5 bg-current rounded-full transition-all duration-300"></span>
                    <span class="line-2 w-5 h-0.5 bg-current rounded-full transition-all duration-300"></span>
                    <span class="line-3 w-5 h-0.5 bg-current rounded-full transition-all duration-300"></span>
                </button>
            @endif
        </div>
    </div>
</nav>

@if(!$isSimple)
    <!-- Mobile Menu Fullscreen Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 z-50 bg-black/95 backdrop-blur-3xl opacity-0 pointer-events-none transition-opacity duration-500 md:hidden flex flex-col justify-center items-center">
        <div class="flex flex-col items-center space-y-8 w-full px-6">
            <a href="#home" class="mobile-link text-3xl font-extrabold text-gray-400 hover:text-white hover:scale-110 transition-all duration-300 translate-y-10 opacity-0">Home</a>
            <a href="#facilities" class="mobile-link text-3xl font-extrabold text-gray-400 hover:text-white hover:scale-110 transition-all duration-300 translate-y-10 opacity-0">Fasilitas</a>
            <a href="#fields" class="mobile-link text-3xl font-extrabold text-gray-400 hover:text-white hover:scale-110 transition-all duration-300 translate-y-10 opacity-0">Lapangan</a>
            <a href="#contact" class="mobile-link text-3xl font-extrabold text-gray-400 hover:text-white hover:scale-110 transition-all duration-300 translate-y-10 opacity-0">Contact Us</a>
            
            <div class="w-24 h-px bg-white/10 my-4 mobile-link translate-y-10 opacity-0 transition-all duration-300 delay-200"></div>
            
            @auth
                <a href="{{ route('dashboard') }}" class="mobile-link text-xl font-bold text-green-400 hover:text-green-300 transition-colors translate-y-10 opacity-0">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="mobile-link w-full max-w-xs px-6 py-4 bg-green-500 text-black text-center rounded-2xl font-bold text-lg shadow-[0_0_30px_rgba(34,197,94,0.3)] translate-y-10 opacity-0 hover:bg-green-400 transition-colors">Login Now</a>
            @endauth
        </div>
    </div>

    <!-- Navbar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navbar = document.getElementById('public-navbar');
            const navContainer = document.getElementById('navbar-container');
            const mobileToggle = document.getElementById('mobile-menu-toggle');
            const mobileOverlay = document.getElementById('mobile-menu-overlay');
            const mobileLinks = document.querySelectorAll('.mobile-link');
            
            let isMenuOpen = false;

            // Scroll Effect
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.replace('py-6', 'py-3');
                    navContainer.classList.add('shadow-[0_4px_30px_rgba(0,0,0,0.5)]');
                    navContainer.classList.replace('bg-black/40', 'bg-black/70');
                } else {
                    navbar.classList.replace('py-3', 'py-6');
                    navContainer.classList.remove('shadow-[0_4px_30px_rgba(0,0,0,0.5)]');
                    navContainer.classList.replace('bg-black/70', 'bg-black/40');
                }
            });

            // Mobile Menu Toggle
            function toggleMenu() {
                isMenuOpen = !isMenuOpen;
                
                // Animate hamburger icon
                const line1 = mobileToggle.querySelector('.line-1');
                const line2 = mobileToggle.querySelector('.line-2');
                const line3 = mobileToggle.querySelector('.line-3');

                if (isMenuOpen) {
                    line1.classList.add('translate-y-2', 'rotate-45');
                    line2.classList.add('opacity-0');
                    line3.classList.add('-translate-y-2', '-rotate-45');
                    
                    mobileOverlay.classList.remove('opacity-0', 'pointer-events-none');
                    document.body.style.overflow = 'hidden'; // Prevent scrolling
                    
                    // Stagger animate links
                    mobileLinks.forEach((link, index) => {
                        setTimeout(() => {
                            link.classList.remove('translate-y-10', 'opacity-0');
                        }, 100 + (index * 50));
                    });
                } else {
                    line1.classList.remove('translate-y-2', 'rotate-45');
                    line2.classList.remove('opacity-0');
                    line3.classList.remove('-translate-y-2', '-rotate-45');
                    
                    mobileOverlay.classList.add('opacity-0', 'pointer-events-none');
                    document.body.style.overflow = '';
                    
                    // Reset links
                    mobileLinks.forEach(link => {
                        link.classList.add('translate-y-10', 'opacity-0');
                    });
                }
            }

            if(mobileToggle) {
                mobileToggle.addEventListener('click', toggleMenu);
            }

            // Close menu when clicking links
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if(isMenuOpen) toggleMenu();
                });
            });

            // Close menu when clicking outside (on the overlay)
            if(mobileOverlay) {
                mobileOverlay.addEventListener('click', (e) => {
                    if (e.target === mobileOverlay && isMenuOpen) {
                        toggleMenu();
                    }
                });
            }

            // Smooth Scroll for Anchor Links with Offset
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        
                        // Calculate offset (navbar height + some padding)
                        const headerOffset = 100; 
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                        
                        // Update URL silently
                        history.pushState(null, null, targetId);
                    }
                });
            });
        });
    </script>
@else
    <!-- Simple Nav Scroll Effect -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navbar = document.getElementById('public-navbar');
            const navContainer = document.getElementById('navbar-container');
            
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    if(navbar) navbar.classList.replace('py-6', 'py-3');
                    if(navContainer) {
                        navContainer.classList.add('shadow-[0_4px_30px_rgba(0,0,0,0.5)]');
                        navContainer.classList.replace('bg-black/40', 'bg-black/70');
                    }
                } else {
                    if(navbar) navbar.classList.replace('py-3', 'py-6');
                    if(navContainer) {
                        navContainer.classList.remove('shadow-[0_4px_30px_rgba(0,0,0,0.5)]');
                        navContainer.classList.replace('bg-black/70', 'bg-black/40');
                    }
                }
            });
        });
    </script>
@endif
