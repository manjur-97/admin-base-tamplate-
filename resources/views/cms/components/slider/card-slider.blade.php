@props(['cards' => []])

<div class="relative w-full py-8">
    <div class="container mx-auto px-4">
        <!-- Slider Container -->
        <div class="relative">
            <div class="flex space-x-6 overflow-x-auto pb-6 scrollbar-hide">
                @foreach($cards as $card)
                    <div class="flex-none w-[300px] bg-white rounded-xl shadow-lg overflow-hidden transform transition-all hover:scale-105">
                        <div class="relative h-48">
                            <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">{{ $card['title'] }}</h3>
                            <p class="text-gray-600 mb-4">{{ $card['description'] }}</p>
                            @if(isset($card['button']))
                                <a href="{{ $card['button']['url'] }}"
                                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                    {{ $card['button']['text'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Scroll Indicators -->
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/80 rounded-full shadow-lg flex items-center justify-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </div>
            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/80 rounded-full shadow-lg flex items-center justify-center cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>
    </div>
</div>

<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
