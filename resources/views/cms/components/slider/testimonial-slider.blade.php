@props(['testimonials' => []])

<div class="relative w-full py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="relative">
            <!-- Testimonial Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                    <div class="bg-white p-8 rounded-2xl shadow-lg transform transition-all hover:scale-105">
                        <!-- Quote Icon -->
                        <div class="text-blue-500 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>

                        <!-- Testimonial Content -->
                        <p class="text-gray-600 mb-6">{{ $testimonial['content'] }}</p>

                        <!-- Author Info -->
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full overflow-hidden mr-4">
                                <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $testimonial['name'] }}</h4>
                                <p class="text-sm text-gray-500">{{ $testimonial['position'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Navigation Dots -->
            <div class="flex justify-center mt-8 space-x-2">
                @foreach($testimonials as $index => $testimonial)
                    <button class="w-2.5 h-2.5 rounded-full bg-gray-300 hover:bg-blue-500 transition-colors"></button>
                @endforeach
            </div>
        </div>
    </div>
</div>
