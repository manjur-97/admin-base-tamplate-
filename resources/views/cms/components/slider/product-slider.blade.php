@props(['products' => []])

<div class="relative w-full bg-white">
    <div class="container mx-auto px-4 py-12">
        <div class="relative">
            <!-- Product Slider -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                @foreach($products as $index => $product)
                    <div class="relative {{ $index % 2 === 0 ? 'order-1' : 'order-2' }}"
                         x-data="{ show: {{ $index === 0 ? 'true' : 'false' }} }"
                         x-show="show"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-8"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-8">

                        <!-- Product Image -->
                        <div class="relative aspect-square rounded-2xl overflow-hidden">
                            <img src="{{ $product['image'] }}"
                                 alt="{{ $product['name'] }}"
                                 class="w-full h-full object-cover">
                            @if(isset($product['badge']))
                                <div class="absolute top-4 left-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $product['badge'] }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="{{ $index % 2 === 0 ? 'order-2' : 'order-1' }}"
                         x-data="{ show: {{ $index === 0 ? 'true' : 'false' }} }"
                         x-show="show"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform -translate-x-8"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform translate-x-8">

                        <div class="max-w-lg">
                            <h3 class="text-3xl font-bold mb-4">{{ $product['name'] }}</h3>
                            <p class="text-gray-600 mb-6">{{ $product['description'] }}</p>

                            <div class="flex items-center mb-6">
                                <span class="text-2xl font-bold text-gray-900">${{ $product['price'] }}</span>
                                @if(isset($product['old_price']))
                                    <span class="ml-2 text-lg text-gray-500 line-through">${{ $product['old_price'] }}</span>
                                @endif
                            </div>

                            <div class="flex space-x-4">
                                <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                                    Add to Cart
                                </button>
                                <button class="border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    Learn More
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation -->
            <div class="flex justify-center mt-8 space-x-4">
                @foreach($products as $index => $product)
                    <button class="w-3 h-3 rounded-full bg-gray-300 hover:bg-blue-500 transition-colors"></button>
                @endforeach
            </div>
        </div>
    </div>
</div>
