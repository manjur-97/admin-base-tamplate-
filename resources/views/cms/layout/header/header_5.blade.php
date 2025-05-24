<div class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white">
  <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
    <h1 class="font-bold text-xl">BrandName</h1>
    <nav class="space-x-6 hidden md:flex">
      @foreach($website_menus as $menu)
        <div class="relative group">
          <a href="{{ $menu->url }}" class="hover:text-gray-200 transition-colors duration-300">
            {{ $menu->name }}
          </a>
          @if($menu->children->count() > 0)
            <div class="absolute left-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
              @foreach($menu->children as $child)
                <a href="{{ $child->url }}" class="block px-4 py-2 hover:bg-gray-100 rounded-lg">
                  {{ $child->name }}
                </a>
              @endforeach
            </div>
          @endif
        </div>
      @endforeach
    </nav>
    <button class="md:hidden hover:bg-white/20 p-2 rounded-lg transition-colors duration-300">☰</button>
  </div>
</div>
