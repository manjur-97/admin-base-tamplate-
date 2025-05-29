<!-- Hero Section 4: 3D Card Effect -->
<section class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black py-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center">
            <!-- Left Content -->
            <div class="w-full lg:w-1/2 mb-10 lg:mb-0">
                <div class="relative">
                    <!-- Animated Background Elements -->
                    <div class="absolute -top-10 -left-10 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
                    <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
                    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>

                    <!-- Content -->
                    <div class="relative">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                            {{ $hero->title ?? 'Transform Your Ideas Into Reality' }}
                        </h1>
                        <p class="text-xl text-gray-300 mb-8">
                            {{ $hero->description ?? 'Build stunning websites with our powerful CMS platform. No coding required, just pure creativity.' }}
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ $hero->primary_button_link ?? '#' }}"
                               class="group relative px-8 py-4 bg-gradient-to-r from-purple-500 to-blue-500 rounded-lg overflow-hidden">
                                <span class="relative z-10 font-semibold text-white">
                                    {{ $hero->primary_button_text ?? 'Get Started' }}
                                </span>
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                            </a>
                            <a href="{{ $hero->secondary_button_link ?? '#' }}"
                               class="px-8 py-4 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-800 transition duration-300">
                                {{ $hero->secondary_button_text ?? 'Learn More' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right 3D Card -->
            <div class="w-full lg:w-1/2">
                <div class="relative perspective-1000">
                    <div class="transform hover:rotate-y-10 transition-transform duration-500">
                        <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-2xl p-8 shadow-2xl">
                            <div class="aspect-w-16 aspect-h-9 mb-6">
                                <img src="{{ $hero->image ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2072&q=80' }}"
                                     alt="Feature Preview"
                                     class="rounded-lg object-cover w-full h-full">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-700/50 rounded-lg p-4">
                                    <div class="text-white font-semibold mb-2">Easy to Use</div>
                                    <p class="text-gray-400 text-sm">Intuitive interface for everyone</p>
                                </div>
                                <div class="bg-gray-700/50 rounded-lg p-4">
                                    <div class="text-white font-semibold mb-2">Powerful</div>
                                    <p class="text-gray-400 text-sm">Advanced features included</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}
.animate-blob {
    animation: blob 7s infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
.animation-delay-4000 {
    animation-delay: 4s;
}
.perspective-1000 {
    perspective: 1000px;
}
.rotate-y-10 {
    transform: rotateY(10deg);
}
</style>
