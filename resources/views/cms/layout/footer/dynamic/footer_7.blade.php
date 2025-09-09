<footer class="bg-white border-t">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col items-center">
            <!-- Logo -->
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ $website->title }}</h2>
            </div>

            <!-- Social Icons -->
            <div class="flex space-x-6 mb-6">
                @if ($website->facebook)
                    <a href="{{ $website->facebook }}" class="text-gray-600 hover:text-gray-900 transition-colors"><i class="fab fa-facebook text-xl"></i></a>
                @endif
                @if ($website->twitter)
                    <a href="{{ $website->twitter }}" class="text-gray-600 hover:text-gray-900 transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                @endif
                @if ($website->instagram)
                    <a href="{{ $website->instagram }}" class="text-gray-600 hover:text-gray-900 transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                @endif
                @if ($website->linkedin)
                    <a href="{{ $website->linkedin }}" class="text-gray-600 hover:text-gray-900 transition-colors"><i class="fab fa-linkedin text-xl"></i></a>
                @endif
            </div>

            <!-- Navigation -->
            <nav class="flex flex-wrap justify-center gap-6 mb-6">
                @foreach ($website_menus as $menu)
                    <a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="text-gray-600 hover:text-gray-900 transition-colors">{{ $menu->name }}</a>
                @endforeach
            </nav>

            <!-- Copyright -->
            <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
        </div>
    </div>
</footer>
