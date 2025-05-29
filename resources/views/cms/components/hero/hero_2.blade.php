<!-- Hero Section 2: Centered with Gradient -->
<section class="relative py-32 overflow-hidden bg-gradient-to-r from-blue-600 to-indigo-700">
    <!-- Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmZmZmYiIGZpbGwtb3BhY2l0eT0iMC40Ij48cGF0aCBkPSJNMzYgMzRjMC0yLjIxLTEuNzktNC00LTRzLTQgMS43OS00IDQgMS43OSA0IDQgNCA0LTEuNzkgNC00eiIvPjwvZz48L2c+PC9zdmc+')] opacity-10"></div>
    </div>

    <div class="container mx-auto px-4 relative">
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {{ $hero->title ?? 'Build Something Amazing' }}
            </h1>
            <p class="text-xl text-blue-100 mb-10">
                {{ $hero->description ?? 'The most powerful and flexible CMS platform for modern websites. Start building your dream website today.' }}
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ $hero->primary_button_link ?? '#' }}"
                   class="px-8 py-4 bg-white text-blue-600 rounded-full font-semibold hover:bg-blue-50 transition duration-300 shadow-lg">
                    {{ $hero->primary_button_text ?? 'Get Started Free' }}
                </a>
                <a href="{{ $hero->secondary_button_link ?? '#' }}"
                   class="px-8 py-4 bg-transparent border-2 border-white text-white rounded-full font-semibold hover:bg-white/10 transition duration-300">
                    {{ $hero->secondary_button_text ?? 'Watch Demo' }}
                </a>
            </div>

            <!-- Stats Section -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">10k+</div>
                    <div class="text-blue-100">Active Users</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">500+</div>
                    <div class="text-blue-100">Templates</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">24/7</div>
                    <div class="text-blue-100">Support</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-2">99.9%</div>
                    <div class="text-blue-100">Uptime</div>
                </div>
            </div>
        </div>
    </div>
</section>
