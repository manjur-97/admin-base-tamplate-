<!-- Hero Section 6: Glassmorphism Effect -->
<section class="min-h-screen bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 py-20">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center">
            <!-- Left Content -->
            <div class="w-full lg:w-1/2 mb-10 lg:mb-0">
                <div class="relative">
                    <!-- Glassmorphism Card -->
                    <div class="bg-white/30 backdrop-blur-lg rounded-2xl p-8 shadow-xl border border-white/20">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                            {{ $hero->title ?? 'Create Amazing Websites' }}
                        </h1>
                        <p class="text-lg text-gray-700 mb-8">
                            {{ $hero->description ?? 'Build stunning websites with our powerful CMS platform. No coding required, just pure creativity.' }}
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ $hero->primary_button_link ?? '#' }}"
                               class="group relative px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg overflow-hidden">
                                <span class="relative z-10 font-semibold text-white">
                                    {{ $hero->primary_button_text ?? 'Get Started' }}
                                </span>
                                <div class="absolute inset-0 bg-white/20 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                            </a>
                            <a href="{{ $hero->secondary_button_link ?? '#' }}"
                               class="px-8 py-4 bg-white/50 backdrop-blur-sm text-gray-700 rounded-lg hover:bg-white/70 transition duration-300">
                                {{ $hero->secondary_button_text ?? 'Learn More' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Animated Cards -->
            <div class="w-full lg:w-1/2">
                <div class="relative">
                    <!-- Floating Card 1 -->
                    <div class="absolute top-0 right-0 w-64 bg-white/30 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-white/20 transform hover:scale-105 transition-transform duration-300 animate-float">
                        <div class="text-indigo-500 text-2xl mb-4">🎯</div>
                        <h3 class="text-gray-900 text-xl font-semibold mb-2">Easy to Use</h3>
                        <p class="text-gray-700">Intuitive interface for everyone</p>
                    </div>

                    <!-- Floating Card 2 -->
                    <div class="absolute top-1/4 left-0 w-64 bg-white/30 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-white/20 transform hover:scale-105 transition-transform duration-300 animate-float animation-delay-2000">
                        <div class="text-purple-500 text-2xl mb-4">⚡</div>
                        <h3 class="text-gray-900 text-xl font-semibold mb-2">Lightning Fast</h3>
                        <p class="text-gray-700">Optimized performance</p>
                    </div>

                    <!-- Floating Card 3 -->
                    <div class="absolute bottom-0 right-1/4 w-64 bg-white/30 backdrop-blur-lg rounded-xl p-6 shadow-lg border border-white/20 transform hover:scale-105 transition-transform duration-300 animate-float animation-delay-4000">
                        <div class="text-pink-500 text-2xl mb-4">🎨</div>
                        <h3 class="text-gray-900 text-xl font-semibold mb-2">Beautiful Design</h3>
                        <p class="text-gray-700">Stunning templates</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Stats -->
        <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-white/30 backdrop-blur-lg rounded-xl p-6 text-center border border-white/20">
                <div class="text-3xl font-bold text-gray-900 mb-2">10k+</div>
                <div class="text-gray-700">Active Users</div>
            </div>
            <div class="bg-white/30 backdrop-blur-lg rounded-xl p-6 text-center border border-white/20">
                <div class="text-3xl font-bold text-gray-900 mb-2">500+</div>
                <div class="text-gray-700">Templates</div>
            </div>
            <div class="bg-white/30 backdrop-blur-lg rounded-xl p-6 text-center border border-white/20">
                <div class="text-3xl font-bold text-gray-900 mb-2">24/7</div>
                <div class="text-gray-700">Support</div>
            </div>
            <div class="bg-white/30 backdrop-blur-lg rounded-xl p-6 text-center border border-white/20">
                <div class="text-3xl font-bold text-gray-900 mb-2">99.9%</div>
                <div class="text-gray-700">Uptime</div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}
.animate-float {
    animation: float 6s ease-in-out infinite;
}
.animation-delay-2000 {
    animation-delay: 2s;
}
.animation-delay-4000 {
    animation-delay: 4s;
}
</style>
