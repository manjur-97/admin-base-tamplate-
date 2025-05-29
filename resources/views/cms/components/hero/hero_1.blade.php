<!-- Hero Section 1: Modern Split Layout -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap items-center">
            <!-- Left Content -->
            <div class="w-full lg:w-1/2 mb-10 lg:mb-0">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                    {{ $hero->title ?? 'Transform Your Digital Experience' }}
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    {{ $hero->description ?? 'Create stunning websites with our powerful CMS platform. Build, manage, and scale your online presence with ease.' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ $hero->primary_button_link ?? '#' }}" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300">
                        {{ $hero->primary_button_text ?? 'Get Started' }}
                    </a>
                    <a href="{{ $hero->secondary_button_link ?? '#' }}" class="px-8 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                        {{ $hero->secondary_button_text ?? 'Learn More' }}
                    </a>
                </div>
            </div>
            <!-- Right Image -->
            <div class="w-full lg:w-1/2">
                <img src="{{ $hero->image ?? 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2072&q=80' }}"
                     alt="Hero Image"
                     class="w-full h-auto rounded-lg shadow-xl">
            </div>
        </div>
    </div>
</section>
