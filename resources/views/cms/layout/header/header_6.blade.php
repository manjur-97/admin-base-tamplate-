<div class="bg-gradient-to-r from-indigo-900 via-purple-900 to-indigo-900 text-white -mt-4">
  <div class="container mx-auto">
    <!-- Top Bar -->
    <div class="py-2 px-4 flex justify-between items-center text-sm border-b border-white/10">
      <div class="flex items-center space-x-4">
        <a href="#" class="hover:text-purple-300 transition-colors duration-300">
          <span class="mr-1">📧</span> contact@example.com
        </a>
        <a href="#" class="hover:text-purple-300 transition-colors duration-300">
          <span class="mr-1">📞</span> +1 234 567 890
        </a>
      </div>
      <div class="flex items-center space-x-4">
        <a href="#" class="hover:text-purple-300 transition-colors duration-300">Login</a>
        <a href="#" class="hover:text-purple-300 transition-colors duration-300">Register</a>
      </div>
    </div>

    <!-- Main Navigation -->
    <div class="py-4 px-4">
      <div class="flex justify-between items-center">
        <!-- Logo -->
        <div class="flex-shrink-0">
          <h1 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
            BrandName
          </h1>
        </div>

        <!-- Search Bar -->
        <div class="flex-1 max-w-xl mx-8 hidden md:block">
          <div class="relative">
            <input type="text"
                   placeholder="Search..."
                   class="w-full px-4 py-2 rounded-full bg-white/10 border border-white/20 text-white placeholder-white/50 focus:bg-white/20 focus:border-purple-400 focus:ring-2 focus:ring-purple-400/20 transition-all duration-300 outline-none">
            <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white/50 hover:text-white transition-colors duration-300">
              🔍
            </button>
          </div>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-1">
          @foreach($website_menus as $menu)
            <div class="relative group">
              <a href="/{{ $menu->page?->slug }}"
                 class="px-4 py-2 text-white/90 hover:text-white font-medium transition-all duration-300 relative">
                {{ $menu->name }}
                <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-purple-400 to-pink-400 transition-all duration-300 group-hover:w-full"></span>
              </a>
              @if($menu->children->count() > 0)
                <div class="absolute top-full left-0 mt-2 w-48 bg-white/10 backdrop-blur-md rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100 border border-white/20">
                  @foreach($menu->children as $child)
                    <a href="/{{ $child->page?->slug }}"
                       class="block px-4 py-3 text-white/90 hover:text-white hover:bg-white/10 transition-all duration-200 text-sm">
                      {{ $child->name }}
                    </a>
                  @endforeach
                </div>
              @endif
            </div>
          @endforeach
        </nav>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-white/90 hover:text-white p-2 rounded-lg transition-colors duration-300"
                onclick="toggleMobileMenu()">
          ☰
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden hidden bg-white/10 backdrop-blur-md border-t border-white/10">
    <div class="container mx-auto px-4 py-2 space-y-1">
      @foreach($website_menus as $menu)
        <div class="py-2">
          <button type="button"
                  class="w-full flex items-center justify-between text-white/90 hover:text-white font-medium transition-all duration-300"
                  onclick="toggleSubmenu(this)">
            <span>{{ $menu->name }}</span>
            @if($menu->children->count() > 0)
              <span class="transform transition-transform duration-300">▼</span>
            @endif
          </button>
          @if($menu->children->count() > 0)
            <div class="hidden pl-4 mt-2 space-y-2 submenu">
              @foreach($menu->children as $child)
                <a href="/{{ $child->page?->slug }}"
                   class="block text-white/90 hover:text-white transition-all duration-300">
                  {{ $child->name }}
                </a>
              @endforeach
            </div>
          @endif
        </div>
      @endforeach
    </div>
  </div>
</div>

<script>
  // Mobile menu toggle
  function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenu.classList.toggle('hidden');
  }

  // Submenu toggle function
  function toggleSubmenu(button) {
    const submenu = button.nextElementSibling;
    if (submenu && submenu.classList.contains('submenu')) {
      submenu.classList.toggle('hidden');
      const arrow = button.querySelector('span:last-child');
      if (arrow) {
        arrow.classList.toggle('rotate-180');
      }
    }
  }
</script>

<!-- Add padding to body to prevent content from being hidden behind fixed header -->
<style>
  body {
    padding-top: 4rem;
    margin: 0;
    padding: 0;
  }
</style>
