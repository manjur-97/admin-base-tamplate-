<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-12">
        <!-- Top Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold mb-4">{{ $website->title }}</h3>
                <p class="text-gray-400 mb-4">{{ $website->description ?? 'We are dedicated to providing the best service to our customers. Our mission is to make your experience exceptional.' }}</p>
                <div class="flex space-x-4">
                    @if ($website->facebook)
                        <a href="{{ $website->facebook }}" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-facebook text-xl"></i></a>
                    @endif
                    @if ($website->twitter)
                        <a href="{{ $website->twitter }}" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                    @endif
                    @if ($website->instagram)
                        <a href="{{ $website->instagram }}" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                    @endif
                    @if ($website->linkedin)
                        <a href="{{ $website->linkedin }}" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-linkedin text-xl"></i></a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    @foreach ($website_menus as $menu)
                        <li>
                            <a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="text-gray-400 hover:text-white transition-colors flex items-center">
                                <span class="mr-2">→</span>
                                <span>{{ $menu->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-bold mb-4">Contact Us</h4>
                <ul class="space-y-2 text-gray-400">
                    @if ($website->address)
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                            <span>{{ $website->address }}</span>
                        </li>
                    @endif
                    @if ($website->mobile)
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-3"></i>
                            <span>{{ $website->mobile }}</span>
                        </li>
                    @endif
                    @if ($website->email)
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3"></i>
                            <span>{{ $website->email }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="pt-8 border-t border-gray-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
