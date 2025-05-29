<!-- Hero Section 3: Video Background -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Video Background -->
    <div class="absolute inset-0 w-full h-full">
        <video class="object-cover w-full h-full" autoplay loop muted playsinline>
            <source src="{{ $hero->video_url ?? 'https://assets.mixkit.co/videos/preview/mixkit-set-of-plateaus-seen-from-the-heights-in-a-sunset-26070-large.mp4' }}" type="video/mp4">
        </video>
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black/50"></div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
                {{ $hero->title ?? 'Create Your Digital Masterpiece' }}
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-10 max-w-2xl mx-auto">
                {{ $hero->description ?? 'Experience the future of web development with our cutting-edge CMS platform. Build, launch, and scale your digital presence.' }}
            </p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ $hero->primary_button_link ?? '#' }}"
                   class="group relative px-8 py-4 bg-white text-gray-900 rounded-lg overflow-hidden">
                    <span class="relative z-10 font-semibold">
                        {{ $hero->primary_button_text ?? 'Start Building' }}
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                </a>
                <a href="{{ $hero->secondary_button_link ?? '#' }}"
                   class="px-8 py-4 border-2 border-white text-white rounded-lg hover:bg-white/10 transition duration-300">
                    {{ $hero->secondary_button_text ?? 'Learn More' }}
                </a>
            </div>

            <!-- Features -->
            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-lg rounded-lg p-6">
                    <div class="text-white text-2xl font-bold mb-2">Easy to Use</div>
                    <p class="text-gray-200">Intuitive interface for seamless content management</p>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-lg p-6">
                    <div class="text-white text-2xl font-bold mb-2">Powerful</div>
                    <p class="text-gray-200">Advanced features for professional websites</p>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-lg p-6">
                    <div class="text-white text-2xl font-bold mb-2">Flexible</div>
                    <p class="text-gray-200">Customize every aspect of your website</p>
                </div>
            </div>
        </div>
    </div>
</section>
