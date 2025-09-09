<footer class="bg-gradient-to-r from-purple-600 via-pink-500 to-red-500 text-white">
    <div class="container mx-auto px-4 py-12">
        <!-- Main Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- About Section -->
            <div>
                <h3 class="text-2xl font-bold mb-4">About {{ $website->title }}</h3>
                <p class="text-white/80">{{ $website->description ?? 'We are passionate about creating amazing experiences for our customers. Our mission is to make your journey exceptional.' }}</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    @foreach ($website_menus as $menu)
                        <li>
                            <a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="text-white/80 hover:text-white transition-colors flex items-center group">
                                <span class="mr-2 transform group-hover:translate-x-1 transition-transform">→</span>
                                <span>{{ $menu->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Contact Us</h3>
                <ul class="space-y-2 text-white/80">
                    @if ($website->address)
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span>{{ $website->address }}</span>
                        </li>
                    @endif
                    @if ($website->mobile)
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3"></i>
                            <span>{{ $website->mobile }}</span>
                        </li>
                    @endif
                    @if ($website->email)
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span>{{ $website->email }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Social Links -->
        <div class="flex justify-center space-x-6 mb-8">
            @if ($website->facebook)
                <a href="{{ $website->facebook }}" class="text-white/80 hover:text-white transition-colors transform hover:scale-110"><i class="fab fa-facebook text-2xl"></i></a>
            @endif
            @if ($website->twitter)
                <a href="{{ $website->twitter }}" class="text-white/80 hover:text-white transition-colors transform hover:scale-110"><i class="fab fa-twitter text-2xl"></i></a>
            @endif
            @if ($website->instagram)
                <a href="{{ $website->instagram }}" class="text-white/80 hover:text-white transition-colors transform hover:scale-110"><i class="fab fa-instagram text-2xl"></i></a>
            @endif
            @if ($website->linkedin)
                <a href="{{ $website->linkedin }}" class="text-white/80 hover:text-white transition-colors transform hover:scale-110"><i class="fab fa-linkedin text-2xl"></i></a>
            @endif
        </div>

        <!-- Copyright -->
        <div class="text-center text-white/80">
            <p>&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
        </div>
    </div>
</footer>
