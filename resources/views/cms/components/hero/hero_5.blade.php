<!-- Hero Section 5: Parallax Effect -->
<section class="relative min-h-screen overflow-hidden bg-gray-900">
    <!-- Parallax Background -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC4xIj48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00eiIvPjwvZz48L2c+PC9zdmc+')] opacity-10"></div>
    </div>

    <!-- Floating Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-64 h-64 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-float animation-delay-4000"></div>
    </div>

    <!-- Content -->
    <div class="relative min-h-screen flex items-center">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                        {{ $hero->title ?? 'Build Your Digital Future' }}
                    </h1>
                    <p class="text-xl text-gray-300 mb-10">
                        {{ $hero->description ?? 'Create stunning websites with our powerful CMS platform. No coding required, just pure creativity.' }}
                    </p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="{{ $hero->primary_button_link ?? '#' }}"
                           class="group relative px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg overflow-hidden">
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

                <!-- Feature Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
                    <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="text-blue-400 text-2xl mb-4">🚀</div>
                        <h3 class="text-white text-xl font-semibold mb-2">Lightning Fast</h3>
                        <p class="text-gray-400">Optimized performance for the best user experience</p>
                    </div>
                    <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="text-purple-400 text-2xl mb-4">🎨</div>
                        <h3 class="text-white text-xl font-semibold mb-2">Beautiful Design</h3>
                        <p class="text-gray-400">Stunning templates and customization options</p>
                    </div>
                    <div class="bg-gray-800/50 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="text-pink-400 text-2xl mb-4">🛡️</div>
                        <h3 class="text-white text-xl font-semibold mb-2">Secure & Reliable</h3>
                        <p class="text-gray-400">Enterprise-grade security and 99.9% uptime</p>
                    </div>
                </div>
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
