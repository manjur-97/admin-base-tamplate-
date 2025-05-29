<header class="shadow-md bg-white tracking-wide relative z-50">
    <section class="flex items-center flex-wrap lg:justify-center gap-4 py-2.5 sm:px-10 px-4 border-gray-200 border-b min-h-[70px]">


        <a href="{{ route('home') }}" class="max-sm:hidden">
            <img src="{{ $cmsSetting->logo ?? 'https://readymadeui.com/readymadeui.svg' }}" alt="logo" class="w-36" />
        </a>
        <a href="{{ route('home') }}" class="hidden max-sm:block">
            <img src="{{ $cmsSetting->logo ?? 'https://readymadeui.com/readymadeui-short.svg' }}" alt="logo" class="w-9" />
        </a>


        <div id="toggleOpen" class="flex ml-auto lg:hidden">
            <button class="cursor-pointer">
                <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </section>

    <div class="flex flex-wrap justify-center sm:px-10 px-4 py-3 relative">
        <div id="collapseMenu" class="max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-40 max-lg:before:inset-0 max-lg:before:z-50">
            <button id="toggleClose" class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border border-gray-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black" viewBox="0 0 320.591 320.591">
                    <path d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z" data-original="#000000"></path>
                    <path d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z" data-original="#000000"></path>
                </svg>
            </button>

            <ul class="lg:flex lg:gap-x-10 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[280px] max-lg:top-0 max-lg:left-0 max-lg:p-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
                <li class="max-lg:border-b max-lg:border-gray-300 max-lg:pb-4 px-3 lg:hidden">
                    <a href="{{ route('home') }}">
                        <img src="{{ $cmsSetting->logo ?? 'https://readymadeui.com/readymadeui.svg' }}" alt="logo" class="w-36" />
                    </a>
                </li>
                @php
                    $totalMenus = count($website_menus);
                    $halfCount = ceil($totalMenus / 2);
                    $leftMenus = $website_menus->take($halfCount);
                @endphp
                @foreach($leftMenus as $menu)
                    <li class="max-lg:border-b max-lg:border-gray-300 max-lg:px-3 max-lg:py-3 relative group">
                        <a href="{{ $menu->page ? route($menu->page->slug) : 'javascript:void(0)' }}"
                            class="hover:text-blue-700 {{ request()->routeIs($menu->page?->slug) ? 'text-blue-700' : 'text-slate-900' }} font-medium text-[15px] flex items-center">
                            {{ $menu->name }}
                            @if($menu->children->count() > 0)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" class="ml-1 inline-block" viewBox="0 0 24 24">
                                    <path d="M12 16a1 1 0 0 1-.71-.29l-6-6a1 1 0 0 1 1.42-1.42l5.29 5.3 5.29-5.29a1 1 0 0 1 1.41 1.41l-6 6a1 1 0 0 1-.7.29z" data-name="16" data-original="#000000" />
                                </svg>
                            @endif
                        </a>
                        @if($menu->children->count() > 0)
                            <ul class="absolute top-5 max-lg:top-8 left-0 z-50 block space-y-2 shadow-lg bg-white max-h-0 overflow-hidden min-w-[230px] group-hover:opacity-100 group-hover:max-h-[700px] px-6 group-hover:pb-4 group-hover:pt-6 transition-all duration-[400ms]">
                                @foreach($menu->children as $child)
                                    <li class="border-b border-gray-300 py-3">
                                        <a href="{{ $child->page ? route($child->page->slug) : 'javascript:void(0)' }}"
                                            class="hover:text-blue-700 {{ request()->routeIs($child->page?->slug) ? 'text-blue-700' : 'text-slate-900' }} font-normal text-[15px] flex items-center">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                @php
                    $rightMenus = $website_menus->skip($halfCount);
                @endphp
                @foreach($rightMenus as $menu)
                    <li class="max-lg:border-b max-lg:border-gray-300 max-lg:px-3 max-lg:py-3 relative group">
                        <a href="{{ $menu->page ? route($menu->page->slug) : 'javascript:void(0)' }}"
                            class="hover:text-blue-700 {{ request()->routeIs($menu->page?->slug) ? 'text-blue-700' : 'text-slate-900' }} font-medium text-[15px] flex items-center">
                            {{ $menu->name }}
                            @if($menu->children->count() > 0)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" class="ml-1 inline-block" viewBox="0 0 24 24">
                                    <path d="M12 16a1 1 0 0 1-.71-.29l-6-6a1 1 0 0 1 1.42-1.42l5.29 5.3 5.29-5.29a1 1 0 0 1 1.41 1.41l-6 6a1 1 0 0 1-.7.29z" data-name="16" data-original="#000000" />
                                </svg>
                            @endif
                        </a>
                        @if($menu->children->count() > 0)
                            <ul class="absolute top-5 max-lg:top-8 left-0 z-50 block space-y-2 shadow-lg bg-white max-h-0 overflow-hidden min-w-[230px] group-hover:opacity-100 group-hover:max-h-[700px] px-6 group-hover:pb-4 group-hover:pt-6 transition-all duration-[400ms]">
                                @foreach($menu->children as $child)
                                    <li class="border-b border-gray-300 py-3">
                                        <a href="{{ $child->page ? route($child->page->slug) : 'javascript:void(0)' }}"
                                            class="hover:text-blue-700 {{ request()->routeIs($child->page?->slug) ? 'text-blue-700' : 'text-slate-900' }} font-normal text-[15px] flex items-center">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var toggleOpen = document.getElementById('toggleOpen');
    var toggleClose = document.getElementById('toggleClose');
    var collapseMenu = document.getElementById('collapseMenu');

    function handleClick() {
        if (collapseMenu.style.display === 'block') {
            collapseMenu.style.display = 'none';
        } else {
            collapseMenu.style.display = 'block';
        }
    }

    toggleOpen.addEventListener('click', handleClick);
    toggleClose.addEventListener('click', handleClick);
});
</script>
