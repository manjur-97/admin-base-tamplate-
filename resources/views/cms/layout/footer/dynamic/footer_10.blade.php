<footer class="bg-white border-t">
    <div class="container mx-auto px-4 py-12">
        <!-- Main Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
            <!-- Brand Section -->
            <div class="col-span-1 md:col-span-2">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $website->title }}</h2>
                <p class="text-gray-600 mb-6">{{ $website->description }}</p>
                <div class="flex space-x-4">

                    @if ($website->facebook)
                        <a href="{{ $website->facebook }}"
                            class="bg-gray-100 p-2 rounded hover:bg-blue-100 transition-colors" target="_blank">
                            <i class="fab fa-facebook text-blue-600"></i>
                        </a>
                    @endif
                    @if ($website->twitter)
                        <a href="{{ $website->twitter }}"
                            class="bg-gray-100 p-2 rounded hover:bg-blue-100 transition-colors" target="_blank">
                            <i class="fab fa-twitter text-blue-400"></i>
                        </a>
                    @endif
                    @if ($website->instagram)
                        <a href="{{ $website->instagram }}"
                            class="bg-gray-100 p-2 rounded hover:bg-blue-100 transition-colors" target="_blank">
                            <i class="fab fa-instagram text-red-400"></i>
                        </a>
                    @endif

                    @if ($website->linkedin)
                        <a href="{{ $website->linkedin }}"
                            class="bg-gray-100 p-2 rounded hover:bg-blue-100 transition-colors" target="_blank">
                            <i class="fab fa-linkedin text-blue-500"></i>
                        </a>
                    @endif
                    @if ($website->youtube)
                        <a href="{{ $website->youtube }}"
                            class="bg-gray-100 p-2 rounded hover:bg-blue-100 transition-colors" target="_blank">
                            <i class="fab fa-youtube text-red-500"></i>
                        </a>
                    @endif
                    @if ($website->git)
                        <a href="{{ $website->git }}"
                            class="bg-gray-100 p-2 rounded hover:bg-blue-100 transition-colors" target="_blank">
                            <i class="fab fa-git text-gray-900"></i>
                        </a>
                    @endif




                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    @foreach ($website_menus as $menu)
                        @if ($menu->slug == 'home')
                            <li>
                                <a href="{{ "/$website->slug" }}"
                                    class="text-gray-600 hover:text-gray-900 transition-colors">{{ $menu->name }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ "/$website->slug/$menu->slug" }}"
                                    class="text-gray-600 hover:text-gray-900 transition-colors">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-4">Contact Info</h3>
                <ul class="space-y-2 text-gray-600">
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
        <div class="bg-gray-50 rounded-lg p-8 mb-12">
            <div class="max-w-2xl mx-auto text-center">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Subscribe to Our Newsletter</h3>
                <p class="text-gray-600 mb-6">Stay updated with us.</p>
                <form class="flex gap-2 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email"
                        class="flex-1 px-4 py-2 rounded border border-gray-300 focus:outline-none focus:border-blue-500">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="pt-8 border-t">
            <div class="flex flex-col md:flex-row justify-center items-center">
                <p class="text-gray-600 mb-4 md:mb-0 text-center">&copy; 2025 Manjur Rahman. All rights reserved.</p>

            </div>
        </div>
    </div>
</footer>
