@props(['slides' => []])

<div class="relative w-full h-[500px] overflow-hidden">
    <div class="relative w-full h-full">
        @foreach($slides as $index => $slide)
            <div class="absolute w-full h-full transition-all duration-500 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                 x-data="{ show: {{ $index === 0 ? 'true' : 'false' }} }"
                 x-show="show">
                <!-- Background Image with Gradient Overlay -->
                <div class="relative w-full h-full">
                    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30"></div>
                </div>

                <!-- Content -->
                <div class="absolute inset-0 flex items-center">
                    <div class="container mx-auto px-4">
                        <div class="max-w-2xl text-white">
                            <h2 class="text-4xl font-bold mb-4 transform transition-all duration-500 translate-y-0 opacity-100">
                                {{ $slide['title'] }}
                            </h2>
                            <p class="text-lg mb-6 transform transition-all duration-500 translate-y-0 opacity-100">
                                {{ $slide['description'] }}
                            </p>
                            @if(isset($slide['button']))
                                <a href="{{ $slide['button']['url'] }}"
                                   class="inline-block bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-all">
                                    {{ $slide['button']['text'] }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Navigation -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-4">
        @foreach($slides as $index => $slide)
            <button class="w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all"></button>
        @endforeach
    </div>
</div>
