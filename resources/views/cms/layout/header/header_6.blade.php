<div class="bg-white shadow-lg">
  <div class="max-w-7xl mx-auto flex justify-between items-center p-4">
    <h1 class="font-bold text-xl text-gray-800">BrandName</h1>
    <div class="flex-1 max-w-xl mx-8 hidden md:block">
      <div class="relative">
        <input type="text" placeholder="Search..." class="w-full px-4 py-2 rounded-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 outline-none">
        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-500 transition-colors duration-300">
          🔍
        </button>
      </div>
    </div>
    <nav class="space-x-6 hidden md:flex">
      @foreach($website_menus as $menu)
        <div class="relative group">
          <a href="{{ $menu->url }}" class="text-gray-600 hover:text-blue-600 transition-colors duration-300">
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
    <button class="md:hidden text-gray-600 hover:text-blue-600 p-2 rounded-lg transition-colors duration-300">☰</button>
  </div>
</div>
