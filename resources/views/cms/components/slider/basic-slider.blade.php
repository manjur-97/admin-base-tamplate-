@props(['images' => []])

<div class="relative w-full h-[400px] overflow-hidden group">
    <!-- Main Slider Container -->
    <div class="relative w-full h-full">
        @foreach($images as $index => $image)
            <div class="absolute w-full h-full transition-opacity duration-500 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                 x-data="{ show: {{ $index === 0 ? 'true' : 'false' }} }"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                <img src="{{ $image }}" alt="Slider Image {{ $index + 1 }}" class="w-full h-full object-cover">
            </div>
        @endforeach
    </div>

    <!-- Navigation Arrows -->
    <button class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg transition-all opacity-0 group-hover:opacity-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow-lg transition-all opacity-0 group-hover:opacity-100">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Dots Navigation -->
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2">
        @foreach($images as $index => $image)
            <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all"></button>
        @endforeach
    </div>
</div>
