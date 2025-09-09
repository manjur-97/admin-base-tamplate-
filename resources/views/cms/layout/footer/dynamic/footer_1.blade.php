<footer class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">{{$website->title}}</h3>
                <p class="text-gray-400">{{$website->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'}}</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    @foreach ($website_menus as $menu)
                        <li>
                            <a href="{{ $menu->slug == 'home' ? "/$website->slug" : "/$website->slug/$menu->slug" }}" class="text-gray-400 hover:text-white">{{ $menu->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h3 class="text-xl font-bold mb-4">Contact Us</h3>
                <ul class="space-y-2 text-gray-400">
                    @if ($website->address)
                        <li>{{ $website->address }}</li>
                    @endif
                    @if ($website->city)
                        <li>{{ $website->city }}</li>
                    @endif
                    @if ($website->mobile)
                        <li>Phone: {{ $website->mobile }}</li>
                    @endif
                    @if ($website->email)
                        <li>Email: {{ $website->email }}</li>
                    @endif
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                <p class="text-gray-400 mb-4">Subscribe to our newsletter for updates.</p>
                <form class="flex gap-2">
                    <input type="email" placeholder="Enter your email" class="px-4 py-2 rounded bg-gray-800 text-white flex-1">
                    <button class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">Subscribe</button>
                </form>
            </div>
        </div>

        <!-- Social Links -->
        <div class="mt-8 pt-8 border-t border-gray-800">
            <div class="flex justify-center space-x-6">
                @if ($website->facebook)
                    <a href="{{ $website->facebook }}" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                @endif
                @if ($website->twitter)
                    <a href="{{ $website->twitter }}" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                @endif
                @if ($website->instagram)
                    <a href="{{ $website->instagram }}" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                @endif
                @if ($website->linkedin)
                    <a href="{{ $website->linkedin }}" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin"></i></a>
                @endif
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ $website->title }}. All rights reserved.</p>
        </div>
    </div>
</footer>
