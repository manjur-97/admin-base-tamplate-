<footer class="bg-gradient-to-r from-purple-600 to-blue-600 text-white">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Logo -->
            <div class="mb-4 md:mb-0">
                <h2 class="text-2xl font-bold">{{ $website->title }}</h2>
            </div>

            <!-- Navigation -->
            <nav class="flex space-x-6 mb-4 md:mb-0">
                @foreach ($website_menus as $menu)
                    <a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="hover:text-gray-200">{{ $menu->name }}</a>
                @endforeach
            </nav>

            <!-- Social Icons -->
            <div class="flex space-x-4">
                @if ($website->facebook)
                    <a href="{{ $website->facebook }}" class="hover:text-gray-200"><i class="fab fa-facebook"></i></a>
                @endif
                @if ($website->twitter)
                    <a href="{{ $website->twitter }}" class="hover:text-gray-200"><i class="fab fa-twitter"></i></a>
                @endif
                @if ($website->instagram)
                    <a href="{{ $website->instagram }}" class="hover:text-gray-200"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center text-sm">
            <p>&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
        </div>
    </div>
</footer>
