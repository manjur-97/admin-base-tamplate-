<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-12">
        <!-- Top Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <!-- Brand Section -->
            <div class="col-span-1 md:col-span-2">
                <h2 class="text-3xl font-bold mb-4">{{ $website->title }}</h2>
                <p class="text-gray-400 mb-6">{{ $website->description ?? 'Creating amazing experiences for our customers. We are dedicated to providing the best service.' }}</p>
                <div class="flex space-x-4">
                    @if ($website->facebook)
                        <a href="{{ $website->facebook }}" class="bg-gray-800 p-3 rounded-full hover:bg-gray-700 transition-colors"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if ($website->twitter)
                        <a href="{{ $website->twitter }}" class="bg-gray-800 p-3 rounded-full hover:bg-gray-700 transition-colors"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if ($website->instagram)
                        <a href="{{ $website->instagram }}" class="bg-gray-800 p-3 rounded-full hover:bg-gray-700 transition-colors"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if ($website->linkedin)
                        <a href="{{ $website->linkedin }}" class="bg-gray-800 p-3 rounded-full hover:bg-gray-700 transition-colors"><i class="fab fa-linkedin"></i></a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    @foreach ($website_menus as $menu)
                        <li>
                            <a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="text-gray-400 hover:text-white transition-colors">{{ $menu->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">Contact Info</h3>
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

        <!-- Newsletter Section -->
        <div class="bg-gray-800 rounded-lg p-8 mb-12">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-2xl font-bold mb-4">Subscribe to Our Newsletter</h3>
                <p class="text-gray-400 mb-6">Stay updated with our latest news and offers.</p>
                <form class="flex gap-2 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 rounded bg-gray-700 text-white border border-gray-600 focus:outline-none focus:border-blue-500">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Subscribe</button>
                </form>
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
