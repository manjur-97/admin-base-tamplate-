<footer class="bg-gray-100">
    <div class="container mx-auto px-4 py-12">
        <!-- Newsletter Section -->
        <div class="max-w-2xl mx-auto text-center mb-12">
            <h3 class="text-2xl font-bold mb-4">Subscribe to Our Newsletter</h3>
            <p class="text-gray-600 mb-6">Stay updated with our latest news and offers.</p>
            <form class="flex gap-2 max-w-md mx-auto">
                <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
                <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Subscribe</button>
            </form>
        </div>

        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h4 class="font-bold mb-4">{{ $website->title }}</h4>
                <ul class="space-y-2 text-gray-600">
                    @foreach ($website_menus as $menu)
                        <li><a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="hover:text-gray-900">{{ $menu->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h4 class="font-bold mb-4">Resources</h4>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="#" class="hover:text-gray-900">Documentation</a></li>
                    <li><a href="#" class="hover:text-gray-900">Help Center</a></li>
                    <li><a href="#" class="hover:text-gray-900">Guides</a></li>
                    <li><a href="#" class="hover:text-gray-900">API Status</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h4 class="font-bold mb-4">Legal</h4>
                <ul class="space-y-2 text-gray-600">
                    <li><a href="#" class="hover:text-gray-900">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-gray-900">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-gray-900">Cookie Policy</a></li>
                    <li><a href="#" class="hover:text-gray-900">GDPR</a></li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h4 class="font-bold mb-4">Follow Us</h4>
                <div class="flex space-x-4">
                    @if ($website->facebook)
                        <a href="{{ $website->facebook }}" class="text-gray-600 hover:text-gray-900"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if ($website->twitter)
                        <a href="{{ $website->twitter }}" class="text-gray-600 hover:text-gray-900"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if ($website->instagram)
                        <a href="{{ $website->instagram }}" class="text-gray-600 hover:text-gray-900"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if ($website->linkedin)
                        <a href="{{ $website->linkedin }}" class="text-gray-600 hover:text-gray-900"><i class="fab fa-linkedin"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-12 pt-8 border-t border-gray-200 text-center text-gray-600">
            <p>&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
        </div>
    </div>
</footer>
