<!-- Modern Sticky Header -->
<header class="sticky top-0 z-50">
    <!-- Top Bar -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-2">
                <div class="flex items-center space-x-6">
                    <span class="text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        +1 234 567 890
                    </span>
                    <span class="text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        info@example.com
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="#" class="text-sm hover:text-blue-200 transition-colors duration-300">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-sm hover:text-blue-200 transition-colors duration-300">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-sm hover:text-blue-200 transition-colors duration-300">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="bg-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="" class="flex items-center space-x-2 group">
                    <img src="{{ $cmsSetting->logo ?? 'https://readymadeui.com/readymadeui.svg' }}"
                         alt="Logo"
                         class="h-10 w-auto group-hover:scale-105 transition-transform duration-300">
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <div class="relative group">
                        <a href="/" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 flex items-center space-x-1">
                            <span>Home</span>
                        </a>
                    </div>
                    <div class="relative group">
                        <a href="/about" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 flex items-center space-x-1">
                            <span>About</span>
                        </a>
                    </div>
                    <div class="relative group">
                        <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 flex items-center space-x-1">
                            <span>Services</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </a>
                        <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100 border border-gray-100">
                            <div class="py-2">
                                <a href="/services/web-development" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">Web Development</a>
                                <a href="/services/seo" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300">SEO</a>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <a href="/contact" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300 flex items-center space-x-1">
                            <span>Contact</span>
                        </a>
                    </div>
                </nav>

                <!-- CTA Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="#" class="px-4 py-2 text-blue-600 hover:text-blue-700 font-medium transition-colors duration-300">
                        Login
                    </a>
                    <a href="#" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                        Get Started
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-300"
                        id="mobile-menu-button"
                        aria-expanded="false"
                        aria-controls="mobile-menu">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="md:hidden hidden bg-white border-t" id="mobile-menu">
        <div class="container mx-auto px-4 py-2 space-y-1">
            @foreach($website_menus as $menu)
                <div class="py-2">
                    <button type="button"
                            class="w-full flex items-center justify-between text-gray-700 hover:text-blue-600 font-medium transition-colors duration-300"
                            onclick="toggleSubmenu(this)">
                        <span>{{ $menu->name }}</span>
                        @if($menu->children->count() > 0)
                            <svg class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        @endif
                    </button>
                    @if($menu->children->count() > 0)
                        <div class="hidden pl-4 mt-2 space-y-2 submenu">
                            @foreach($menu->children as $child)
                                <a href="{{ $child->page ? route($child->page->slug) : '#' }}"
                                   class="block text-gray-600 hover:text-blue-600 transition-colors duration-300">
                                    {{ $child->name }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="pt-4 space-y-2">
                <a href="#" class="block px-4 py-2 text-center text-blue-600 hover:text-blue-700 font-medium transition-colors duration-300">
                    Login
                </a>
                <a href="#" class="block px-4 py-2 text-center bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg">
                    Get Started
                </a>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    let isMenuOpen = false;

    mobileMenuButton.addEventListener('click', function() {
        isMenuOpen = !isMenuOpen;
        mobileMenu.classList.toggle('hidden');
        this.setAttribute('aria-expanded', isMenuOpen);
    });
});

function toggleSubmenu(button) {
    const submenu = button.nextElementSibling;
    if (submenu && submenu.classList.contains('submenu')) {
        submenu.classList.toggle('hidden');
        const icon = button.querySelector('svg');
        if (icon) {
            icon.classList.toggle('rotate-180');
        }
    }
}
</script>
