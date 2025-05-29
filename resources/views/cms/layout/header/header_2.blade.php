<div class="bg-white border-b border-gray-100 sticky top-0 z-50 backdrop-blur-sm bg-white/80">
  <div class="container mx-auto px-4">
    <div class="flex justify-between items-center h-20">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <h1 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">BrandName</h1>
      </div>

      <!-- Desktop Navigation -->
      <nav class="hidden md:flex items-center space-x-1">
        @foreach($website_menus as $menu)
          <div class="relative group">
            <a href="/{{ $menu->page?->slug }}"
               class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium text-sm uppercase tracking-wide transition-all duration-300 flex items-center">
              {{ $menu->name }}
              @if($menu->children->count() > 0)
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              @endif
            </a>
            @if($menu->children->count() > 0)
              <div class="absolute left-0 mt-1 w-64 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top scale-95 group-hover:scale-100 border border-gray-100">
                <div class="py-2">
                  @foreach($menu->children as $child)
                    <a href="/{{ $child->page?->slug }}"
                       class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200 text-sm">
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
                class="inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:text-blue-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 transition-all duration-300"
                aria-controls="mobile-menu"
                aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            @endif
          </button>
          @if($menu->children->count() > 0)
            <div class="hidden pl-4 mt-2 space-y-2 submenu">
              @foreach($menu->children as $child)
                <a href="/{{ $child->page?->slug }}"
                   class="block text-gray-600 hover:text-blue-600 transition-colors duration-300">
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
      const icon = button.querySelector('svg');
      if (icon) {
        icon.classList.toggle('rotate-180');
      }
    }
  }
</script>
