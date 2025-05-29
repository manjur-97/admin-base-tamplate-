<header class="shadow-md tracking-wide relative z-50">
    <section class="py-2 bg-[#007bff] text-white text-right">
      <div class="container mx-auto px-4">
        <p class="text-sm">
          <span class="mx-3 font-semibold">Address:</span>{{ $cmsSetting->address ?? 'SWF New York 185669' }}
          <span class="mx-3 font-semibold">Contact No:</span>{{ $cmsSetting->phone ?? '1800333665' }}
        </p>
      </div>
    </section>

    <div class="bg-white min-h-[65px]">
      <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center justify-between gap-4 py-3">
          <a href="{{ route('home') }}" class="flex-shrink-0">
            <img src="{{ $cmsSetting->logo ?? 'https://readymadeui.com/readymadeui.svg' }}" alt="logo" class="w-36" />
          </a>

          <div id="collapseMenu"
            class="max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-50 max-lg:before:inset-0 max-lg:before:z-50">
            <button id="toggleClose" class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border border-gray-200 cursor-pointer">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
                <path
                  d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                  data-original="#000000"></path>
                <path
                  d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                  data-original="#000000"></path>
              </svg>
            </button>

            <ul
              class="lg:flex lg:gap-x-5 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-1/2 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-6 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
              <li class="mb-6 hidden max-lg:block">
                <a href="{{ route('home') }}">
                  <img src="{{ $cmsSetting->logo ?? 'https://readymadeui.com/readymadeui.svg' }}" alt="logo" class="w-36" />
                </a>
              </li>
              @foreach($website_menus as $menu)
                <li class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 px-3 relative group">
                  <a href="{{ $menu->page ? route($menu->page->slug) : 'javascript:void(0)' }}"
                    class="hover:text-blue-700 {{ request()->routeIs($menu->page?->slug) ? 'text-blue-700' : 'text-slate-900' }} block font-medium text-[15px]">
                    {{ $menu->name }}
                  </a>
                  @if($menu->children->count() > 0)
                    <div class="absolute left-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                      @foreach($menu->children as $child)
                        <a href="{{ $child->page ? route($child->page->slug) : 'javascript:void(0)' }}"
                           class="block px-4 py-2 hover:bg-gray-100 rounded-lg {{ request()->routeIs($child->page?->slug) ? 'text-blue-700' : 'text-slate-900' }}">
                          {{ $child->name }}
                        </a>
                      @endforeach
                    </div>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>

         
        </div>
      </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleOpen = document.getElementById('toggleOpen');
    const toggleClose = document.getElementById('toggleClose');
    const collapseMenu = document.getElementById('collapseMenu');

    toggleOpen.addEventListener('click', function() {
        collapseMenu.classList.remove('hidden');
    });

    toggleClose.addEventListener('click', function() {
        collapseMenu.classList.add('hidden');
    });
});
</script>
