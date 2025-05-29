<div class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 text-white sticky top-0 z-50 shadow-lg">
  <div class="container mx-auto px-4">
    <div class="flex justify-between items-center h-20">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <h1 class="font-bold text-2xl text-white hover:text-gray-100 transition-all duration-300 transform hover:scale-105">
          BrandName
        </h1>
      </div>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center space-x-1">
        @foreach($website_menus as $menu)
          <div class="relative group">
            <a href="/{{ $menu->page?->slug }}"
               class="px-4 py-2 text-white hover:text-gray-100 font-medium text-sm uppercase tracking-wide transition-all duration-300">
              {{ $menu->name }}
              @if($menu->children->count() > 0)
                <span class="inline-block ml-1 transform group-hover:rotate-180 transition-transform duration-300">▼</span>
              @endif
            </a>
            @if($menu->children->count() > 0)
              <div class="absolute left-0 mt-1 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100 border border-gray-100">
                <div class="py-2">
                  @foreach($menu->children as $child)
                    <a href="/{{ $child->page?->slug }}"
                       class="block px-4 py-3 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-200 text-sm">
                      {{ $child->name }}
                    </a>
                  @endforeach
                </div>
              </div>
            @endif
          </div>
        @endforeach
      </nav>

      <!-- Mobile Menu Button -->
      <div class="md:hidden">
        <button type="button"
                class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                aria-controls="mobile-menu"
                aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <span class="text-xl">☰</span>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="md:hidden hidden bg-white/10 backdrop-blur-sm border-t border-white/20" id="mobile-menu">
    <div class="container mx-auto px-4 py-2 space-y-1">
      @foreach($website_menus as $menu)
        <div class="py-2">
          <button type="button"
                  class="w-full flex items-center justify-between text-white hover:text-gray-100 font-medium transition-all duration-300"
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
                   class="block text-gray-100 hover:text-white transition-all duration-300">
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
  document.querySelector('[aria-controls="mobile-menu"]').addEventListener('click', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    const isExpanded = this.getAttribute('aria-expanded') === 'true';

    this.setAttribute('aria-expanded', !isExpanded);
    mobileMenu.classList.toggle('hidden');
  });

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
